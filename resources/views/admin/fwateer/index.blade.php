@extends('admin.layout.app')

@section('title', 'Invoices')
@section('page-title', 'Invoices Dashboard - Fwateer')
@section('subtitle', 'Invoices List')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">Invoices List</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Invoices</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-12">
                <div class="row mb-3">
    <div class="col-md-3">
        <select id="filterMonth" class="form-control">
            <option value="">All Months</option>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-3">
        <select id="filterYear" class="form-control">
            <option value="">All Years</option>
            @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                <option value="{{ $y }}">{{ $y }}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-3">
        <button id="filterBtn" class="btn btn-primary">Filter</button>
        <button id="resetBtn" class="btn btn-secondary">Reset</button>
    </div>
</div>

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
    <link rel="stylesheet" href="{{ asset('vendor/datatables/buttons.bootstrap4.min.css') }}">
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    <script>
    $(document).ready(function () {
        const table = $('#fwateer-table').DataTable();

        $('#filterBtn').click(function() {
            let month = $('#filterMonth').val();
            let year = $('#filterYear').val();
            let url = "{{ route('fwateer.index') }}" + '?month=' + month + '&year=' + year;

            // reload with new filters
            table.ajax.url(url).load();
        });

        $('#resetBtn').click(function() {
            $('#filterMonth').val('');
            $('#filterYear').val('');
            table.ajax.url("{{ route('fwateer.index') }}").load();
        });
    });
</script>

@endpush
