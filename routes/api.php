<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

// Example of how your Event routes should look in this file:
Route::prefix('v1')->group(function () {
    // GET /api/v1/events
    Route::get('/events', [EventController::class, 'index']); 
    
    // POST /api/v1/events
    Route::post('/events', [EventController::class, 'store']); 
    
    // POST (or PUT) /api/v1/events/{id}
    Route::post('/events/{id}', [EventController::class, 'update']); 
});