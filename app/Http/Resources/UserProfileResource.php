<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class UserProfileResource extends JsonResource
{
    /**
     * The language for localization.
     *
     * @var string
     */
    protected $lang;

    /**
     * Create a new resource instance.
     *
     * @param mixed $resource
     * @param string $lang
     */
    public function __construct($resource, string $lang = 'en')
    {
        // Ensure that parent constructor is called
        parent::__construct($resource);
        $this->lang = in_array($lang, ['en', 'ar']) ? $lang : 'en';
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Helper function to get localized field
        $getLocalized = function($model, $fieldBase) {
            return $model && isset($model->{'name_'.$this->lang}) ? $model->{'name_'.$this->lang} : null;
        };

        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'profile_status' => $this->profile_status,
            'status' => $this->status,
            'last_active' => $this->last_active,

            // Profile Information
            'profile' => [
                'bio' => $this->profile ? ($this->lang === 'ar' ? $this->profile->bio_ar : $this->profile->bio_en) : null,
                'avatar_url' => $this->profile ? $this->profile->avatar_url : null,
                'id_number' => $this->profile ? $this->profile->id_number : null,
                'nationality' => $getLocalized($this->profile->nationality, 'name'),
                'origin' => $getLocalized($this->profile->origin, 'name'),
                'religion' => $getLocalized($this->profile->religion, 'name'),
                'country_of_residence' => $getLocalized($this->profile->countryOfResidence, 'name'),
                'city' => $getLocalized($this->profile->city, 'name'),
                'area' => $this->profile ? $this->profile->area : null,
                'date_of_birth' => $this->profile ? $this->profile->date_of_birth : null,
                'age' => $this->profile ? $this->profile->age : null,
                'zodiac_sign' => $getLocalized($this->profile->zodiacSign, 'name'),
                'educational_level' => $getLocalized($this->profile->educationalLevel, 'name'),
                'specialization' => $getLocalized($this->profile->specialization, 'name'),
                'employment_status' => $this->profile ? $this->profile->employment_status : null,
                'job_title' => $getLocalized($this->profile->jobTitle, 'name'),
                'position_level' => $getLocalized($this->profile->positionLevel, 'name'),
                'financial_status' => $getLocalized($this->profile->financialStatus, 'name'),
                'housing_status' => $getLocalized($this->profile->housingStatus, 'name'),
                'car_ownership' => $this->profile ? $this->profile->car_ownership : null,
                'height' => $getLocalized($this->profile->height, 'name'),
                'weight' => $getLocalized($this->profile->weight, 'name'),
                'marital_status' => $getLocalized($this->profile->maritalStatus, 'name'),
                'children' => $this->profile ? $this->profile->children : null,
                'skin_color' => $getLocalized($this->profile->skinColor, 'name'),
                'hair_color' => $getLocalized($this->profile->hairColor, 'name'),
                'hijab_status' => $getLocalized($this->profile->hijabStatus, 'name'),
                'smoking_status' => $this->profile && $this->profile->smokingStatus ? $this->profile->smokingStatus->name : null,
                'drinking_status' => $getLocalized($this->profile->drinkingStatus, 'name'),
                'sports_activity' => $getLocalized($this->profile->sportsActivity, 'name'),
                'social_media_presence' => $getLocalized($this->profile->socialMediaPresence, 'name'),
                'guardian_contact' => $this->profile && $this->profile->guardian_contact_encrypted ? Crypt::decryptString($this->profile->guardian_contact_encrypted) : null,
            ],

            // Photos
            'photos' => $this->photos->map(function ($photo) {
                return [
                    'photo_url' => $photo->photo_url,
                    'caption' => $this->lang === 'ar' ? $photo->caption_ar : $photo->caption_en,
                ];
            }),
        ];
    }
}