@extends('admin.layout.app')

@section('title', 'Contact Messages')

@section('page-title', 'Admin Dashboard - Contact Messages')

@section('subtitle', 'Contact Messages')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Contact Messages List</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Contact Messages List</li>
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
    // addModal('add_btn', '{{ route('hobbies.create') }}', 'Add Hobby ', 'hobbyForm', 'hobbies-table');
    // editModal('edit_btn', 'admin/hobbies', 'Edit Hobby', 'hobbyForm', 'hobbies-table');
    // remove('remove_btn', 'admin/hobbies', 'hobbies-table', '{{ csrf_token() }}');
</script>
@endpush

