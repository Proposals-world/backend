<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMatch;
use App\Services\LikeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Http\Resources\MatchResource;
use App\Http\Resources\UserProfileResource;
use App\Models\Like;
use App\Models\User;
use App\Services\ContactMaskingService;

class MatchController extends Controller
{
    protected $likeService;
    protected $maskingService;
    protected $contactMaskingService;
    public function __construct(LikeService $likeService, ContactMaskingService $contactMaskingService)
    {
        $this->likeService = $likeService;
        $this->contactMaskingService = $contactMaskingService;
    }

    public function index()
    {
        return view('user.matches');
    }

    public function getMatches(): JsonResponse
    {
        try {
            if (Auth::guest()) {
                return response()->json([
                    'error' => 'Unauthorized',
                    'redirect' => route('login')
                ], 401);
            }

            $matches = $this->likeService->getMatches();
            $lang = app()->getLocale();

            if ($matches->isEmpty()) {
                return response()->json([
                    'matchesWithContact' => [],
                    'matchesWithoutContact' => [],
                    'noMatchesMessage' => __('userDashboard.matches.no_matches')
                ], 200);
            }

            $enrichedMatches = $matches->map(function ($match) use ($lang) {
                $authUserId = Auth::id();
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

            $matchesWithContact = $enrichedMatches->filter(fn($match) => $match['contact_exchanged'])->values();
            $matchesWithoutContact = $enrichedMatches->filter(fn($match) => !$match['contact_exchanged'])->values();

            return response()->json([
                'matchesWithContact' => $matchesWithContact,
                'matchesWithoutContact' => $matchesWithoutContact,
                'noMatchesMessage' => '' // Only set when there are truly no matches
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch matches',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function removeMatch(Request $request)
    {
        // ✅ Just call the service and return its result
        return $this->likeService->softDeleteMatch($request);
    }
    public function revealContact(Request $request)
    {
        $user = auth()->user();
        $lang = request()->header('Accept-Language', app()->getLocale());

        // Check if the user has a subscription
        $subscription = $user->subscription;
        if (!$subscription || $subscription->status !== 'active') {
            $errorMessage = $lang === 'ar' ? 'يجب أن تكون مشتركًا لكشف معلومات الاتصال.' : 'You must be subscribed to reveal contact info.';
            return response()->json(['error' => $errorMessage], 403);
        }

        // Check if user has remaining contacts
        if ($subscription->contacts_remaining <= 0) {
            $errorMessage = $lang === 'ar' ? 'ليس لديك أي اظهارات متبقية لجهات الاتصال.' : 'You have no remaining contact reveals.';
            return response()->json(['error' => $errorMessage], 403);
        }

        $matchedUserId = $request->input('matched_user_id');

        // Get contact info
        $result = $this->contactMaskingService->getContactInfo($user->id, $matchedUserId);
        // If contact info revealed successfully, reduce contacts
        if (!isset($result['error'])) {
            $subscription->decrement('contacts_remaining');
        }

        return response()->json($result, isset($result['error']) ? 404 : 200);
    }
}
