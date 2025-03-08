@extends('admin.layout.app')

@section('title', 'Blogs')

@section('page-title', 'Admin Dashboard - Blogs')

@section('subtitle', 'Blogs')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Blogs List</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Blogs</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">Add Blog</a>
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
@endpush