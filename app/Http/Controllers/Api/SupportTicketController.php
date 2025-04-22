<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportTicketRequest;
use App\Http\Requests\TicketReplyRequest;
use App\Services\SupportTicketService;
use App\Http\Resources\SupportTicketResource;
use App\Http\Resources\SupportReplyResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SupportTicketController extends Controller
{
    private SupportTicketService $svc;

    public function __construct(SupportTicketService $svc)
    {
        $this->svc = $svc;
    }

    public function index(Request $request): JsonResponse
    {
        $tickets = $this->svc->getUserTickets($request->user());
        return response()->json(SupportTicketResource::collection($tickets));
    }

    /**
     * POST /api/tickets
     */
    public function store(SupportTicketRequest $request): JsonResponse
    {
        $ticket = $this->svc->createTicket($request->user(), $request->validated());
        return (new SupportTicketResource($ticket))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * GET /api/tickets/{ticket}
     */
    public function show(Request $request, int $ticket): JsonResponse
    {
        $model = $this->svc->getTicketWithReplies($request->user(), $ticket);

        if (! $model) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $model->load('replies.user');
        return response()->json(new SupportTicketResource($model));
    }

    /**
     * POST /api/tickets/{ticket}/reply
     */
    public function reply(TicketReplyRequest $request, int $ticket): JsonResponse
    {
        if (! $this->svc->getTicketWithReplies($request->user(), $ticket)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $reply = $this->svc->addReply(
            $request->user(),
            $ticket,
            $request->validated()['message']
        );

        return (new SupportReplyResource($reply))
            ->response()
            ->setStatusCode(201);
    }
    /**
     * POST /api/tickets/{ticket}/close
     * Close a support ticket (user only).
     */
    public function close(Request $request, int $ticket): JsonResponse
    {
        // Verify ownership
        if (! $this->svc->getTicketWithReplies($request->user(), $ticket)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        // Close it
        $this->svc->closeTicket($request->user(), $ticket);

        return response()->json([
            'message' => __('Ticket closed.')
        ], 200);
    }
}