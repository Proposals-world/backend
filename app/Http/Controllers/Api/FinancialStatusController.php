<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FinancialStatusResource;
use App\Models\FinancialStatus;
use Illuminate\Http\Request;

class FinancialStatusController extends Controller
{
    public function index(Request $request)
    {
        $financialStatuses = FinancialStatus::all();
        return FinancialStatusResource::collection($financialStatuses);
    }
}
