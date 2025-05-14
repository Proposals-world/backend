<div class="col-12 mb-4">
    <div class="card profile-card shadow-sm" data-profile='@json($profile["matched_user"])'>
        <div class="position-relative">
            <a href="#">
                <img class="card-img-top"
                    src="{{ collect($profile['matched_user']['profile']['photos'])->firstWhere('is_main', 1)['photo_url'] ?? '' }}"
                    alt="{{ __('userDashboard.matches.profile_image') }}">
            </a>
        </div>
        <div class="card-body">
            <a href="#" class="profile-link">
                {{-- <p class="list-item-heading mb-1 font-weight-bold">
                    {{ $profile['matched_user']['first_name'] }} {{ $profile['matched_user']['last_name'] }}
                </p> --}}
            </a>
            <footer>
                <p class="text-muted text-small mb-0">
                    {{ $profile['matched_user']['profile']['country_of_residence'] . ', ' . ($profile['matched_user']['profile']['city'] ?? __('userDashboard.matches.unknown_location')) }}
                </p>
            </footer>
        </div>
    </div>
</div>
