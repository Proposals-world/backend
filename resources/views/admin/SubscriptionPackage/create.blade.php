@if (isset($subscriptionPackage))
    <form action="{{ route('subscription-packages.update', $subscriptionPackage->id) }}" id="subscriptionPackageForm" method="POST">
        @method('PUT')
        <input type="hidden" name="subscription_package_id" id="subscription_package_id" class="form-control" value="{{ $subscriptionPackage->id }}">
@else
    <form action="{{ route('subscription-packages.store') }}" id="subscriptionPackageForm" method="POST">
@endif
    @csrf

    <!-- Package Name (English) -->
    <div class="mb-3">
        <label for="package_name_en" class="form-label">Package Name (English)</label>
        <input type="text" name="package_name_en" id="package_name_en" class="form-control"
               value="{{ old('package_name_en', $subscriptionPackage->package_name_en ?? '') }}" required>
    </div>

    <!-- Package Name (Arabic) -->
    <div class="mb-3">
        <label for="package_name_ar" class="form-label">Package Name (Arabic)</label>
        <input type="text" name="package_name_ar" id="package_name_ar" class="form-control"
               value="{{ old('package_name_ar', $subscriptionPackage->package_name_ar ?? '') }}" required>
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control"
               value="{{ old('price', $subscriptionPackage->price ?? '') }}" required>
    </div>

    <!-- Target Gender -->
    <div class="mb-3">
        <label for="target_gender" class="form-label">Target Gender</label>
<select name="target_gender" id="target_gender" class="form-control" onchange="toggleFields()" required>
            <option value="male" {{ old('target_gender', isset($subscriptionPackage) ? $subscriptionPackage->contact_limit  : '') > 0  ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('target_gender', isset($subscriptionPackage) ? $subscriptionPackage->duration : '') > 0  ? 'selected' : '' }}>Female</option>
        </select>
    </div>

    <!-- Contact Limit (For Men) -->
    <div class="mb-3 d-none" id="contactLimitContainer">
        <label for="contact_limit" class="form-label">Contact Limit <span class="text-muted">(For Men)</span></label>
        <input type="number" name="contact_limit" id="contact_limit" class="form-control"
               value="{{ old('contact_limit', $subscriptionPackage->contact_limit ?? 0) }}">
        {{-- <span class="text-muted">Fill only if the target for the package is men</span> --}}
    </div>

    <!-- Duration (For Women) -->
    <div class="mb-3 d-none" id="durationContainer">
        <label for="duration" class="form-label">Duration In Days <span class="text-muted">(For Women)</span></label>
        <input type="number" name="duration" id="duration" class="form-control"
               value="{{ old('duration', $subscriptionPackage->duration ?? '') }}">
        {{-- <span class="text-muted">Fill only if the target for the package is woman</span> --}}
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>

<script>
(function () {
    // Declare these inside the IIFE so they don't cause duplicate declarations
    const contactLimitContainer = document.getElementById('contactLimitContainer');
    const durationContainer = document.getElementById('durationContainer');

    // Make the function global so it can be used in the select's onchange
    window.toggleFields = function () {
        const genderSelect = document.getElementById('target_gender');

        if (!genderSelect || !contactLimitContainer || !durationContainer) return;

        if (genderSelect.value === 'male') {
            contactLimitContainer.classList.remove('d-none');
            durationContainer.classList.add('d-none');
        } else if (genderSelect.value === 'female') {
            contactLimitContainer.classList.add('d-none');
            durationContainer.classList.remove('d-none');
        } else {
            contactLimitContainer.classList.add('d-none');
            durationContainer.classList.add('d-none');
        }
    };

    // Call once when the page loads
    window.toggleFields();
})();
</script>
