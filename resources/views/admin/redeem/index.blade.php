@extends('admin.layout.app')

@section('title', 'Redeem Contacts')

@section('page-title', 'Admin Dashboard - Redeem Contacts')

@section('subtitle', 'Redeem Contacts')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Redeem Contacts for Male Users</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Redeem Contacts</li>
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

@push('styles')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@push('scripts')
{{ $dataTable->scripts() }}

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('click', '.redeem-btn', function() {
        let userId = $(this).data('id');
        let userName = $(this).data('name');
        let url = "{{ route('admin.redeem', ':id') }}".replace(':id', userId);

        Swal.fire({
            title: 'Confirm Redeem',
            html: `Are you sure you want to redeem 1 contact for <b>${userName}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, redeem it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#redeem-table').DataTable().ajax.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.message || 'Something went wrong',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
