@extends('user.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section with Stats -->
    <div class="row mb-4 pt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="mb-0">{{ __('userDashboard.support.title') }}</h1>
                        <p class="text-muted">{{ __('userDashboard.support.manage') }}</p>
                    </div>
                    <a href="{{ route('user.support.create') }}" class="btn btn-primary btn-lg">
                        <i class="simple-icon-plus mr-2"></i>{{ __('userDashboard.support.create') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ticket Status Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="filter-buttons-container">
                        <a href="{{ route('user.support', ['status'=>'open']) }}"
                           class="btn btn-outline-primary filter-btn {{ request('status')=='open'?'active':'' }}">
                            <span class="badge badge-pill badge-primary mr-2">
                                {{ $tickets->where('status', 'open')->count() }}
                            </span>
                            {{ __('userDashboard.support.open') }}
                        </a>
                        <a href="{{ route('user.support', ['status'=>'in_progress']) }}"
                           class="btn btn-outline-warning filter-btn {{ request('status')=='in_progress'?'active':'' }}">
                            <span class="badge badge-pill badge-warning mr-2">
                                {{ $tickets->where('status', 'in_progress')->count() }}
                            </span>
                            {{ __('userDashboard.support.in_progress') }}
                        </a>
                        <a href="{{ route('user.support', ['status'=>'resolved']) }}"
                           class="btn btn-outline-success filter-btn {{ request('status')=='resolved'?'active':'' }}">
                            <span class="badge badge-pill badge-success mr-2">
                                {{ $tickets->where('status', 'resolved')->count() }}
                            </span>
                            {{ __('userDashboard.support.resolved') }}
                        </a>
                        <a href="{{ route('user.support', ['status'=>'closed']) }}"
                           class="btn btn-outline-secondary filter-btn {{ request('status')=='closed'?'active':'' }}">
                            <span class="badge badge-pill badge-secondary mr-2">
                                {{ $tickets->where('status', 'closed')->count() }}
                            </span>
                            {{ __('userDashboard.support.closed') }}
                        </a>
                        <a href="{{ route('user.support') }}"
                           class="btn btn-outline-dark filter-btn {{ request('status')===null?'active':'' }}">
                            <span class="badge badge-pill badge-dark mr-2">
                                {{ $tickets->count() }}
                            </span>
                            {{ __('userDashboard.support.all') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tickets List -->
    <div class="row">
        <div class="col-12">
            @if($tickets->isEmpty())
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <img src="{{ asset('frontend/img/bg/support-image.png') }}"
                             alt="{{ __('userDashboard.support.no_tickets') }}"
                             class="img-fluid mb-4"
                             style="max-height: 150px;">
                        <h3>{{ __('userDashboard.support.no_tickets') }}</h3>
                        <p class="text-muted mb-4">{{ __('userDashboard.support.no_tickets_desc') }}</p>
                        <a href="{{ route('user.support.create') }}" class="btn btn-primary">
                            <i class="simple-icon-plus mr-2"></i>{{ __('userDashboard.support.create_first') }}
                        </a>
                    </div>
                </div>
            @else
                <div class="ticket-list">
                    @foreach($tickets as $ticket)
                        <div class="card ticket-card shadow-sm mb-3 hover-card">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <!-- Status Indicator -->
                                    <div class="col-1">
                                        @php
                                            $statusColor = match($ticket->status) {
                                                'open'        => 'primary',
                                                'in_progress' => 'warning',
                                                'resolved'    => 'success',
                                                'closed'      => 'secondary',
                                                default       => 'light',
                                            };
                                        @endphp
                                        <div class="ticket-status-indicator bg-{{ $statusColor }} h-100"></div>
                                    </div>

                                    <!-- Ticket Info -->
                                    <div class="col-11">
                                        <div class="d-flex p-3 align-items-center">
                                            <div class="ticket-icon mr-3">
                                                <span class="ticket-icon-circle bg-light">
                                                    <i class="simple-icon-bubbles text-{{ $statusColor }}"></i>
                                                </span>
                                            </div>

                                            <div class="ticket-details flex-grow-1">
                                                <h5 class="mb-1">
                                                    <a href="{{ route('user.support.show', $ticket->id) }}"
                                                       class="text-body stretched-link">
                                                        #{{ $ticket->id }}: {{ $ticket->subject }}
                                                    </a>
                                                </h5>
                                                <p class="text-muted mb-0 small">
                                                    {{ \Illuminate\Support\Str::limit($ticket->description, 100) }}
                                                </p>
                                            </div>

                                            <div class="ticket-meta text-right">
                                                <div class="d-flex flex-column">
                                                    <span class="badge badge-pill badge-{{ $statusColor }} mb-2">
                                                        {{ __('userDashboard.support.' . $ticket->status) }}
                                                    </span>
                                                    <span class="text-muted small">
                                                        <i class="simple-icon-clock mr-1"></i>
                                                        {{ $ticket->created_at->diffForHumans() }}
                                                    </span>
                                                    <span class="text-muted small">
                                                        <i class="simple-icon-bubbles mr-1"></i>
                                                        {{ $ticket->replies_count }} {{ __('userDashboard.support.replies') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .ticket-list .ticket-card {
        transition: all 0.2s ease;
        border-left: none;
    }
    .ticket-list .hover-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
    }
    .ticket-status-indicator {
        width: 6px;
        border-radius: 3px 0 0 3px;
    }
    .ticket-icon-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 50%;
    }
    .ticket-icon-circle i {
        font-size: 20px;
    }
    .stretched-link::after {
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        z-index: 1; pointer-events: auto;
        content: ""; background-color: rgba(0,0,0,0);
    }
    
    /* Responsive filter buttons */
    .filter-buttons-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }
    
    .filter-btn {
        margin-bottom: 5px;
        flex: 0 0 auto;
        white-space: nowrap;
    }
    
    /* Additional responsive adjustments */
    @media (max-width: 768px) {
        .filter-btn {
            font-size: 0.85rem;
            padding: 0.375rem 0.75rem;
        }
    }
    
    @media (max-width: 576px) {
        .filter-buttons-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            width: 100%;
        }
        
        .filter-btn {
            margin: 0;
            text-align: center;
            padding: 0.375rem 0.5rem;
            width: 100%;
        }
        
        .badge {
            display: block;
            margin: 0 auto 5px auto !important;
        }
    }
    
    @media (max-width: 450px) {
        .filter-btn {
            font-size: 0.75rem;
        }
    }
</style>
@endsection