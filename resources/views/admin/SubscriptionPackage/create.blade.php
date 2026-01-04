<style>
/* Make select scrollable for long lists and responsive */
.country-group-select {
    max-height: 200px; /* height of dropdown when open */
    overflow-y: auto;   /* vertical scroll if too long */
    width: 100%;        /* full width on mobile */
}
</style>
@if (isset($subscriptionPackage))
    <form action="{{ route('subscription-packages.update', $subscriptionPackage->id) }}" id="subscriptionPackageForm" method="POST">
        @method('PUT')
        <input type="hidden" name="subscription_package_id" value="{{ $subscriptionPackage->id }}">
@else
    <form action="{{ route('subscription-packages.store') }}" id="subscriptionPackageForm" method="POST">
@endif
    @csrf

    <!-- Package Name (English) -->
    <div class="mb-3">
        <label for="package_name_en" class="form-label">Package Name (English)</label>
        <input type="text" name="package_name_en" id="package_name_en" class="form-control"
               value="{{ old('package_name_en', $subscriptionPackage->package_name_en ?? '') }}" required>
        @error('package_name_en')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Package Name (Arabic) -->
    <div class="mb-3">
        <label for="package_name_ar" class="form-label">Package Name (Arabic)</label>
        <input type="text" name="package_name_ar" id="package_name_ar" class="form-control"
               value="{{ old('package_name_ar', $subscriptionPackage->package_name_ar ?? '') }}" required>
        @error('package_name_ar')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control"
               value="{{ old('price', $subscriptionPackage->price ?? '') }}" required>
        @error('price')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Target Gender -->
    <div class="mb-3">
        <label for="target_gender" class="form-label">Target Gender</label>
        <select name="target_gender" id="target_gender" class="form-control" onchange="toggleFields()" required>
            @php($selectedGender = old('gender', $subscriptionPackage->gender ?? 'male'))
            <option value="male" {{ $selectedGender === 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $selectedGender === 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('gender')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Contact Limit (For Men) -->
    <div class="mb-3 d-none" id="contactLimitContainer">
        <label for="contact_limit" class="form-label">Contact Limit <span class="text-muted">(For Men)</span></label>
        <input type="number" name="contact_limit" id="contact_limit" class="form-control"
               value="{{ old('contact_limit', $subscriptionPackage->contact_limit ?? '') }}" min="0">
        @error('contact_limit')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Duration (For Women) -->
    <div class="mb-3 d-none" id="durationContainer">
        <label for="duration" class="form-label">Duration In Days <span class="text-muted">(For Women)</span></label>
        <input type="number" name="duration" id="duration" class="form-control"
               value="{{ old('duration', $subscriptionPackage->duration ?? '') }}" min="0">
        @error('duration')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- One-time Package -->
    <div class="mb-3 form-check">
        <input type="checkbox" name="is_one_time" id="is_one_time" class="form-check-input"
               value="1" {{ old('is_one_time', $subscriptionPackage->is_one_time ?? false) ? 'checked' : '' }}>
        <label for="is_one_time" class="form-check-label">One-time Package</label>
    </div>

    <!-- Fintesa Product ID -->
    <div class="mb-3">
        <label for="fintesa_product_id" class="form-label">Fintesa Product ID</label>
        <input type="text" name="fintesa_product_id" id="fintesa_product_id" class="form-control"
               value="{{ old('fintesa_product_id', $subscriptionPackage->fintesa_product_id ?? '') }}">
        @error('fintesa_product_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Fintesa Price ID -->
    <div class="mb-3">
        <label for="fintesa_price_id" class="form-label">Fintesa Price ID</label>
        <input type="text" name="fintesa_price_id" id="fintesa_price_id" class="form-control"
               value="{{ old('fintesa_price_id', $subscriptionPackage->fintesa_price_id ?? '') }}">
        @error('fintesa_price_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Payment URL -->
    <div class="mb-3">
        <label for="payment_url" class="form-label">Payment URL</label>
        <input type="url" name="payment_url" id="payment_url" class="form-control"
               value="{{ old('payment_url', $subscriptionPackage->payment_url ?? '') }}">
        @error('payment_url')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Country Group -->
    <div class="mb-3">
        <label for="country_group_id" class="form-label">Country Group</label>
        <select name="country_group_id" id="country_group_id" class="form-control">
            <option value="">-- Select Country Group --</option>
            @foreach($countryGroups as $group)
                <option value="{{ $group->id }}"
                    {{ old('country_group_id', $subscriptionPackage->country_group_id ?? '') == $group->id ? 'selected' : '' }}>
                    {{ $group->name_en }}
                </option>
            @endforeach
        </select>
        @error('country_group_id')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Default Package -->
    <div class="mb-3 form-check">
        <input type="checkbox" name="is_default" id="is_default" class="form-check-input"
               value="1" {{ old('is_default', $subscriptionPackage->is_default ?? false) ? 'checked' : '' }}>
        <label for="is_default" class="form-check-label">Default Package</label>
    </div>

    <!-- Special Offer -->
    <div class="mb-3 form-check">
        <input type="checkbox" name="is_special_offer" id="is_special_offer" class="form-check-input"
               value="1" {{ old('is_special_offer', $subscriptionPackage->is_special_offer ?? false) ? 'checked' : '' }}>
        <label for="is_special_offer" class="form-check-label">Special Offer</label>
    </div>
<!-- Hide Package -->
<input type="hidden" name="hide_package" value="0">
<div class="mb-3 form-check">
    <input type="checkbox" name="hide_package" id="hide_package" class="form-check-input"
           value="1" {{ old('hide_package', $subscriptionPackage->hide_package ?? false) ? 'checked' : '' }}>
    <label for="hide_package" class="form-check-label">Hide Package</label>
</div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>
<script>
(function () {
    const contactLimitContainer = document.getElementById('contactLimitContainer');
    const durationContainer = document.getElementById('durationContainer');

    window.toggleFields = function () {
        const genderSelect = document.getElementById('target_gender');
        if (!genderSelect || !contactLimitContainer || !durationContainer) return;

        if (genderSelect.value === 'male') {
            contactLimitContainer.classList.remove('d-none');
            durationContainer.classList.remove('d-none'); // show both
        } else if (genderSelect.value === 'female') {
            contactLimitContainer.classList.add('d-none'); // hide contact
            durationContainer.classList.remove('d-none');  // show duration only
        } else {
            contactLimitContainer.classList.add('d-none');
            durationContainer.classList.add('d-none');
        }
    };

    // Call once when the page loads
    window.toggleFields();
})();
</script>
