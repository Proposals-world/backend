@if (isset($marriageBudget))
    <form action="{{ route('marriage-budgets.update', $marriageBudget) }}" id="marriageBudgetForm" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('marriage-budgets.store') }}" id="marriageBudgetForm" method="POST">
@endif
@csrf
<div class="mb-3">
    <label for="name_en" class="form-label">Name (English)</label>
    <input type="text" name="budget_en" id="name_en" class="form-control" value="{{ $marriageBudget->budget_en ?? '' }}">
</div>
<div class="mb-3">
    <label for="name_ar" class="form-label">Name (Arabic)</label>
    <input type="text" name="budget_ar" id="name_ar" class="form-control" value="{{ $marriageBudget->budget_ar ?? '' }}">
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
