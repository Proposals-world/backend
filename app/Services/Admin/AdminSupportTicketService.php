<?php

namespace App\Services\Admin;

use App\Models\SupportTicket;
use App\Models\SupportReply;
use Illuminate\Contracts\Auth\Authenticatable;

class AdminSupportTicketService
{
    /**
     * Fetch all tickets with reply counts and user info
     */
    public function getAllTickets()
    {
        return SupportTicket::withCount('replies')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Fetch a single ticket and its replies
     */
    public function getTicketWithReplies(int $ticketId): ?SupportTicket
    {
        return SupportTicket::with(['replies.user', 'user'])
            ->where('id', $ticketId)
            ->first();
    }

    /**
     * Add a reply to a ticket
     */
    public function addReply(Authenticatable $admin, int $ticketId, string $message): SupportReply
    {
        $reply = new SupportReply([
            'message' => $message,
        ]);
        $reply->ticket_id = $ticketId;
        $reply->user()->associate($admin);
        $reply->save();

        // Update the ticket status to in_progress if it's not already resolved or closed
        $ticket = $reply->ticket;
        if (!in_array($ticket->status, ['resolved', 'closed'])) {
            $ticket->status = 'in_progress';
            $ticket->save();
        }

        return $reply;
    }

    /**
     * Update ticket status
     */
    public function updateTicketStatus(int $ticketId, string $status): void
    {
        $ticket = SupportTicket::findOrFail($ticketId);
        $ticket->status = $status;
        $ticket->save();
    }
}