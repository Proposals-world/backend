@extends('admin.layout.app')

@section('title', 'Privacy Policy')
@section('page-title', 'Admin Dashboard - Privacy Policy')
@section('subtitle', 'Manage Privacy Policy')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">Privacy Policy List</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">Tables</a></li>
                        <li class="breadcrumb-item active">Privacy Policy</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
              @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- ❌ Error message --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- ✅ Redirect to create page --}}
                        <a href="{{ route('privacy.create') }}" class="btn btn-primary mb-3">
                            Add New
                        </a>

                        <div class="table-responsive">
                            {{ $dataTable->table([
                                'class' => 'table table-bordered table-hover w-100',
                                'style' => 'width:100% !important'
                            ]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts() }}
<script>
    remove('remove_btn', 'admin/privacy', 'privacy-table', '{{ csrf_token() }}');
</script>
@endpush
