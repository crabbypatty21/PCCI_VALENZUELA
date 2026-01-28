<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/membership', function () {
    return view('membership');
});

// Updated route to use the specified filename
Route::get('/business/tech-corp', function () {
    return view('MembershipBusinessProfileDetails');
})->name('business.show');