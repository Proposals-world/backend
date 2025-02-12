<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DynamicDataResource;
use App\Models\Hobby;
use App\Models\MarriageBudget;
use App\Models\Pet;
use App\Models\Religion;
use App\Models\Specialization;
use App\Models\Origin;
use Illuminate\Http\Request;

class DynamicDataController extends Controller
{
    public function index()
    {
        $data = (object) [
            'religions' => Religion::all(),
            'specializations' => Specialization::all(),
            'hobbies' => Hobby::all(),
            'pets' => Pet::all(),
            'marriageBudgets' => MarriageBudget::all(),
            'origins' => Origin::all(),
        ];

        return new DynamicDataResource($data);
    }
}