<?php

namespace App\Http\Controllers\User;
use App\Services\User\OnboardingService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FindMatchController extends Controller
{
    protected $onboardingService;

    public function __construct(OnboardingService $onboardingService)
    {
        $this->onboardingService = $onboardingService;
    }

    public function index(Request $request)
    {
        $data = $this->onboardingService->getOnboardingData();
        // dd($data);
        
        return view('user.find-match', compact('data'));
    }

}
