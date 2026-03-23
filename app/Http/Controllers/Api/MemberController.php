<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
public function index() 
{
    // If you are manually formatting the data, make sure 'id' is there!
    $businesses = Business::all()->map(function ($business) {
        return [
            //'id' => $business->id, // <-- THIS IS THE MISSING PIECE!
            'photo_url' => $business->photo_url,
            'registered_business_name' => $business->registered_business_name,
            'industry' => $business->industry,
            // ... other fields
        ];
    });

    return response()->json(['data' => $businesses]);
}
