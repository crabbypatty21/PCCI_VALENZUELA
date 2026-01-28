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

    <div class="d-flex justify-content-center gap-3 mb-5">
        <a href="{{ url('/membership') }}" class="btn-primary-custom px-4 py-2">View Membership</a>
        <a href="#" class="btn-outline-custom px-4 py-2">About Us</a>
    </div>

</div>

<!-- Our Impact Section -->
<div class="container my-5">
    <div class="text-center mb-4">
        <span class="text-accent fw-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.05em;">
            Our Impact
        </span>
        <h2 class="fw-bold mt-2">Making a Difference</h2>
    </div>
    
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-12 col-md-4">
            <div class="impact-card">
                <div class="impact-card-inner">
                    <h3 class="impact-number">100+</h3>
                    <p class="impact-label">Active Members</p>
                    <p class="impact-desc">A growing network of diverse businesses.</p>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="col-12 col-md-4">
            <div class="impact-card">
                <div class="impact-card-inner">
                    <h3 class="impact-number">50+</h3>
                    <p class="impact-label">Events Hosted</p>
                    <p class="impact-desc">Networking and learning opportunities.</p>
                </div>
            </div>
        </div>
        
        <!-- Card 3 -->
        <div class="col-12 col-md-4">
            <div class="impact-card">
                <div class="impact-card-inner">
                    <h3 class="impact-number">₱10M+</h3>
                    <p class="impact-label">Business Generated</p>
                    <p class="impact-desc">Economic growth through partnerships.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection