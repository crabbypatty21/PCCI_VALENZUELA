<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // or whatever your homepage view is
})->name('home');

Route::get('/membership', function () {
    return view('membership');
})->name('membership');

Route::get('/about', function () {
    return view('about');
})->name('about');  // <--- This 'name' part is crucial!

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
// Updated route to use the specified filename
Route::get('/business/tech-corp', function () {
    return view('MembershipBusinessProfileDetails');
})->name('business.show');

Route::get('/leadership', function () {
    return view('leadership');
})->name('leadership');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/event', function () {
    return view('event');
})->name('event');

Route::post('/logout', function () {
    // Placeholder logout
    return redirect()->route('home');
})->name('logout');
