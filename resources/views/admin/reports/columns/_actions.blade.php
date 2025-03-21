<td>
    <form action="{{ route('updateStatus', $report->id) }}" method="POST" class="d-inline" id="status-form-{{ $report->id }}">
        @csrf
        @method('PUT')
        <select name="status" class="form-select form-select-sm {{ in_array($report->status, ['reviewed', 'resolved', 'rejected']) ? 'disabled-select' : '' }}"
            onchange="confirmSubmit(event, {{ $report->id }}, this)"
            {{ in_array($report->status, ['reviewed', 'resolved', 'rejected']) ? 'disabled' : '' }}>
            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="reviewed" {{ $report->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
            <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
            <option value="rejected" {{ $report->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </form>
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
        if (confirm(`Are you sure you want to change the status to "${selectedStatus}"?`)) {
            document.getElementById('status-form-' + reportId).submit();
        } else {
            event.preventDefault();
        }
    }
</script>
