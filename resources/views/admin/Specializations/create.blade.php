@if (isset($specialization))
    <form action="{{ route('specializations.update', $specialization) }}" id="SpecializationForm" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('specializations.store') }}" id="SpecializationForm" method="POST">
@endif
@csrf
<div class="mb-3">
    <label for="name_en" class="form-label">Name (English)</label>
    <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $specialization->name_en ?? '' }}">
</div>
<div class="mb-3">
    <label for="name_ar" class="form-label">Name (Arabic)</label>
    <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $specialization->name_ar ?? '' }}">
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
