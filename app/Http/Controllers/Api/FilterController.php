<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserFilterService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    protected $filterService;

    public function __construct(UserFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function filterUsers(Request $request)
    {
        $result = $this->filterService->filter($request);

        return response()->json([
            'message' => 'success',
            'exact_matches' => $result['exact_matches'],
            'suggested_users' => $result['suggested_users'],
            'suggestion_percentage' => $result['suggestion_percentage']
        ], 200);
    }
}
