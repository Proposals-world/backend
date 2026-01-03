<form id="countryGroupForm"
      action="{{ isset($countryGroup)
            ? route('admin.country-groups.update', $countryGroup->id)
            : route('admin.country-groups.store') }}"
      method="POST">
    @csrf
    @if(isset($countryGroup))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Name EN</label>
        <input type="text"
               name="name_en"
               class="form-control"
               value="{{ old('name_en', $countryGroup->name_en ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Name AR</label>
        <input type="text"
               name="name_ar"
               class="form-control"
               value="{{ old('name_ar', $countryGroup->name_ar ?? '') }}">
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($countryGroup) ? 'Update' : 'Create' }}
    </button>
</form>
