{{-- resources/views/admin/country-groups/index.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Country Groups')
@section('page-title', 'Admin Dashboard - Country Groups')
@section('subtitle', 'Country Groups')

@section('content')
<div class="content">
    <div class="container-fluid">
          <div class="row">
                <div class="col-12">
                    <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                        <h4 class="page-title">Country Group List</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Country Group List</li>
                        </ol>
                    </div>
                </div>
            </div>
        <div class="card">
            <div class="card-body">
                <a class="btn btn-primary mb-3" id="add_btn">Add Country Group</a>

                <div class="table-responsive">
                    {{ $dataTable->table([
                        'class' => 'table table-bordered table-hover w-100'
                    ]) }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modal-body"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts() }}

<script>
    addModal(
        'add_btn',
        '{{ route("admin.country-groups.create") }}',
        'Add Country Group',
        'countryGroupForm',
        'country-groups-table'
    );

    editModal(
        'edit_btn',
        'admin/country-groups',
        'Edit Country Group',
        'countryGroupForm',
        'country-groups-table'
    );

    remove(
        'remove_btn',
        'admin/country-groups',
        'country-groups-table',
        '{{ csrf_token() }}'
    );
</script>
@endpush
