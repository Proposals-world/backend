@extends('admin.layout.app')

@section('title', 'Terms & Conditions')
@section('page-title', 'Admin Dashboard - Terms & Conditions')
@section('subtitle', 'Manage Terms & Conditions')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">Terms & Conditions List</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">Tables</a></li>
                        <li class="breadcrumb-item active">Terms & Conditions</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        {{-- ✅ Redirect to create page instead of opening modal --}}
                        <a href="{{ route('terms.create') }}" class="btn btn-primary mb-3">
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
    // Only keep remove function (edit/add handled via page routes)
    remove('remove_btn', 'admin/terms', 'terms-table', '{{ csrf_token() }}');
</script>
@endpush
