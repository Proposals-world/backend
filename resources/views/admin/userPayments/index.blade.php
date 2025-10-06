@extends('admin.layout.app')

@section('title', 'User Payments')

@section('page-title', 'Admin Dashboard - User Payments')

@section('subtitle', 'User Payments')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">User Payments List</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">User Payments</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <a class="btn btn-primary mb-3" id="add_btn">Add Category</a> --}}
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

    {{-- <!-- Modal -->
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
    </div> --}}
@endsection

@push('scripts')
{{ $dataTable->scripts() }}

<script>
    // addModal('add_btn', '{{ route('categories.create') }}', 'Add Category', 'categoryForm', 'categories-table');
    // editModal('edit_btn', 'admin/categories', 'Edit Category', 'categoryForm', 'categories-table');
    // remove('remove_btn', 'admin/categories', 'categories-table', '{{ csrf_token() }}');

$(document).on('click', '.subscribe-btn', function() {
    let userId = $(this).data('user-id');
    let packageId = $(this).data('package-id');

    if (!userId || !packageId) {
        alert('User ID or Package ID not found');
        return;
    }

    $.ajax({
        url: '{{ route("admin.payments.subscribe-for-user") }}',
        type: 'GET', // or POST depending on your route
        data: {
            user_id: userId,
            package_id: packageId
        },
        success: function(res) {
            alert(res.message || 'Subscribed successfully');
            $('#userpayments-table').DataTable().ajax.reload(); // reload table
        },
        error: function(err) {
            alert(err.responseJSON?.error || 'Subscription failed');
        }
    });
});

</script>
@endpush
