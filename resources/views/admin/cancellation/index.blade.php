@extends('admin.layout.app')

@section('title', 'Cancellation & Refund Policy')
@section('page-title', 'Admin Dashboard - Cancellation & Refund Policy')
@section('subtitle', 'Manage Cancellation & Refund Policy')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">Cancellation & Refund Policy List</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">Tables</a></li>
                        <li class="breadcrumb-item active">Cancellation & Refund Policy</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                       @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <div class="card-body">
                        {{-- ✅ Redirect to create page --}}
                        <a href="{{ route('cancellation.create') }}" class="btn btn-primary mb-3">
                            Add New
                        </a>

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

@push('scripts')
{{ $dataTable->scripts() }}
<script>
    remove('remove_btn', 'admin/cancellation', 'cancellation-table', '{{ csrf_token() }}');
</script>
@endpush
