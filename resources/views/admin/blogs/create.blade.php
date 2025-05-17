@extends('admin.layout.app')

@section('title', isset($blog) ? 'Edit Blog' : 'Create Blog')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row" class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ isset($blog) ? route('blogs.update', $blog) : route('blogs.store') }}"
                            id="blogForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @isset($blog)
                                @method('PUT')
                            @endisset

                            <div class="row">
                                <!-- Title English -->
                                <div class="col-md-6 mb-3">
                                    <label for="title_en" class="form-label">Title (English)</label>
                                    <input type="text" name="title_en" id="title_en" class="form-control"
                                        value="{{ old('title_en', $blog->title_en ?? '') }}">
                                    @error('title_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Title Arabic -->
                                <div class="col-md-6 mb-3">
                                    <label for="title_ar" class="form-label">Title (Arabic)</label>
                                    <input type="text" name="title_ar" id="title_ar" class="form-control"
                                        value="{{ old('title_ar', $blog->title_ar ?? '') }}">
                                    @error('title_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Categories -->
                                <div class="col-md-6 mb-3">
                                    <label for="categories" class="form-label">Categories</label>
                                    <select name="categories[]" id="categories"
                                        class="select2 form-control select2-multiple" multiple="multiple"
                                        data-toggle="select2" data-placeholder="Choose Categories...">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ isset($blog) && $blog->categories->contains($category->id) ? 'selected' : '' }}>
                                                {{ $category->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categories')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="draft"
                                            {{ old('status', $blog->status ?? 'draft') == 'draft' ? 'selected' : '' }}>
                                            Draft</option>
                                        <option value="published"
                                            {{ old('status', $blog->status ?? '') == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Content Editors -->
                            <div class="mb-3">
                                <label for="content_en" class="form-label">Content (English)</label>
                                <div id="editor-en" style="height: 200px;">{!! old('content_en', $blog->content_en ?? '') !!}</div>
                                <input type="hidden" name="content_en" id="content_en">
                                @error('content_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content_ar" class="form-label">Content (Arabic)</label>
                                <div id="editor-ar" style="height: 200px; direction: rtl;" dir="rtl">{!! old('content_ar', $blog->content_ar ?? '') !!}</div>
                                <input type="hidden" name="content_ar" id="content_ar">
                                @error('content_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Featured Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if (isset($blog) && $blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" class="mt-2 img-thumbnail" width="150">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin/assets/vendor/select2/js/select2.min.js') }}"></script>
    <link href="{{ asset('admin/assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet" />

    <!-- Quill Editor -->
    <script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // English Editor
            var quillEn = new Quill('#editor-en', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'header': 1 }, { 'header': 2 }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'script': 'sub' }, { 'script': 'super' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'ltr' }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                        ['clean'],
                        ['link', 'image', 'video']
                    ]
                }
            });

            // Arabic Editor with RTL configuration
            var quillAr = new Quill('#editor-ar', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'header': 1 }, { 'header': 2 }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'script': 'sub' }, { 'script': 'super' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                        ['clean'],
                    ]
                }
            });
            
            // Set default direction for Arabic editor
            quillAr.format('direction', 'rtl');
            quillAr.format('align', 'right');
            
            // Apply RTL to the Quill container elements
            document.querySelector('#editor-ar .ql-editor').setAttribute('dir', 'rtl');
            
            document.getElementById("blogForm").addEventListener("submit", function() {
                document.getElementById("content_en").value = quillEn.root.innerHTML;
                document.getElementById("content_ar").value = quillAr.root.innerHTML;
            });

            // Initialize Select2
            $('#categories').select2();
        });
    </script>
@endpush
