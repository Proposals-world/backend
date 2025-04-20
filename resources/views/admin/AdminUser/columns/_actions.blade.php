<td>
    <div class="d-flex justify-content-around gap-2 mb-2">
        <a href="{{ route('userprofile' ,$user->id ) }}" class="btn btn-sm text-info edit_btn"><i class="ri-eye-line"></i></a>
        <a class="btn btn-sm text-danger remove_btn" id="{{ $user->id }}"><i class="ri-delete-bin-2-line"></i></a>
    </div>

    <!-- Form for activating or deactivating user -->
    @if ($user->status == 'active')
    <form action="{{ route('deactivate', $user->id) }}" method="POST" style="display: inline;" id="status-form-{{ $user->id }}">
    @else
    <form action="{{ route('active', $user->id) }}" method="POST" style="display: inline;" id="status-form-{{ $user->id }}">
    @endif
        @csrf
        @method('PUT') <!-- This makes the request a PUT request -->
        <button type="button" class="btn btn-sm {{ $user->status == 'active' ? 'text-danger' : 'text-info' }}" onclick="confirmStatusChange({{ $user->id }})">
            <i class="{{ $user->status == 'active' ? 'ri-close-line' : 'ri-check-line' }}"></i>
        </button>
    </form>
</td>

<script>
    // Function to show the SweetAlert confirmation
    function confirmStatusChange(userId) {
        // Determine the action based on user status
        const action = document.getElementById(`status-form-${userId}`).action;

        // Show SweetAlert2 confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to change the user status.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById(`status-form-${userId}`).submit();
            }
        });
    }
</script>
