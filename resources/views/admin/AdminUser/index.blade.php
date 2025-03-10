@extends('admin.layout.app')

@section('title', 'Admin')

@section('page-title', 'Admin Dashboard - Admin')

@section('subtitle', 'Admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Admin List</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Jidox</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Admin List</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Admin List</h4>
                            <a class="btn btn-primary mb-3" id="add_btn">Add Admin</a>
                            <div class="table-responsive">
                                {{ $dataTable->table([
                                    'class' => 'table table-bordered table-hover  w-100',
                                    'style' => 'width:100% !important'
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" >
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
    addModal('add_btn', '{{ route('manageAdmins.create') }}', 'Add Admin ', 'userForm', 'users-table');
    editModal('edit_btn', 'admin/manageAdmins', 'Edit Admin', 'userForm', 'users-table');
    remove('remove_btn', 'admin/manageAdmins', 'users-table', '{{ csrf_token() }}');
</script>
@endpush

