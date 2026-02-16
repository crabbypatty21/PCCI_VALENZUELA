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

Route::get('/business/{id}', function ($id) {
    return view('MembershipBusinessProfileDetails', compact('id'));
})->name('business.show');


Route::get('/leadership', function () {
    return view('leadership');
})->name('leadership');

Route::get('/event', function () {
    return view('event');
})->name('event');

Route::get('/signup', function () {
    return view('signup'); 
})->name('signup');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');