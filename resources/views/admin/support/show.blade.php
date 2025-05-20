@extends('admin.layout.app')

@section('title', 'Support Ticket Details')

@section('content')
<div class="container-fluid pt-4">
    <!-- Back Button - Outside the card -->
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('admin.support') }}" class="btn btn-outline-secondary">
                <i class="simple-icon-arrow-left"></i>
                Back to Tickets
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            {{-- Chat Main Area --}}
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-white pt-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="ticket-title">
                            <h5 class="mb-0">
                                Ticket #{{ $ticket->id }}: {{ $ticket->subject }}
                            </h5>
                        </div>
                        <div class="ticket-status">
                            <form method="POST"
                                  action="{{ route('admin.support.update-status', $ticket) }}"
                                  class="d-flex align-items-center gap-3"
                                  id="status-form">
                                @csrf
                                <select id="status-select" name="status" class="form-control form-control-sm mr-2" style="width: auto;" onchange="document.getElementById('status-form').submit();">
                                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="chat-container">
                    {{-- Messages Area --}}
                    <div class="chat-messages p-3">
                        {{-- Initial Ticket Message --}}
                        <div class="message-group incoming">
                            <div class="avatar">
                                <div class="avatar-circle">
                                    {{ substr($ticket->user->first_name,0,1) }}
                                    {{ substr($ticket->user->last_name,0,1) }}
                                </div>
                            </div>
                            <div class="message-bubble">
                                <div class="message-sender">
                                    {{ $ticket->user->first_name }}
                                    {{ $ticket->user->last_name }}
                                </div>
                                <div class="message-content">
                                    <p>{{ $ticket->description }}</p>
                                </div>
                                <div class="message-info">
                                    <span class="message-time">
                                        {{ $ticket->created_at->format('M d, H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Replies --}}
                        @foreach($ticket->replies as $reply)
                            @if($reply->user->role_id === 1)
                                {{-- Admin Message --}}
                                <div class="message-group outgoing">
                                    <div class="message-bubble">
                                        <div class="message-content">
                                            <p>{{ $reply->message }}</p>
                                        </div>
                                        <div class="message-info">
                                            <span class="message-time">
                                                {{ $reply->created_at->format('M d, H:i') }}
                                            </span>
                                            <span class="message-status">
                                                <i class="simple-icon-check"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- User Message --}}
                                <div class="message-group incoming">
                                    <div class="avatar">
                                        <div class="avatar-circle">
                                            {{ substr($reply->user->first_name,0,1) }}
                                            {{ substr($reply->user->last_name,0,1) }}
                                        </div>
                                    </div>
                                    <div class="message-bubble">
                                        <div class="message-sender">
                                            {{ $reply->user->first_name }}
                                            {{ $reply->user->last_name }}
                                        </div>
                                        <div class="message-content">
                                            <p>{{ $reply->message }}</p>
                                        </div>
                                        <div class="message-info">
                                            <span class="message-time">
                                                {{ $reply->created_at->format('M d, H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Message Input Area --}}
                    @if(! in_array($ticket->status, ['resolved','closed']))
                        <div class="chat-input-area p-3 border-top">
                            <form id="reply-form"
                                  method="POST"
                                  action="{{ route('admin.support.reply', $ticket) }}"
                                  class="d-flex align-items-center">
                                @csrf
                                <div class="input-group">
                                    <input name="message"
                                           class="form-control"
                                           type="text"
                                           placeholder="Type your reply here..."
                                           required>
                                    <div class="input-group-append">
                                        <button id="send-btn"
                                                type="submit"
                                                class="btn btn-primary">
                                            <i class="simple-icon-paper-plane mr-1"></i>
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="chat-closed-notification p-3 border-top bg-light">
                            <div class="text-center py-2">
                                <i class="simple-icon-lock text-muted mb-2"
                                   style="font-size: 24px;"></i>
                                <p class="text-muted mb-0">
                                    This ticket is {{ $ticket->status }}. You cannot reply.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Ticket Information Sidebar --}}
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        Ticket Information
                    </h5>

                    @php
                        $badge = match($ticket->status) {
                            'open'        => 'primary',
                            'in_progress' => 'warning',
                            'resolved'    => 'success',
                            'closed'      => 'secondary',
                            default       => 'light',
                        };
                    @endphp

                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            Status:
                        </span>
                        <span class="badge badge-pill badge-{{ $badge }} ml-2">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </div>
                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            Customer:
                        </span>
                        <span class="ticket-info-value">
                            {{ $ticket->user->first_name }} {{ $ticket->user->last_name }}
                        </span>
                    </div>
                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            Email:
                        </span>
                        <span class="ticket-info-value">
                            {{ $ticket->user->email }}
                        </span>
                    </div>
                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            Created:
                        </span>
                        <span class="ticket-info-value">
                            {{ $ticket->created_at->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            Last Updated:
                        </span>
                        <span class="ticket-info-value">
                            {{ $ticket->updated_at->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            ID:
                        </span>
                        <span class="ticket-info-value">#{{ $ticket->id }}</span>
                    </div>
                    <div class="ticket-info-item">
                        <span class="ticket-info-label text-muted">
                            Replies:
                        </span>
                        <span class="ticket-info-value">
                            {{ $ticket->replies->count() }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Customer Information --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        Customer Information
                    </h5>
                    
                    <div class="customer-profile mb-3 text-center">
                        <div class="avatar-circle mx-auto mb-3" style="width: 80px; height: 80px; font-size: 24px;">
                            {{ substr($ticket->user->first_name,0,1) }}
                            {{ substr($ticket->user->last_name,0,1) }}
                        </div>
                        <h6 class="mb-1">{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</h6>
                        <p class="text-muted mb-0">{{ $ticket->user->email }}</p>
                    </div>
                    
                    <div class="customer-stats mt-4">
                        <div class="row text-center">
                            <div class="col-6">
                                <h5>{{ $ticket->user->supportTickets->count() }}</h5>
                                <p class="text-muted mb-0 small">Tickets</p>
                            </div>
                            <div class="col-6">
                                <h5>{{ $ticket->user->supportTickets->where('status', 'closed')->count() }}</h5>
                                <p class="text-muted mb-0 small">Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('manageUsers.show', $ticket->user->id) }}" class="btn btn-outline-primary btn-block">
                            <i class="simple-icon-user mr-1"></i> View Customer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Chat Container Styles */
    .chat-container {
        display: flex;
        flex-direction: column;
        height: 65vh;
    }
    
    .chat-messages {
        flex: 1;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }
    
    /* Message Group Styles */
    .message-group {
        display: flex;
        margin-bottom: 20px;
        max-width: 80%;
    }
    
    .message-group.incoming {
        align-self: flex-start;
    }
    
    .message-group.outgoing {
        align-self: flex-end;
        justify-content: flex-end;
    }
    
    /* Avatar Styles */
    .avatar {
        margin-right: 12px;
        align-self: flex-end;
    }
    
    .avatar-circle {
        width: 36px;
        height: 36px;
        background-color: #5D87FF;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 14px;
    }
    
    /* Message Bubble Styles */
    .message-bubble {
        padding: 12px 15px;
        border-radius: 18px;
        position: relative;
    }
    
    .incoming .message-bubble {
        background-color: #f1f3f4;
        border-bottom-left-radius: 5px;
    }
    
    .outgoing .message-bubble {
        background-color: #e1f5fe;
        border-bottom-right-radius: 5px;
    }
    
    .message-sender {
        font-weight: bold;
        margin-bottom: 4px;
        font-size: 14px;
    }
    
    .message-content p {
        margin-bottom: 0;
        word-wrap: break-word;
    }
    
    .message-info {
        display: flex;
        justify-content: flex-end;
        margin-top: 5px;
        font-size: 11px;
        color: #999;
    }
    
    .message-time {
        margin-right: 5px;
    }
    
    /* Ticket Info Styles */
    .ticket-info-item {
        display: flex;
        align-items: center;
    }
    
    .ticket-info-label {
        font-weight: 600;
        min-width: 100px;
    }
    
    /* Customer Profile Styles */
    .customer-profile .avatar-circle {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Status selector styles */
    .ticket-status form {
        margin-bottom: 0;
    }
    
    /* Mobile responsive adjustments */
    @media (max-width: 768px) {
        .card-header .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .ticket-title {
            margin-bottom: 1rem;
        }
        
        .ticket-status form {
            flex-wrap: wrap;
        }
    }

    /* Fix for gap utility in older Bootstrap versions */
    .gap-3 {
        gap: 1rem !important;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-scroll to bottom of messages
        const chatMessages = document.querySelector('.chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Disable send button on submit
        const form = document.getElementById('reply-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                document.getElementById('send-btn').disabled = true;
            });
        }

        // Auto-submit form on status change
        const statusSelect = document.getElementById('status-select');
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                document.getElementById('status-form').submit();
            });
        }
    });
</script>
@endpush
@endsection