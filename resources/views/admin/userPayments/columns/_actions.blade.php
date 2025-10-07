<td>
  <td>
    <button
        class="btn btn-sm btn-primary subscribe-btn"
        data-email="{{ $payment->email }}"
        data-package-id="{{ $payment->package->id }}"
        data-payment-id="{{ $payment->id }}"
        {{ $payment->status !== 'pending' ? 'disabled' : '' }}
    >
        Verify subscription
    </button>
</td>

</td>


