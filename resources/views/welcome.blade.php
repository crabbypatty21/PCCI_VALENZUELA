@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column align-items-center text-center">
    
    <span class="text-accent fw-bold text-uppercase mb-3 d-block" style="font-size: 0.85rem; letter-spacing: 0.05em;">
        Welcome
    </span>

    <h1 class="headline-text fw-bold mb-4 text-uppercase" style="letter-spacing: -0.02em;">
        The Voice of Valenzuela Business
    </h1>

    <p class="text-secondary mb-5" style="max-width: 600px; line-height: 1.7; font-size: 1.1rem;">
        Empowering businesses, fostering growth, and building a stronger community together.
    </p>

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ url('/membership') }}" class="btn-primary-custom px-4 py-2">View Membership</a>
        <a href="#" class="btn-outline-custom px-4 py-2">About Us</a>
    </div>

</div>
@endsection