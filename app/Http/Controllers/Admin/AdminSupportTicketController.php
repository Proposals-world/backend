<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketReplyRequest;
use App\Models\SupportTicket;
use App\Services\Admin\AdminSupportTicketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSupportTicketController extends Controller
{
    private AdminSupportTicketService $svc;

    public function __construct(AdminSupportTicketService $svc)
    {
        $this->svc = $svc;
    }

    /**
     * Show all tickets
     */
    public function index(Request $request): View
    {
        // Fetch all tickets for the admin dashboard
        $allTickets = $this->svc->getAllTickets();

        // If a status filter was provided, narrow it down
        if ($status = $request->query('status')) {
            $tickets = $allTickets->where('status', $status);
        } else {
            $tickets = $allTickets;
        }

        // Pass both the full list (for your badges) and the filtered list to the view
        return view('admin.support.index', [
            'tickets'    => $tickets,
            'allTickets' => $allTickets,
        ]);
    }

    /**
     * Show one ticket + its replies
     */
    public function show(int $ticket): View
    {
        $model = $this->svc->getTicketWithReplies($ticket);
        abort_if(!$model, 404);

        return view('admin.support.show', [
            'ticket' => $model,
        ]);
    }

    /**
     * Handle reply POST
     */
    public function reply(TicketReplyRequest $request, int $ticket): RedirectResponse
    {
        $this->svc->addReply(
            auth()->user(),
            $ticket,
            $request->validated()['message']
        );

        return redirect()
            ->route('admin.support.show', $ticket);    }

    /**
     * Change ticket status
     */
    public function updateStatus(Request $request, int $ticket): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $this->svc->updateTicketStatus($ticket, $request->status);

        return redirect()
            ->route('admin.support.show', $ticket)
            ->with('success', __('Ticket status updated.'));
    }
}