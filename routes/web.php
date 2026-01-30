<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/membership', function () {
    return view('membership');
});

Route::get('/about', function () {
    return view('about');
})->name('about');  // <--- This 'name' part is crucial!

Route::get('/contact', function () {
    return view('contact');
});
// Updated route to use the specified filename
Route::get('/business/tech-corp', function () {
    return view('MembershipBusinessProfileDetails');
})->name('business.show');

Route::get('/leadership', function () {
    return view('leadership');
})->name('leadership');
