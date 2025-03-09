@extends('admin.layout.app')

@section('title', 'Admins')

@section('page-title', 'Admin Dashboard - Admins')

@section('subtitle', 'Admins List')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">Admins List</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Admins</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Admins Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary mb-3" id="add_btn">Add Admin</a>
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table table-bordered table-hover w-100']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Create & Edit -->
<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts() }}

<script>
    addModal('add_btn', '{{ route('admins.create') }}', 'Add Admin', 'adminForm', 'admins-table');
    editModal('edit_btn', 'admin/admins', 'Edit Admin', 'adminForm', 'admins-table');
    remove('remove_btn', 'admin/admins', 'admins-table', '{{ csrf_token() }}');
</script>
@endpush