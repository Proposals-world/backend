@if (isset($subscriptionPackage))
    <form action="{{ route('subscription-packages.update', $subscriptionPackage->id) }}" id="subscriptionPackageForm" method="POST">
        @method('PUT')
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

    <!-- Duration in Days -->
    <div class="mb-3">
        <label for="duration_days" class="form-label">Duration (Days)</label>
        <input type="number" name="duration_days" id="duration_days" class="form-control"
               value="{{ old('duration_days', $subscriptionPackage->duration_days ?? '') }}" required>
    </div>

    <!-- Contact Limit -->
    <div class="mb-3">
        <label for="contact_limit" class="form-label">Contact Limit</label>
        <input type="number" name="contact_limit" id="contact_limit" class="form-control"
               value="{{ old('contact_limit', $subscriptionPackage->contact_limit ?? '') }}" required>
    </div>

    <!-- Features Selection -->
    <div class="mb-3">
        <label class="form-label">Select Features</label>
        @foreach($features as $feature)
        @if (isset($subscriptionPackage))
        @php
                // Check if editing and this feature is attached to the package
                $isChecked = $selectedFeatures ? in_array($feature->id, $selectedFeatures) :  null;
            @endphp
            @else
            @php
                $isChecked= null;
            @endphp
            @endif
            <div class="form-check mb-2">
                <!-- Feature Checkbox -->
                <input type="checkbox" name="features[]" id="feature_{{ $feature->id }}" value="{{ $feature->id }}"
                       class="form-check-input" {{ $isChecked ? 'checked' : '' }}>
                <label for="feature_{{ $feature->id }}" class="form-check-label">
                    {{ $feature->name_en }} / {{ $feature->name_ar }}
                </label>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>
