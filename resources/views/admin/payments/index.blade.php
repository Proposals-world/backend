@extends('admin.layout.app')

@section('title', 'Payments Transactions')

@section('page-title', 'Admin Dashboard - Payments Transactions')

@section('subtitle', 'Payment Transactions')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Payments Transactions</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payments</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                {{ $dataTable->table([
                                    'class' => 'table table-bordered table-hover w-100',
                                    'style' => 'width:100% !important'
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endpush --}}

@push('scripts')
{{ $dataTable->scripts() }}

<script>
    // Add export buttons if needed
    $(document).ready(function() {
        $('#payment-transactions-table').DataTable().buttons().container().appendTo('#payment-transactions-table_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush
