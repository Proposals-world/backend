<td>
    <form action="{{ route('updateStatus', $report->id) }}" method="POST" class="d-inline" id="status-form-{{ $report->id }}">
        @csrf
        @method('PUT')
        <select name="status" class="form-select form-select-sm {{ in_array($report->status, ['reviewed', 'resolved', 'rejected']) ? 'disabled-select' : '' }}"
            onchange="confirmSubmit(event, {{ $report->id }}, this)"
            {{ in_array($report->status, [   'resolved', 'rejected']) ? 'disabled' : '' }}>
            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="reviewed" {{ $report->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
            <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
            <option value="rejected" {{ $report->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </form>
    <a href="{{ route('userprofile', $report->reported_id) }}" class="btn btn-sm text-info w-100 mt-1 border" id="{{ $report->reported_id }}"><i class="ri-eye-line"></i></a>

</td>

<style>
    .disabled-select {
        cursor: not-allowed;
    }
    .form-select:disabled {
        background-color: #e9ecef;
    }
</style>

<script>
    function confirmSubmit(event, reportId, selectElement) {
        const selectedStatus = selectElement.options[selectElement.selectedIndex].text;
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to change the status to "${selectedStatus}".`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('status-form-' + reportId).submit();
            } else {
                selectElement.value = selectElement.getAttribute('data-original-value');
            }
        });
    }

    document.querySelectorAll('select[name="status"]').forEach(select => {
        select.setAttribute('data-original-value', select.value);
        select.addEventListener('change', function() {
            this.setAttribute('data-original-value', this.value);
        });
    });
</script>
