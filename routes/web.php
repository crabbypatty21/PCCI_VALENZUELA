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

Route::get('/treasurer-dashboard', function () {
    return view('treasurer_dashboard');
})->name('treasurer.dashboard');

// --- FRONTEND UI ROUTES FROM TEAM BRANCH ---

Route::get('/members', function () {
    return view('members');
})->name('members');

Route::get('/applicants', function () {
    return view('applicants');
})->name('applicants');

// The detailed Applicant Profile page
Route::get('/applicant/{id}', function ($id) {
    // Simulate different data based on ID for demonstration
    $applicantData = [
        'id' => $id,
        'name' => ($id == 1) ? 'Sarah Geronimo' : 'Bamboo Manalac',
        'email' => ($id == 1) ? 'sarah.g@example.com' : 'bamboo@rock.ph',
        'business_name' => ($id == 1) ? 'Pop Studio Inc.' : 'Rivermaya Solutions',
        'status' => ($id == 1) ? 'Under Review' : 'New Application',
    ];

    return view('applicant-profile', ['applicant' => $applicantData]);
})->name('applicant.profile');

Route::get('/content/board-of-trustees', function () {
    return view('board-of-trustees');
})->name('content.trustees');

Route::get('/content/activities', function () {
    return view('activities');
})->name('content.activities');

Route::get('/content/event-admin', function () {
    return view('event-admin');
})->name('content.event-admin');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');