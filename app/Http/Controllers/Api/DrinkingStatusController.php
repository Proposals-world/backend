<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DrinkingStatus;
use App\Http\Resources\DrinkingStatusResource;
use Illuminate\Http\Request;

class DrinkingStatusController extends Controller
{
    /**
     * Return all drinking statuses.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $statuses = DrinkingStatus::all();

        return response()->json([
            'success' => true,
            'data' => DrinkingStatusResource::collection($statuses),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DrinkingStatus $drinkingStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DrinkingStatus $drinkingStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DrinkingStatus $drinkingStatus)
    {
        //
    }
}
