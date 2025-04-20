<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\Like;
use App\Models\UserMatch;
use App\Services\ContactMaskingService;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    protected $likeService;
    protected $contactMaskingService;

    public function __construct(LikeService $likeService, ContactMaskingService $contactMaskingService)
    {
        $this->likeService = $likeService;
        $this->contactMaskingService = $contactMaskingService;
    }
    public function getMatches()
    {
        $matches = $this->likeService->getMatches();

        if ($matches === null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'message' => 'Matches fetched successfully',
            'matches' => $matches
        ], 200);
    }
    public function removeMatch(Request $request)
    {
        // ✅ Just call the service and return its result
        return $this->likeService->softDeleteMatch($request);
    }
    public function revealContact(Request $request)
    {
        $matchedUserId = $request->input('matchedUserId');
        $result = $this->contactMaskingService->getContactInfo(auth()->id(), $matchedUserId);

        return response()->json($result, isset($result['error']) ? 404 : 200);
    }
}
