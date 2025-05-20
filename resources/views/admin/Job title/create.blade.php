@if (isset($jobTitle))
    <form action="{{ route('job-titles.update', $jobTitle) }}" id="JobTitleForm" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('job-titles.store') }}" id="JobTitleForm" method="POST">
@endif
@csrf
<div class="mb-3">
    <label for="name_en" class="form-label">Name (English)</label>
    <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $jobTitle->name_en ?? '' }}">
</div>
<div class="mb-3">
    <label for="name_ar" class="form-label">Name (Arabic)</label>
    <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $jobTitle->name_ar ?? '' }}">
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
