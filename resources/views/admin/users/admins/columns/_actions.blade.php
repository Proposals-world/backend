<td>
    <a class="btn btn-sm text-info edit_btn" id="{{ $admin->id }}"><i class="ri-pencil-line"></i></a>
    @if (auth()->user()->id == 1)
        <a class="btn btn-sm text-danger remove_btn" id="{{ $admin->id }}"><i class="ri-delete-bin-2-line"></i></a>
    @endif
 </td>
