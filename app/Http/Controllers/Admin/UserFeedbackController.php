<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserFeedbackRequest;
use App\Http\Resources\UserFeedbackResource;
use App\Models\UserFeedback;

class UserFeedbackController extends Controller
{

    public function store(StoreUserFeedbackRequest $request)
    {
        $feedback = UserFeedback::create($request->validated());
        return new UserFeedbackResource($feedback);
    }
}
