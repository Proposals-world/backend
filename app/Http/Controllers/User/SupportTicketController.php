<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportTicketRequest;
use App\Http\Requests\TicketReplyRequest;
use App\Services\SupportTicketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SupportTicketController extends Controller
{
    private SupportTicketService $svc;

    public function __construct(SupportTicketService $svc)
    {
        $this->svc = $svc;
    }

    /** Show all tickets */
    public function index(Request $request): View
    {
        // 1) Fetch *all* tickets via your existing service
        $allTickets = $this->svc->getUserTickets($request->user());

        // 2) If a status filter was provided, narrow it down
        if ($status = $request->query('status')) {
            $tickets = $allTickets->where('status', $status);
        } else {
            $tickets = $allTickets;
        }

        // 3) Pass both the full list (for your badges) and the filtered list to the view
        return view('user.support.index', [
            'tickets'    => $tickets,
            'allTickets' => $allTickets,
        ]);
    }

    /** Show “new ticket” form */
    public function create(): View
    {
        return view('user.support.create');
    }

    /** Handle “new ticket” POST */
    public function store(SupportTicketRequest $request): RedirectResponse
    {
        $this->svc->createTicket(auth()->user(), $request->validated());
        return redirect()
            ->route('user.support.index')
            ->with('success', __('Support ticket created.'));
    }

    /** Show one ticket + its replies */
    public function show(int $ticket): View
    {
        $model = $this->svc->getTicketWithReplies(auth()->user(), $ticket);
        abort_if(! $model, 404);

        return view('user.support.show', [
            'ticket' => $model,
        ]);
    }

    /** Handle reply POST */
    public function reply(TicketReplyRequest $request, int $ticket): RedirectResponse
    {
        $this->svc->addReply(
            auth()->user(),
            $ticket,
            $request->validated()['message']
        );

        return redirect()
            ->route('user.support.show', $ticket)
            ->with('success', __('Your reply was posted.'));
    }

    /** Close the ticket */
    public function close(int $ticket): RedirectResponse
    {
        $this->svc->closeTicket(auth()->user(), $ticket);

        return redirect()
            ->route('user.support.show', $ticket)
            ->with('success', __('Ticket closed.'));
    }
}