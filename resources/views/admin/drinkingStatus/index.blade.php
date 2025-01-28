@extends('admin.layout.app')

@section('title', 'Drinking Status')

@section('page-title', 'Admin Dashboard - Drinking Status')

@section('subtitle', 'Drinking Status')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Drinking Status List</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Jidox</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Drinking Status List</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Drinking Status List</h4>
                            <a class="btn btn-primary mb-3" id="add_btn">Add Drinking Status</a>
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
    addModal('add_btn', '{{ route('drinking-statuses.create') }}', 'Add Drinking Status ', 'drinkingStatusForm', 'drinking-statuses-table');
    editModal('edit_btn', 'admin/drinking-statuses', 'Edit Drinking Status', 'drinkingStatusForm', 'drinking-statuses-table');
    remove('remove_btn', 'admin/drinking-statuses', 'drinking-statuses-table', '{{ csrf_token() }}');
</script>
@endpush

