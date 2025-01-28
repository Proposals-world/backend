@if (isset($drinkingStatus))
    <form action="{{ route('drinking-statuses.update', $drinkingStatus) }}" id="drinkingStatusForm" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('drinking-statuses.store') }}" id="drinkingStatusForm" method="POST">
@endif
@csrf
<div class="mb-3">
    <label for="name_en" class="form-label">Name (English)</label>
    <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $drinkingStatus->name_en ?? '' }}">
</div>
<div class="mb-3">
    <label for="name_ar" class="form-label">Name (Arabic)</label>
    <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $drinkingStatus->name_ar ?? '' }}">
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
