<td>
  <td>
    <button
        class="btn btn-sm btn-primary subscribe-btn"
        data-user-id="{{ $payment->user->id }}"
        data-package-id="{{ $payment->package->id }}"
        {{ $payment->status !== 'pending' ? 'disabled' : '' }}
    >
        Verify subscription
    </button>
</td>

</td>


