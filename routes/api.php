<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Api\LeadershipController; 
use App\Http\Controllers\Api\MemberController; // <-- ADD THIS FOR MEMBERS!

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    
    // Leadership Route
    Route::get('/leadership', [LeadershipController::class, 'index']); 

    // --> NEW MEMBERS ROUTE <--
    Route::get('/members', [MemberController::class, 'index']); 

    // Your existing Event routes
    Route::get('/events', [EventController::class, 'index']); 
    Route::post('/events', [EventController::class, 'store']); 
    Route::post('/events/{id}', [EventController::class, 'update']); 
});