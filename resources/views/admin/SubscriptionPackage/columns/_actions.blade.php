<td>
    <a class="btn btn-sm text-info edit_btn" id="{{ $subscriptionPackage->id }}"><i class="ri-pencil-line"></i></a>
    <a class="btn btn-sm text-danger remove_btn" id="{{ $subscriptionPackage->id }}"><i class="ri-delete-bin-2-line"></i></a>
    @if (!empty($subscriptionPackage->payment_url))
        <a class="btn btn-sm text-success" href="{{ $subscriptionPackage->payment_url }}" target="_blank" title="Open Payment URL">
            <i class="ri-external-link-line"></i>
        </a>
    @endif
</td>
