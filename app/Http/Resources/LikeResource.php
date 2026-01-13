<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ContactMaskingService;

class LikeResource extends JsonResource
{
    protected $contactMaskingService;
    protected $viewedAsLiker = false; // default: "liked me" context

    public function __construct($resource, $viewedAsLiker = false)
    {
        parent::__construct($resource);
        $this->contactMaskingService = app(ContactMaskingService::class);
        $this->viewedAsLiker = $viewedAsLiker;
    }

    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', app()->getLocale());
        $locale = in_array($locale, ['en', 'ar']) ? $locale : app()->getLocale();

        // IMPORTANT: $relatedUser itself can be null -> must guard it first
        $relatedUser = $this->viewedAsLiker ? $this->likedUser : $this->user;

        // Make user/profile safe without changing your structure much
        $profile = optional(optional($relatedUser)->profile);

        // Ensure photos is always a Collection (fixes "firstWhere on array" issues in downstream accessors)
        $photos = collect(optional($relatedUser)->photos ?? []);

        return [
            'id' => $this->id,
            'user' => [
                'id' => optional($relatedUser)->id ?? 'N/A',
                'first_name' => optional($relatedUser)->first_name ?? 'N/A',
                'last_name' => optional($relatedUser)->last_name ?? 'N/A',

                'nickname' => $profile->nickname ?? 'N/A',

                'country_of_residence' =>
                optional($profile->countryOfResidence)->{"name_$locale"} ?? 'N/A',

                'city_of_residence' =>
                optional($profile->city)->{"name_$locale"} ?? 'N/A',

                'email' =>
                optional($relatedUser)->email
                    ? $this->contactMaskingService->maskEmail(optional($relatedUser)->email)
                    : 'N/A',

                'photos' => $photos->map(function ($photo) {
                    // $photo might be Model or array, handle both safely
                    $id = is_array($photo) ? ($photo['id'] ?? null) : ($photo->id ?? null);
                    $url = is_array($photo) ? ($photo['photo_url'] ?? null) : ($photo->photo_url ?? null);
                    $isMain = is_array($photo) ? ($photo['is_main'] ?? false) : ($photo->is_main ?? false);

                    return [
                        'id' => $id ?? 'N/A',
                        'url' => $url ?? 'N/A',
                        'is_main' => (bool) $isMain,
                    ];
                })->values(),
            ],
        ];
    }
}
