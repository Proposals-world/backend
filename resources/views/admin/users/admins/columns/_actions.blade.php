<td>
    @if (auth()->user()->adminPermission && auth()->user()->adminPermission->can_edit)
    <a class="btn btn-sm text-info edit_btn" id="{{ $admin->id }}"><i class="ri-pencil-line"></i></a>
    @endif
    @if (auth()->user()->adminPermission && auth()->user()->adminPermission->can_delete)
    <a class="btn btn-sm text-danger remove_btn" id="{{ $admin->id }}">
        <i class="ri-delete-bin-2-line"></i>
    </a>
@endif

 </td>
