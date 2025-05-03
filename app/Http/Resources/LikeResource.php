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
        $locale = request()->header('Accept-Language', app()->getLocale());
        $locale = in_array($locale, ['en', 'ar']) ? $locale : app()->getLocale();

        $relatedUser = $this->viewedAsLiker ? $this->likedUser : $this->user;

        return [
            'id' => $this->id,
            'user' => [
                'id' => $relatedUser->id,
                'first_name' => $relatedUser->first_name,
                'last_name' => $relatedUser->last_name,
                'country_of_residence' => optional($relatedUser->profile->countryOfResidence)["name_$locale"],
                'city_of_residence' => optional($relatedUser->profile->city)["name_$locale"],
                'email' => $this->contactMaskingService->maskEmail($relatedUser->email),
                'photos' => $relatedUser->photos->map(fn($photo) => [
                    'id' => $photo->id,
                    'url' => $photo->photo_url,
                    'is_main' => $photo->is_main,
                ]),
            ],
        ];
    }
}
