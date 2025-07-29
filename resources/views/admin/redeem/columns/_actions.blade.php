<td>
<div class="d-flex justify-content-center">
    <button type="button" class="btn btn-sm btn-primary redeem-btn"
     data-id="{{ $user->id }}"
            data-name="{{ htmlspecialchars($user->first_name.' '.$user->last_name) }}">
        <i class="fas fa-gift"></i> Redeem
    </button>
</div>
</td>
