<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ContactMaskingService;

class LikeResource extends JsonResource
{
    protected $contactMaskingService;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->contactMaskingService = app(ContactMaskingService::class);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = request()->header('Accept-Language', app()->getLocale());
        $locale = in_array($locale, ['en', 'ar']) ? $locale : app()->getLocale();

        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->User->id,
                'first_name' => $this->User->first_name,
                'last_name' => $this->User->last_name,
                'country_of_residence' => optional($this->User->profile->countryOfResidence)["name_$locale"],
                'city_of_residence' => optional($this->User->profile->city)["name_$locale"],
                'email' => $this->contactMaskingService->maskEmail($this->User->email),
                'photos' => $this->User->photos->map(function ($photo) {
                    return [
                        'id' => $photo->id,
                        'url' => $photo->photo_url,
                        'is_main' => $photo->is_main,
                    ];
                }),
            ],
        ];
    }
}
