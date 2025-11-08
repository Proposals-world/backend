@extends('admin.layout.app')

@section('title', isset($term) ? 'Edit Terms & Conditions' : 'Add Terms & Conditions')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">{{ isset($term) ? 'Edit Terms & Conditions' : 'Add Terms & Conditions' }}</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('terms.index') }}">Admin</a></li>
                        <li class="breadcrumb-item active">{{ isset($term) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if (isset($term))
                            <form action="{{ route('terms.update', $term->id) }}" id="termsForm" method="POST">
                                @method('PUT')
                        @else
                            <form action="{{ route('terms.store') }}" id="termsForm" method="POST">
                        @endif
                            @csrf

                            {{-- Title English --}}
                            <div class="mb-3">
                                <label class="form-label">Title (English)</label>
                                <input type="text" name="title_en" class="form-control"
                                    value="{{ old('title_en', $term->title_en ?? '') }}">
                                @error('title_en') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Title Arabic --}}
                            <div class="mb-3">
                                <label class="form-label">Title (Arabic)</label>
                                <input type="text" name="title_ar" class="form-control"
                                    value="{{ old('title_ar', $term->title_ar ?? '') }}">
                                @error('title_ar') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Content English --}}
                            <div class="mb-3">
                                <label class="form-label">Content (English)</label>
                                <div id="editor-en" style="height: 250px;">{!! old('content_en', $term->content_en ?? '') !!}</div>
                                <input type="hidden" name="content_en" id="content_en">
                                @error('content_en') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Content Arabic --}}
                            <div class="mb-3">
                                <label class="form-label">Content (Arabic)</label>
                                <div id="editor-ar" style="height: 250px;" dir="rtl">{!! old('content_ar', $term->content_ar ?? '') !!}</div>
                                <input type="hidden" name="content_ar" id="content_ar">
                                @error('content_ar') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Version and Effective Date --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Version</label>
                                    <input type="text" name="version" class="form-control"
                                        value="{{ old('version', $term->version ?? '') }}">
                                    @error('version') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" name="effective_date" class="form-control"
                                        value="{{ old('effective_date', isset($term->effective_date) ? \Carbon\Carbon::parse($term->effective_date)->format('Y-m-d') : '') }}">
                                    @error('effective_date') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Active Switch --}}
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $term->is_active ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                                @error('is_active') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                {{ isset($term) ? 'Update' : 'Save' }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="{{ asset('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" />
<script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // ✅ English Editor (full toolbar like Blog)
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

    // ✅ Arabic Editor (fully mirrored with RTL)
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
                ['link', 'image', 'video']
            ]
        }
    });

    // Force RTL for Arabic editor
    quillAr.format('direction', 'rtl');
    quillAr.format('align', 'right');
    document.querySelector('#editor-ar .ql-editor').setAttribute('dir', 'rtl');

    // ✅ Submit handling
    document.getElementById("termsForm").addEventListener("submit", function() {
        document.getElementById("content_en").value = quillEn.root.innerHTML;
        document.getElementById("content_ar").value = quillAr.root.innerHTML;
    });
});
</script>
@endpush
