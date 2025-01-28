@if (isset($city))
    <form action="{{ route('cities.update', $city) }}" id="cityForm" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('cities.store') }}" id="cityForm" method="POST">
@endif
@csrf
<div class="mb-3">
    <label for="country_id" class="form-label">Country</label>
    <select name="country_id" id="country_id" class="form-control" required>
        <option value="">Select a country</option>
        @foreach($countries as $country)
            <option value="{{ $country->id }}" {{ isset($city) && $city->country_id == $country->id ? 'selected' : '' }}>
                {{ $country->name_en }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="name_en" class="form-label">Name (English)</label>
    <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $city->name_en ?? '' }}">
</div>
<div class="mb-3">
    <label for="name_ar" class="form-label">Name (Arabic)</label>
    <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $city->name_ar ?? '' }}">
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
