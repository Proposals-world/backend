@extends('user.layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-8">
            {{-- Chat Main Area --}}
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-white pt-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <a href="{{ route('user.support') }}"
                               class="btn btn-sm btn-outline-secondary mr-2">
                                <i class="simple-icon-arrow-left"></i>
                                {{ __('userDashboard.support.back') }}
                            </a>
                            <span class="h5 mb-0">
                                {{ __('userDashboard.support.ticket') }}
                                #{{ $ticket->id }}:
                                {{ $ticket->subject }}
                            </span>
                        </div>
                        @if(in_array($ticket->status, ['open','in_progress']))
                            <form method="POST"
                                  action="{{ route('user.support.close', $ticket) }}"
                                  class="d-inline">
                                @csrf
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger">
                                    {{ __('userDashboard.support.close_ticket') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="chat-container">
                    {{-- Messages Area --}}
                    <div class="chat-messages p-3">
                        {{-- Initial Ticket Message --}}
                        <div class="message-group outgoing">
                            <div class="message-bubble">
                                <div class="message-content">
                                    <p>{{ $ticket->description }}</p>
                                </div>
                                <div class="message-info">
                                    <span class="message-time">
                                        {{ $ticket->created_at->format('M d, H:i') }}
                                    </span>
                                    <span class="message-status">
                                        <i class="simple-icon-check"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Replies --}}
                        @foreach($ticket->replies as $reply)
                            @if($reply->user_id === auth()->id())
                                {{-- User Message --}}
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
                                {{-- Support Message --}}
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
                                  action="{{ route('user.support.reply', $ticket) }}"
                                  class="d-flex align-items-center">
                                @csrf
                                <div class="input-group">
                                    <input name="message"
                                           class="form-control"
                                           type="text"
                                           placeholder="{{ __('userDashboard.support.type_message') }}"
                                           required>
                                    <div class="input-group-append">
                                        <button id="send-btn"
                                                type="submit"
                                                class="btn btn-primary">
                                            <i class="simple-icon-paper-plane mr-1"></i>
                                            {{ __('userDashboard.support.send') }}
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
                                    {{ __('userDashboard.support.ticket_closed') }}
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
                        {{ __('userDashboard.support.ticket_info') }}
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
                            {{ __('userDashboard.support.status') }}:
                        </span>
                        <span class="badge badge-pill badge-{{ $badge }} ml-2">
                            {{ __('userDashboard.support.' . $ticket->status) }}
                        </span>
                    </div>
                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            {{ __('userDashboard.support.created') }}:
                        </span>
                        <span class="ticket-info-value">
                            {{ $ticket->created_at->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            {{ __('userDashboard.support.last_updated') }}:
                        </span>
                        <span class="ticket-info-value">
                            {{ $ticket->updated_at->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="ticket-info-item mb-3">
                        <span class="ticket-info-label text-muted">
                            {{ __('userDashboard.support.id') }}:
                        </span>
                        <span class="ticket-info-value">#{{ $ticket->id }}</span>
                    </div>
                    <div class="ticket-info-item">
                        <span class="ticket-info-label text-muted">
                            {{ __('userDashboard.support.replies') }}:
                        </span>
                        <span class="ticket-info-value">
                            {{ $ticket->replies->count() }}
                        </span>
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
    });
</script>
@endpush
@endsection