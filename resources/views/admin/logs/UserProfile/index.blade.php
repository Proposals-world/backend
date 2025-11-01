@extends('admin.layout.app')

@section('title', 'User Profile Log')

@section('page-title', 'Admin Dashboard - User Profile Log')

@section('subtitle', 'User Profile Log')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">User Profile Log</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Profile Log</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <a class="btn btn-primary mb-3" id="add_btn">Add Marriage Budget</a> --}}
                            <div class="table-responsive">
                                {{ $dataTable->table([
                                    'class' => 'table table-bordered table-hover  w-100',
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
<script>
    document.addEventListener('click', function(e) {
    if (e.target.classList.contains('toggle-details')) {
        const row = e.target.closest('tr').nextElementSibling;
        row.style.display = (row.style.display === 'none' ? '' : 'none');
    }
});
</script>
{{ $dataTable->scripts() }}
@endpush
