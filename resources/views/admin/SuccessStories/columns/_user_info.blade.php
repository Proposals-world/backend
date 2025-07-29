<div class="d-flex align-items-center">
    @if($user->mainPhoto)
        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
            <img src="{{ asset(optional($user->photos->firstWhere('is_main', 1))->photo_url) }}" alt="{{ $user->first_name }} {{ $user->last_name }}" class="w-100">
        </div>
    @else
        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3 bg-light-{{ $gender === 'male' ? 'primary' : 'danger' }}">
            <span class="font-weight-bold text-{{ $gender === 'male' ? 'primary' : 'danger' }}">
                {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
            </span>
        </div>
    @endif
    <div class="d-flex flex-column">
        <span class="text-gray-800 fw-bold">{{ $user->first_name }} {{ $user->last_name }}</span>
        <span class="text-muted">{{ $user->email }}</span>
    </div>
</div>
