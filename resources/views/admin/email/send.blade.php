@extends('admin.layout.app')

@section('title', 'Send Dynamic Email')

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.email.send') }}" method="POST" id="emailForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Send To (Email)</label>
                        <input type="email" class="form-control" name="to" required>
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Language</label>
                        <select name="lang" class="form-control">
                            <option value="en">English</option>
                            <option value="ar">Arabic</option>
                        </select>
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Email Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Content</label>
                        <div id="editor" style="height:250px;">
                            {!! old('content') !!}
                        </div>
                        <input type="hidden" id="content" name="content">
                    </div>

                    <button class="btn btn-primary w-100">Send Email</button>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<link href="{{ asset('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet"/>
<script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    var quill = new Quill('#editor', { theme: 'snow' });

    document.getElementById("emailForm").addEventListener("submit", () => {
        document.getElementById("content").value = quill.root.innerHTML;
    });
});
</script>
@endpush
