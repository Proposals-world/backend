<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMatch;
use App\Services\LikeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Resources\MatchResource;
use App\Http\Resources\UserProfileResource;
use App\Services\ContactMaskingService;

class MatchController extends Controller
{
    protected $likeService;
    protected $maskingService;

    public function __construct(LikeService $likeService, ContactMaskingService $maskingService)
    {
        $this->likeService = $likeService;
        $this->maskingService = $maskingService;
    }

    public function getMatches()
    {
        $matches = $this->likeService->getMatches();
    
        if (auth()->guest()) {
            return redirect()->route('login')->with('error', 'Unauthorized');
        }
    
        if ($matches->isEmpty()) {
            return view('user.matches', [
                'matches' => collect(), 
                'noMatchesMessage' => 'Currently you do not have any matches',
            ]);
        }
    
        $lang = app()->getLocale();
    
        $enrichedMatches = $matches->map(function ($match) use ($lang) {
            $authUserId = auth()->id();
            $matchedUser = $match->user1_id === $authUserId ? $match->user2 : $match->user1;
    
            $profileResource = new UserProfileResource($matchedUser, $lang);
            $profileArray = $profileResource->toArray(request());
    
            if (!$match->contact_exchanged) {
                $masker = app(ContactMaskingService::class);
                $profileArray['phone_number'] = $masker->maskPhone($matchedUser->phone_number);
                $profileArray['email'] = $masker->maskEmail($matchedUser->email);
                $profileArray['profile']['guardian_contact'] = $masker->maskGuardianContact(
                    $matchedUser->profile->guardian_contact_encrypted ?? null
                );
            }
    
            return [
                'match_id' => $match->id,
                'contact_exchanged' => $match->contact_exchanged,
                'matched_user' => $profileArray,
            ];
        });
    
        $matchesWithContact = $enrichedMatches->filter(fn($m) => $m['contact_exchanged']);
        $matchesWithoutContact = $enrichedMatches->filter(fn($m) => !$m['contact_exchanged']);
        
        return view('user.matches', [
            'matchesWithContact' => $matchesWithContact,
            'matchesWithoutContact' => $matchesWithoutContact,
            'noMatchesMessage' => null,
        ]);
    }
}