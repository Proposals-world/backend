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
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#subscribeModal">
                                Subscribe User
                            </button>
                            <div class="table-responsive">
                                {{ $dataTable->table([
                                    'class' => 'table table-bordered table-hover w-100',
                                    'style' => 'width:100% !important'
                                ]) }}
                            </div>
                        </div>
                    </div>
                    <!-- Button to open the modal -->


<!-- Subscribe Modal -->
<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true" style="height: auto;
">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="subscribeModalLabel">Subscribe User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label for="user-select-dropdown" class="form-label">Select User:</label>
          <select id="user-select-dropdown" class="form-select">
            <option value="">-- Select user --</option>
            @foreach(\App\Models\User::all() as $user)
              <option value="{{ $user->email }}">{{ $user->first_name }} ({{ $user->email }})</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="package-select-dropdown" class="form-label">Select Package:</label>
          <select id="package-select-dropdown" class="form-select">
            <option value="">-- Select package --</option>
            @foreach(\App\Models\SubscriptionPackage::all() as $package)
              <option value="{{ $package->id }}">{{ $package->package_name_en }} ({{ $package->price }}) ({{ $package->gender }})</option>
            @endforeach
          </select>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="subscribe-user-btn" data-payment-id="1" class="btn btn-primary">Subscribe</button>
      </div>
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
$(document).on('click', '.save-payment', function() {
    let id = $(this).data('id');
    let final_amount = $('.amount-input[data-id="'+id+'"]').val();
    let reference_number = $('.ref-input[data-id="'+id+'"]').val();

    $.ajax({
        url: '{{ route("admin.user.payments.update-details") }}',
        method: 'POST',
        data: {
            payment_id: id,
            final_amount: final_amount,
            reference_number: reference_number,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            alert(response.message);
            $('#userpayments-table').DataTable().ajax.reload();

        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON?.message || 'Error updating payment.');
        }
    });
});



$(document).on('click', '.subscribe-btn', function() {
    let email = $(this).data('email');
    let packageId = $(this).data('package-id');
    let paymentId = $(this).data('payment-id');
    if (!packageId) {
        alert('Package ID not found');
        return;
    }

    $.ajax({
        url: '{{ route("admin.payments.subscribe-for-user") }}',
        type: 'GET',
        data: {
            email: email,
            package_id: packageId,
            payment_id: paymentId
        },
        success: function(res) {
            alert(res.message || 'Subscribed successfully');
            $('#userpayments-table').DataTable().ajax.reload();
        },
        error: function(err) {
            if (err.status === 404 && err.responseJSON && err.responseJSON.users) {
                // Show dropdown to select user
                let users = err.responseJSON.users;
                let options = users.map(u => `<option value="${u.id}">${u.name} (${u.email})</option>`).join('');
                let dropdownHtml = `
                    <div id="user-select-modal">
                        <label>Select a user:</label>
                        <select id="user-select">${options}</select>
                        <button id="confirm-user-select">Confirm</button>
                    </div>
                `;
                $('body').append(dropdownHtml);

                $('#confirm-user-select').on('click', function() {
                    let userId = $('#user-select').val();
                    // Retry subscription with selected user ID
                    $.ajax({
                        url: '{{ route("admin.payments.subscribe-for-user") }}',
                        type: 'POST',
                        data: {
                            user_id: userId,
                            package_id: packageId
                        },
                        success: function(res2) {
                            alert(res2.message || 'Subscribed successfully');
                            $('#userpayments-table').DataTable().ajax.reload();
                            $('#user-select-modal').remove();
                        }
                    });
                });
            } else {
                let errorMsg = err.responseJSON?.message || 'Subscription failed';
                alert(errorMsg);
                console.error(err);
            }
        }
    });
});
$(document).on('click', '#subscribe-user-btn', function() {
    let email = $('#user-select-dropdown').val();
    let packageId = $('#package-select-dropdown').val();
    let paymentId = 1;
    if (!email || !packageId) {
        alert('Please select both a user and a package');
        return;
    }

    $.ajax({
        url: '{{ route("admin.payments.subscribe-for-user") }}',
        type: 'get',
        data: {
            email: email,
            package_id: packageId,
            payment_id: paymentId
        },
        success: function(res) {
            alert(res.message || 'User subscribed successfully');
            $('#userpayments-table').DataTable().ajax.reload(); // reload table
            $('#subscribeModal').modal('hide');
            $('#user-select-dropdown').val('');
            $('#package-select-dropdown').val('');
        },
        error: function(err) {
            let errorMsg = err.responseJSON?.message || 'Subscription failed';
            alert(errorMsg);
            console.error(err);
        }
    });
});

</script>
@endpush
