<?php

namespace App\Services;

use App\Models\SupportTicket;
use App\Models\SupportReply;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class SupportTicketService
{
    /**
     * Fetch all tickets for a given user.
     */
    public function getUserTickets(Authenticatable $user)
    {
        return SupportTicket::withCount('replies')
            ->where('user_id', $user->getAuthIdentifier())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Create a new ticket.
     */
    public function createTicket(Authenticatable $user, array $data): SupportTicket
    {
        $ticket = new SupportTicket([
            'subject' => $data['subject'],
            'description' => $data['description'],
            'status' => 'open',
        ]);
        $ticket->user()->associate($user);
        $ticket->save();

        return $ticket;
    }

    /**
     * Fetch a single ticket and its replies, ensuring ownership.
     */
    public function getTicketWithReplies(Authenticatable $user, int $ticketId): ?SupportTicket
    {
        return SupportTicket::with('replies.user')
            ->where('id', $ticketId)
            ->where('user_id', $user->getAuthIdentifier())
            ->first();
    }

    /**
     * Add a reply to a ticket.
     */
    public function addReply(Authenticatable $user, int $ticketId, string $message): SupportReply
    {
        $reply = new SupportReply([
            'message' => $message,
        ]);
        $reply->ticket_id = $ticketId;
        $reply->user()->associate($user);
        $reply->save();

        // Optionally bump ticket status:
        $ticket = $reply->ticket;
        $ticket->status = 'in_progress';
        $ticket->save();

        return $reply;
    }
    /** close ticket */
    public function closeTicket(User $user, int $ticketId): void
    {
        $ticket = SupportTicket::where('id', $ticketId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $ticket->status = 'closed';
        $ticket->save();
    }

}