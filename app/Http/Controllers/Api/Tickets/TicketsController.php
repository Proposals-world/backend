<?php

namespace App\Http\Controllers\Api\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportTicketRequest;
use App\Http\Requests\TicketReplyRequest;
use App\Http\Resources\SupportReplyResource;
use App\Http\Resources\SupportTicketResource;
use App\Models\SupportReply;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Ticket;

class TicketsController extends Controller
{
    //  check on reqqqq for ar and en
    // get all tickets for the admin
    public function getTickets()
    {
        $tickets = SupportTicket::with(['user', 'replies' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'replies.user'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            "success" => true,
            "message" => "Get all tickets with replies successfully",
            "data" => [
                "tickets" => SupportTicketResource::collection($tickets)
            ]
        ], 200);
    }
    // create tickets only for the user
    public function createTicket(SupportTicketRequest $request)
    {
        $user = Auth::user();

        if ($user->role_id != 2) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized role.',
            ], 403);
        }

        $ticket = SupportTicket::create([
            "user_id"        => $user->id,
            "subject_en"     => $request->subject_en,
            "subject_ar"     => $request->subject_ar,
            "description_en" => $request->description_en,
            "description_ar" => $request->description_ar,
            "status"         => "open",
        ]);

        return response()->json([
            "success" => true,
            "message" => "Ticket created successfully",
            "data"    => [
                "created_by" => [
                    "first_name" => $user->first_name,
                    "last_name"  => $user->last_name,
                    "email"      => $user->email,
                ],
                "ticket" => new SupportTicketResource($ticket),
            ],
        ], 200);
    }
    // reply to a ticket
    public function ticketsReply(TicketReplyRequest $request)
    {

        $ticket = SupportTicket::with("user")
            ->where('id', $request->ticket_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found or you do not have permission to access this ticket.',
            ], 404);
        }

        $reply = SupportReply::create([
            "ticket_id"  => $request->ticket_id,
            "user_id"    => Auth::user()->id,
            "message_en" => $request->message_en,
            "message_ar" => $request->message_ar,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Ticket reply created successfully",
            "replies" => new SupportReplyResource($reply),

        ], 201);
    }
    // get each ticket with its replies
    public function getTicketWithReplies(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_id'    => 'required|exists:support_tickets,id',  // Check that ticket_id exists in the support_tickets table
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);  // Return validation errors if any
        }
        $ticketId = $request->ticket_id;
        $ticket = SupportTicket::with("user")
            ->where('id', $ticketId)
            ->where('user_id', Auth::user()->id)
            ->first();
        if (!$ticket) {
            return response()->json([
                'success' => true,
                'message' => 'Ticket not found or you do not have permission to access this ticket.',
            ], 404);
        }
        $ticketWithReplies = SupportTicket::with([
            'user',
            'replies' => function ($query) {
                $query->orderBy('created_at', 'desc');
            },
            'replies.user'
        ])
            ->where('id', $ticketId)
            ->first();

        return response()->json([
            "success" => true,
            "message" => "Ticket with reply fetched successfully",
            "data"    => [
                // "Created by" => $user,
                "ticketWithReplies"  => $ticketWithReplies,
            ],
        ], 200);
    }
    public function updateTicketStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_id'    => 'required|exists:support_tickets,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        $user = User::where("id", Auth::user()->id)->first();
        if ($user->role_id == 2) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized role.',
            ], 403);
        }
        $ticket = SupportTicket::where("id", $request->ticket_id)->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found.',
            ], 404);
        }

        if ($ticket->status == "solved") {
            return response()->json([
                'success' => true,
                'message' => 'Ticket already solved.',
            ], 409);
        }

        // Continue with your logic if the ticket is not solved yet

        $ticket->update(["status" => "solved"]);
        return response()->json([
            "success" => true,
            "message" => "Ticket status updated successfully",
            "data"    => [
                // "Created by" => $user,
                "status"  => "solved",
            ],
        ], 201);
    }
}
