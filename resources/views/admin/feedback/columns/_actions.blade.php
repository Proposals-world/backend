<td>
    <!-- Main user button -->
    @if($fb->user_id)
        <a href="{{ route('userprofile', $fb->user_id) }}"
           class="btn btn-sm text-info w-100 mt-1 border">
            <i class="ri-eye-line"></i> Given By
        </a>
    @endif

    <!-- Matched user button -->
    @if(!empty($matchedUserId))
        <a href="{{ route('userprofile', $matchedUserId) }}"
           class="btn btn-sm text-success w-100 mt-1 border">
            <i class="ri-eye-line"></i> Matched With
        </a>
    @endif
</td>
