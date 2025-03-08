@if (isset($category))
    <form action="{{ route('categories.update', ['category' => $category->id]) }}" id="categoryForm" method="POST">
        @method('PUT')
@else
    <form action="{{ route('categories.store') }}" id="categoryForm" method="POST">
@endif
    @csrf

    <div class="mb-3">
        <label for="name_en" class="form-label">Name (English)</label>
        <input type="text" name="name_en" id="name_en" class="form-control" value="{{ old('name_en', $category->name_en ?? '') }}">
        @error('name_en')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name_ar" class="form-label">Name (Arabic)</label>
        <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ old('name_ar', $category->name_ar ?? '') }}">
        @error('name_ar')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>