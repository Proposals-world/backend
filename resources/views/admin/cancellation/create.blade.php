@extends('admin.layout.app')

@section('title', isset($policy) ? 'Edit Cancellation & Refund Policy' : 'Add Cancellation & Refund Policy')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">{{ isset($policy) ? 'Edit Cancellation & Refund Policy' : 'Add Cancellation & Refund Policy' }}</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('cancellation.index') }}">Admin</a></li>
                        <li class="breadcrumb-item active">{{ isset($policy) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        {{-- ✅ Form --}}
                        @if (isset($policy))
                            <form action="{{ route('cancellation.update', $policy->id) }}" id="policyForm" method="POST">
                                @method('PUT')
                        @else
                            <form action="{{ route('cancellation.store') }}" id="policyForm" method="POST">
                        @endif
                            @csrf

                            {{-- Title English --}}
                            <div class="mb-3">
                                <label class="form-label">Title (English)</label>
                                <input type="text" name="title_en" class="form-control"
                                       value="{{ old('title_en', $policy->title_en ?? '') }}">
                            </div>

                            {{-- Title Arabic --}}
                            <div class="mb-3">
                                <label class="form-label">Title (Arabic)</label>
                                <input type="text" name="title_ar" class="form-control"
                                       value="{{ old('title_ar', $policy->title_ar ?? '') }}">
                            </div>

                            {{-- Content English --}}
                            <div class="mb-3">
                                <label class="form-label">Content (English)</label>
                                <div id="editor-en" style="height: 200px;">{!! old('content_en', $policy->content_en ?? '') !!}</div>
                                <input type="hidden" name="content_en" id="content_en">
                            </div>

                            {{-- Content Arabic --}}
                            <div class="mb-3">
                                <label class="form-label">Content (Arabic)</label>
                                <div id="editor-ar" style="height: 200px;" dir="rtl">{!! old('content_ar', $policy->content_ar ?? '') !!}</div>
                                <input type="hidden" name="content_ar" id="content_ar">
                            </div>

                            {{-- Version & Effective Date --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Version</label>
                                    <input type="text" name="version" class="form-control"
                                           value="{{ old('version', $policy->version ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Effective Date</label>
                                    <input type="date" name="effective_date" class="form-control"
                                           value="{{ old('effective_date', isset($policy->effective_date) ? \Carbon\Carbon::parse($policy->effective_date)->format('Y-m-d') : '') }}">
                                </div>
                            </div>

                            {{-- Active Switch --}}
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                       value="1" {{ old('is_active', $policy->is_active ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                {{ isset($policy) ? 'Update' : 'Save' }}
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
    document.getElementById("policyForm").addEventListener("submit", function() {
        document.getElementById("content_en").value = quillEn.root.innerHTML;
        document.getElementById("content_ar").value = quillAr.root.innerHTML;
    });
});
</script>
@endpush
