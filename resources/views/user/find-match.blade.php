
@extends('user.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard/css/findAmatch.css') }}" />

    <div class="container-fluid disable-text-selection">
        <!-- Enhanced Header with Dashboard Summary -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="match-dashboard-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-4">
                        <div>
                            <h1 class="mb-1">{{ __('userDashboard.findMatch.title') }}</h1>
                            <p class="text-dark mb-0">Find your perfect match based on compatibility and preferences</p>
                        </div>
                        <div class="match-stats d-flex mt-3 mt-md-0">
                            <div class="match-stat-item text-center mr-4">
                                <span class="match-stat-number" id="exactMatchCount">0</span>
                                <span class="match-stat-label">Exact Matches</span>
                            </div>
                            <div class="match-stat-item text-center">
                                <span class="match-stat-number" id="suggestedMatchCount">0</span>
                                <span class="match-stat-label">Suggestions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clear Section Division for Exact Matches -->
        <div class="row mb-4 px-4">
            <div class="col-12">
                <div class="section-header">
                    <h5 class="mb-0">
                        <i class="simple-icon-check mr-2"></i>Exact Matches
                        <span class="badge badge-light ml-2" id="exactMatchBadge">0</span>
                    </h5>
                </div>
                <div class="row mt-3" id="exactMatchResults">
                    <!-- Exact match cards will be populated here via JavaScript -->
                </div>
            </div>
        </div>

        <!-- Suggestion Slider Section with Clear Visual Distinction -->
        <div class="row  px-4">
            <div class="col-12">
                <div class="section-header">
                    <h5 class="mb-0">
                        <i class="simple-icon-star mr-2"></i>Suggested Matches
                        <span class="badge badge-light ml-2" id="suggestedMatchBadge">0</span>
                        <span class="badge badge-info ml-2" id="matchPercentage">0% Match</span>
                    </h5>
                </div>
                <div class="suggested-slider-container mt-3">
                    <div class="suggested-slider-controls">
                        <button id="prevSuggestion" class="btn btn-outline-primary btn-sm">
                            <i class="simple-icon-arrow-left"></i>
                        </button>
                        <button id="nextSuggestion" class="btn btn-outline-primary btn-sm">
                            <i class="simple-icon-arrow-right"></i>
                        </button>
                    </div>
                    <div class="suggested-slider" id="suggestedMatchResults">
                        <!-- Suggested match cards will be populated here via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('sidebar-filters')

<!-- Filter Sidebar -->
<div id="filterTab" class="filter-tab show">
    <a href="javascript:void(0)" id="filterToggleDesktop">
        <i class="simple-icon-equalizer"></i>
        <span class="filter-count" id="desktopFilterCount">0</span>
    </a>
</div>

<div id="filterBookmark" class="filter-bookmark show">
    <a href="javascript:void(0)" id="filterToggleMobile">
        <i class="simple-icon-equalizer"></i>
        <span class="filter-count ml-2" id="mobileFilterCount">0</span>
    </a>
</div>

<div class="sub-menu show" id="matchFilters">
    <div class="scroll">
        <div class="filter-header">
            <h6 class="sub-menu-title mb-0">Match Filters</h6>
            <button id="resetAllFilters" class="btn btn-sm btn-outline-danger">
                <i class="simple-icon-refresh"></i> Reset
            </button>
        </div>
        <div class="p-3">
            <form id="filterForm" onsubmit="return false;">
                @csrf
                <input type="hidden" name="isFilter" value="true">

                {{-- BASIC INFO --}}
                <div class="form-group">
                    <label>Age Range</label>
                    <div class="d-flex">
                        <input type="number" name="age_min" class="form-control mr-2" placeholder="Min">
                        <input type="number" name="age_max" class="form-control" placeholder="Max">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nationality</label>
                    <select name="nationality_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['nationalities'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Country of Residence</label>
                    <select name="country_of_residence_id" id="country_of_residence_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['countries'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>City</label>
                    <select name="city_id" id="city_id" class="form-control">
                        <option value="">-- Select Country First --</option>
                    </select>
                </div>

                {{-- RELIGION --}}
                <div class="form-group">
                    <label>Religion</label>
                    <select name="religion_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['religions'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Religiosity Level</label>
                    <select name="religiosity_level_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['religiousLevels'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- APPEARANCE --}}
                <div class="form-group">
                    <label>Height</label>
                    <select name="height_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['heights'] as $item)
                            <option value="{{ $item->id }}">{{ $item->value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Weight</label>
                    <select name="weight_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['weights'] as $item)
                            <option value="{{ $item->id }}">{{ $item->value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Skin Color</label>
                    <select name="skin_color_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['skinColors'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Hair Color</label>
                    <select name="hair_color_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['hairColors'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Eye Color</label>
                    <select name="eye_color_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['eyeColors'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Zodiac Sign</label>
                    <select name="zodiac_sign_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['zodiacSigns'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- LIFESTYLE --}}
                <div class="form-group">
                    <label>Marital Status</label>
                    <select name="marital_status_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['maritalStatuses'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Smoking Status</label>
                    <select name="smoking_status" class="form-control">
                        <option value="">-- Any --</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Drinking Status</label>
                    <select name="drinking_status_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['drinkingStatuses'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Sleep Habit</label>
                    <select name="sleep_habit_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['sleepHabits'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- EDUCATION & WORK --}}
                <div class="form-group">
                    <label>Educational Level</label>
                    <select name="educational_level_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['educationalLevels'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Specialization</label>
                    <select name="specialization_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['specializations'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Job Title</label>
                    <select name="job_title_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['jobTitles'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Position Level</label>
                    <select name="sector_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['positionLevels'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Marriage Budget</label>
                    <select name="marriage_budget_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['marriageBudget'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Children</label>
                    <select name="children" class="form-control">
                        <option value="">-- Any --</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                {{-- SOCIAL --}}
                <div class="form-group">
                    <label>Social Media Presence</label>
                    <select name="social_media_presence_id" class="form-control">
                        <option value="">-- Any --</option>
                        @foreach ($data['socialMediaPresence'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- ACTION --}}
                <div class="form-group mt-4">
                    <button type="button" id="applyFiltersBtn" class="btn btn-primary btn-block">
                        <i class="simple-icon-magnifier mr-2"></i> Find Matches
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Dependent City Loading -->
@push('scripts')
<script>
    $('#country_of_residence_id').on('change', function () {
        let countryId = $(this).val();
        $('#city_id').html('<option value="">Loading...</option>');
        if (countryId) {
            $.get('/cities-by-country/' + countryId, function (data) {
                let options = '<option value="">-- Select City --</option>';
                data.forEach(city => {
                    options += `<option value="${city.id}">${city.name}</option>`;
                });
                $('#city_id').html(options);
            });
        } else {
            $('#city_id').html('<option value="">-- Select Country First --</option>');
        }
    });

        $(document).ready(function() {
            // Initialize collapsible sections
            $('.filter-section-header').on('click', function() {
                $(this).find('i.simple-icon-arrow-down').toggleClass('simple-icon-arrow-up');
                $(this).next('.filter-section-body').collapse('toggle');
            });
            
            // Modified content section for clearer data separation
            const matchResultsContainer = $('#matchResults');
            matchResultsContainer.html(`
                <!-- Clear Section Division for Exact Matches -->
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="simple-icon-check mr-2"></i>Exact Matches
                                <span class="badge badge-light ml-2" id="exactMatchBadge">0</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row" id="exactMatchResults">
                                <!-- Will be populated via JavaScript -->
                                <div class="col-12 text-center py-5">
                                    <i class="simple-icon-refresh spinning font-large"></i>
                                    <p class="mt-3">Loading matches...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suggestion Slider Section with Clear Visual Distinction -->
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="simple-icon-star mr-2"></i>Suggested Matches
                                <span class="badge badge-light ml-2" id="suggestedMatchBadge">0</span>
                                <span class="badge badge-info ml-2" id="matchPercentage">0% Match</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="suggested-slider-container">
                                <div class="suggested-slider-controls">
                                    <button id="prevSuggestion" class="btn btn-outline-primary btn-sm">
                                        <i class="simple-icon-arrow-left"></i>
                                    </button>
                                    <button id="nextSuggestion" class="btn btn-outline-primary btn-sm">
                                        <i class="simple-icon-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="suggested-slider" id="suggestedMatchResults">
                                    <!-- Will be populated via JavaScript -->
                                    <div class="col-12 text-center py-5">
                                        <i class="simple-icon-refresh spinning font-large"></i>
                                        <p class="mt-3">Loading suggestions...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            
            // Initialize slider controls
            $('#nextSuggestion').on('click', function() {
                const container = document.querySelector('.suggested-slider');
                container.scrollLeft += 320; // Width of a card + gap
            });
            
            $('#prevSuggestion').on('click', function() {
                const container = document.querySelector('.suggested-slider');
                container.scrollLeft -= 320; // Width of a card + gap
            });
            
            // Track active filters and update counters
            function updateFilterCounters() {
                let activeFilters = 0;
                
                // Check each filter input/select
                $('#filterForm').find('select, input[type="number"]').each(function() {
                    const $this = $(this);
                    const value = $this.val();
                    const id = $this.attr('id');
                    const activeLabel = $('#' + id + 'Active');
                    
                    if (value && value !== '' && id !== '_token') {
                        activeFilters++;
                        
                        // Show active state for this filter
                        if (activeLabel.length) {
                            if (id === 'age_min' || id === 'age_max') {
                                const min = $('#age_min').val() || '?';
                                const max = $('#age_max').val() || '?';
                                if (min !== '?' || max !== '?') {
                                    $('#ageRangeActive').text(`${min}-${max}`).addClass('show');
                                }
                            } else {
                                activeLabel.text('Selected').addClass('show');
                            }
                        }
                    } else {
                        // Remove active state
                        if (activeLabel.length && id !== 'age_min' && id !== 'age_max') {
                            activeLabel.text('').removeClass('show');
                        } else if ((id === 'age_min' || id === 'age_max') && 
                                  !$('#age_min').val() && !$('#age_max').val()) {
                            $('#ageRangeActive').text('').removeClass('show');
                        }
                    }
                });
                
                // Update filter badges
                $('#desktopFilterCount, #mobileFilterCount').text(activeFilters);
                
                if (activeFilters > 0) {
                    $('.filter-count').addClass('active');
                } else {
                    $('.filter-count').removeClass('active');
                }
                
                return activeFilters > 0;
            }
            
            // Reset all filters
            $('#resetAllFilters').on('click', function() {
                $('#filterForm')[0].reset();
                $('.filter-active').text('').removeClass('show');
                $('.filter-count').removeClass('active');
                $('#desktopFilterCount, #mobileFilterCount').text('0');
                loadDefaultMatches();
            });
            
            // On page load, send the default request with isFilter = false
            loadDefaultMatches();
            
            // Handle filter form submission
            $('#applyFiltersBtn').on('click', function(e) {
                e.preventDefault();
                
                // Update filter counters and check if any filters are active
                const hasFilter = updateFilterCounters();
                $('input[name="isFilter"]').val(hasFilter ? "true" : "false");
                
                // Show loading state
                $(this).html('<i class="simple-icon-refresh spinning mr-2"></i> Searching...');
                $('#exactMatchResults, #suggestedMatchResults').html(
                    '<div class="col-12 text-center py-5"><i class="simple-icon-refresh spinning font-large"></i><p class="mt-3">Searching for matches...</p></div>'
                );
                
                // Serialize and send the GET request
                let queryString = $('#filterForm').serialize();
                $.ajax({
                    url: '/user/filter?' + queryString,
                    method: 'GET',
                    success: function(response) {
                        renderMatches(response.exact_matches, response.suggested_users, response.suggestion_percentage);
                        $('#applyFiltersBtn').html('<i class="simple-icon-magnifier mr-2"></i> Find Matches');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#applyFiltersBtn').html('<i class="simple-icon-magnifier mr-2"></i> Find Matches');
                        $('#exactMatchResults, #suggestedMatchResults').html(
                            '<div class="col-12 text-center py-4"><p class="text-muted">Error loading matches. Please try again.</p></div>'
                        );
                    }
                });
            });
            
            // Monitor filter changes
            $('#filterForm').find('select, input[type="number"]').on('change', function() {
                updateFilterCounters();
            });
            
            function loadDefaultMatches() {
                // Show loading indicators
                $('#exactMatchResults, #suggestedMatchResults').html(
                    '<div class="col-12 text-center py-5"><i class="simple-icon-refresh spinning font-large"></i><p class="mt-3">Loading matches...</p></div>'
                );
                
                // Send a request with isFilter = false
                $.ajax({
                    url: '/user/filter',
                    method: 'GET',
                    success: function(response) {
                        renderMatches(response.exact_matches, response.suggested_users, response.suggestion_percentage);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#exactMatchResults, #suggestedMatchResults').html(
                            '<div class="col-12 text-center py-4"><p class="text-muted">Unable to load matches. Please try again.</p></div>'
                        );
                    }
                });
            }

            // Renders matches in their respective containers with enhanced styling
            function renderMatches(exactMatches, suggestedUsers, suggestionPercentage) {
                // Update badge counters
                $('#exactMatchBadge').text(exactMatches ? exactMatches.length : 0);
                $('#suggestedMatchBadge').text(suggestedUsers ? suggestedUsers.length : 0);
                $('#matchPercentage').text(suggestionPercentage + '% Match');
                $('#exactMatchCount').text(exactMatches ? exactMatches.length : 0);
                $('#suggestedMatchCount').text(suggestedUsers ? suggestedUsers.length : 0);
                // Render exact matches
                let exactContainer = $('#exactMatchResults');
                exactContainer.empty();
                
                if (exactMatches && exactMatches.length > 0) {
                    exactMatches.forEach(userProfile => {
                        exactContainer.append(matchCard(userProfile, 'exact'));
                    });
                } else {
                    exactContainer.html('<div class="col-12 text-center py-4"><p class="text-dark">No exact matches found based on your criteria.</p></div>');
                }
                
                // Render suggested matches in the slider
                let suggestedContainer = $('#suggestedMatchResults');
                suggestedContainer.empty();
                
                if (suggestedUsers && suggestedUsers.length > 0) {
                    suggestedUsers.forEach(userProfile => {
                        suggestedContainer.append(matchCard(userProfile, 'suggested'));
                    });
                } else {
                    suggestedContainer.html('<div class="text-center py-4 w-100"><p class="text-dark">No suggested matches found based on your criteria.</p></div>');
                }
            }

            function matchCard(userProfile, cardType) {
                // Determine main photo URL with fallback
                let mainPhotoUrl = '/dashboard/logos/profile-icon.jpg';
                if (userProfile.photos && userProfile.photos.length > 0) {
                    const mainPhoto = userProfile.photos.find(photo => photo.is_main == 1);
                    if (mainPhoto && mainPhoto.photo_url) {
                        mainPhotoUrl = mainPhoto.photo_url;
                    }
                }
                
                // Process location information
                let country = (userProfile.profile && userProfile.profile.country_of_residence) ? userProfile.profile.country_of_residence : '';
                let city = (userProfile.profile && userProfile.profile.city) ? userProfile.profile.city : 'Unknown Location';
                
                // Extract additional user info if available
                let age = userProfile.profile && userProfile.profile.age ? userProfile.profile.age : '';
                let religion = userProfile.profile && userProfile.profile.religion ? userProfile.profile.religion : '';
                // console.log(userProfile);
                // Create a different HTML structure based on card type
                if (cardType === 'exact') {
                    return `
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="card profile-card shadow-sm h-100" data-profile='${JSON.stringify(userProfile)}'>
                                <div class="position-relative">
                                    <span class="badge badge-success position-absolute m-2">Exact Match</span>
                                    <img class="card-img-top" src="${mainPhotoUrl}" alt="${userProfile.first_name}'s Profile">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-1">${userProfile.first_name} ${userProfile.last_name}</h5>
                                    <p class="text-muted small mb-2">
                                        ${country}${country && city ? ', ' : ''}${city}
                                    </p>
                                    <div class="profile-details mt-auto">
                                        ${age ? `<span class="badge badge-light mr-2">${age} years</span>` : ''}
                                        ${religion ? `<span class="badge badge-light">${religion}</span>` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    // For suggestion slider, wrap in a container div for proper layout
                    return `
                        <div class="card-container">
                            <div class="card profile-card shadow-sm h-100" data-profile='${JSON.stringify(userProfile)}'>
                                <div class="position-relative">
                                    <span class="badge badge-warning position-absolute m-2">Suggested</span>
                                    <img class="card-img-top" src="${mainPhotoUrl}" alt="${userProfile.first_name}'s Profile">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-1">${userProfile.first_name} ${userProfile.last_name}</h5>
                                    <p class="text-muted small mb-2">
                                        ${country}${country && city ? ', ' : ''}${city}
                                    </p>
                                    <div class="profile-details mt-auto">
                                        ${age ? `<span class="badge badge-light mr-2">${age} years</span>` : ''}
                                        ${religion ? `<span class="badge badge-light">${religion}</span>` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }
            
            // Add an animation class for the loading spinner
            $('<style>').text(`
                .spinning {
                    animation: spin 1s infinite linear;
                }
                @keyframes spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
                .font-large {
                    font-size: 2rem;
                }
            `).appendTo('head');
        });
    </script>
@endpush


@endsection