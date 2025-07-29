@extends('admin.layout.app')

@section('title', 'Suspended Users')

@section('page-title', 'Admin Dashboard - Suspended Users')

@section('subtitle', 'Automatically Blocked Users')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">Automatically Blocked Users</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Suspended Users</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table table-bordered table-hover w-100']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts() }}
@endpush    
