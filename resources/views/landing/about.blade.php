@extends('layouts.app')

@section('content')

@include('partials.api-config')

{{-- Page-Specific Styles for Dark Mode --}}
<style>
    /* Hero Section Background */
    .about-hero {
        background-color: var(--bg-hero);
        transition: background-color 0.3s ease;
    }

    /* Standard Icon Box (Light Mode) */
    .feature-icon-box {
        width: 60px; 
        height: 60px; 
        background-color: #fff1f3; 
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }

    .feature-icon-box i {
        font-size: 1.75rem; 
        color: #D40032;
        transition: color 0.3s ease;
    }

    /* Dark Mode: Icon Box Adaptation */
    body.dark-mode .feature-icon-box {
        background-color: rgba(212, 0, 50, 0.15); /* Darker transparent red */
    }

    body.dark-mode .feature-icon-box i {
        color: #ff6b81; /* Lighter red for contrast */
    }

    /* Quote Box in Purpose Section */
    .quote-box {
        background-color: #fff1f3;
        border-radius: 12px; 
        border-left: 5px solid #D40032;
        transition: background-color 0.3s ease;
    }

    body.dark-mode .quote-box {
        background-color: rgba(212, 0, 50, 0.1); /* Dark mode quote background */
    }

    body.dark-mode .quote-box p {
        color: #e1e1e1 !important; /* Force light text in quote */
    }

    /* Swiper Section Background */
    .community-section {
        background-color: #fdf2f4;
        padding: 80px 0;
        overflow: hidden;
        transition: background-color 0.3s ease;
    }

    body.dark-mode .community-section {
        background-color: var(--bg-section-gray); /* Match section gray in dark mode */
    }

    /* Navigation Arrows */
    .nav-arrow {
        background: white;
        color: #333;
        /* ... existing styles ... */
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border: none;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 50;
        transition: all 0.3s ease;
    }
    
    .nav-arrow:hover {
        background-color: #D40032;
        color: white;
        transform: translateY(-50%) scale(1.1);
    }

    body.dark-mode .nav-arrow {
        background-color: var(--bg-card);
        color: var(--text-main);
    }
    
    .nav-prev { left: 20px; }
    .nav-next { right: 20px; }
    
    /* Swiper Styles (Maintained) */
    .carousel-outer-container {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .communitySwiper {
        width: 100%;
        padding: 40px 0 60px;
        overflow: visible;
    }
    
    .communitySwiper .swiper-slide {
        width: 450px;
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        opacity: 0.4;
        transform: scale(0.8);
    }
    
    .communitySwiper .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .communitySwiper .swiper-slide-active {
        opacity: 1;
        transform: scale(1.05);
        box-shadow: 0 25px 50px rgba(212, 0, 50, 0.2);
        z-index: 10;
    }

    .swiper-pagination-bullet-active {
        background: #D40032 !important;
        transform: scale(1.2);
    }

    @media (max-width: 768px) {
        .communitySwiper .swiper-slide { width: 300px; height: 200px; }
        .nav-arrow { display: none; }
    }

    /* =========================================
       ABOUT PAGE — DARK MODE FIXES
       ========================================= */

    /* PCCI Advantage section */
    .about-advantage {
        background-color: #F5F3EF;
        transition: background-color 0.3s ease;
    }
    body.dark-mode .about-advantage {
        background-color: var(--bg-section-gray);
    }

    /* Values cards */
    .about-value-card {
        background-color: #F5F3EF;
        transition: background-color 0.3s ease;
    }
    body.dark-mode .about-value-card {
        background-color: var(--bg-card);
    }
    body.dark-mode .about-value-card .d-flex[style*="background-color: #fff1f3"] {
        background-color: rgba(212, 0, 50, 0.15) !important;
    }

    /* Impact section right panel */
    .about-impact-content {
        background-color: #F5F3EF;
        transition: background-color 0.3s ease;
    }
    body.dark-mode .about-impact-content {
        background-color: var(--bg-section-gray);
    }

    /* Quote box text */
    body.dark-mode .quote-box .quote-text {
        color: #e1e1e1 !important;
    }

    /* Impact stats box */
    body.dark-mode .impact-stat-box {
        background: rgba(212, 0, 50, 0.1) !important;
        border-color: rgba(212, 0, 50, 0.25) !important;
    }

    /* CTA section */
    body.dark-mode .about-cta-section {
        background-color: var(--bg-section-gray) !important;
        border-color: var(--border-color) !important;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

{{-- Hero Section --}}
<div class="w-100 mb-0 d-flex flex-column align-items-center about-hero" style="
    height: 623px;
    margin-top: -1px; 
    background-size: cover;
    background-position: center;
    padding-top: 130px;
">
    <div class="container d-flex flex-column align-items-center text-center">
        
        {{-- Subtitle --}}
        <span class="text-white mb-3 d-block" 
            style="font-family: 'DM Sans', sans-serif; font-weight: 900; font-size: 24px; line-height: 100%; letter-spacing: 0; text-transform: uppercase; width: 100%; text-align: center;">
            PCCI - VALENZUELA
        </span>

        {{-- Main Headline --}}
        <h1 class="headline-text fw-bold mb-4 text-uppercase text-white" 
            style="font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">
            Empowering Valenzuela's <span style="color: #EB3223; font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">Future.</span>
        </h1>

        {{-- Paragraph --}}
        <p class="text-white" 
        style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 24px; line-height: 120%; letter-spacing: 0; text-align: center; width: 100%; max-width: 1262px; margin: 0 auto 30px auto;">
            We are passionately committed to fostering economic growth, driving innovation, and building a resilient community.
        </p>

        {{-- Buttons --}}
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a onclick="window.location.href='{{ route('signup') }}'" class="btn btn-light px-4 py-2 fw-bold text-uppercase" 
               style="font-family: 'DM Sans', sans-serif; font-size: 16px; letter-spacing: 0.05em; border-radius: 6px; color: #EB3223; font-weight: 900;">
                Become a Member
            </a>
            <a href="#impact" class="btn btn-outline-light px-4 py-2 fw-bold text-uppercase" 
               style="font-family: 'DM Sans', sans-serif; font-size: 16px; letter-spacing: 0.05em; border-radius: 6px; font-weight: 900;">
                Discover our Impact
            </a>
        </div>
    </div>
</div>

{{-- Our Purpose Section --}}
{{-- Applied var(--bg-section-gray) --}}
<div class="py-5" style="background-color: var(--bg-section-gray); transition: background-color 0.3s ease;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="fw-bold text-uppercase mb-3 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; color: #D40032;">
                    Our Purpose
                </span>
                <h2 class="fw-bold mb-4" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.2; color: var(--text-main);">
                    Guiding Principles for a Thriving Valenzuela.
                </h2>
                
                <div class="mb-4">
                    <h5 class="fw-bold mb-2" style="font-family: 'Poppins', sans-serif; color: #D40032;">Our Mission</h5>
                    <p style="font-family: 'DM Sans', sans-serif; line-height: 1.7; color: var(--text-secondary); font-size: 1.05rem;">
                        To champion the growth and success of Valenzuela businesses through robust advocacy, impactful networking, comprehensive development programs, and dedicated community engagement.
                    </p>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-2" style="font-family: 'Poppins', sans-serif; color: #D40032;">Our Vision</h5>
                    <p style="font-family: 'DM Sans', sans-serif; line-height: 1.7; color: var(--text-secondary); font-size: 1.05rem;">
                        To be the leading catalyst for a vibrant, innovative, and sustainable business environment in Valenzuela City, recognized for driving economic prosperity and community well-being.
                    </p>
                </div>

                {{-- Quote Box --}}
                <div class="p-4 mb-4 quote-box">
                    <p class="fst-italic mb-3 quote-text" style="font-family: 'DM Sans', sans-serif; line-height: 1.8; color: var(--text-secondary); font-size: 1.1rem;">
                        "Together, we are forging a resilient and dynamic future for Valenzuela. Our Chamber is committed to empowering every member to reach their full potential and contribute to our city's collective success."
                    </p>
                    <p class="fw-bold mb-0" id="quoteAttribution" style="font-family: 'DM Sans', sans-serif; color: #D40032;">– President, PCCI Valenzuela</p>
                </div>

                <a href="{{ route('leadership') }}" class="btn text-white px-4 py-2 fw-bold text-uppercase d-inline-flex align-items-center gap-2" 
                   style="font-family: 'DM Sans', sans-serif; font-size: 0.9rem; letter-spacing: 0.05em; background-color: #D40032; border-radius: 6px;">
                    Meet Our Leadership
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="col-lg-6">
                <style>
                    @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
                    .pres-card {
                        position: relative;
                        border-radius: 16px;
                        overflow: hidden;
                        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
                        background: #1a1a2e;
                    }
                    .pres-card .pres-img {
                        width: 100%;
                        min-height: 520px;
                        object-fit: cover;
                        display: none;
                    }
                    .pres-card .pres-skeleton {
                        width: 100%;
                        min-height: 520px;
                        background: linear-gradient(135deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
                        background-size: 200% 100%;
                        animation: shimmer 1.5s infinite;
                    }
                    body.dark-mode .pres-card .pres-skeleton {
                        background: linear-gradient(135deg, #2a2a35 25%, #3a3a45 50%, #2a2a35 75%);
                        background-size: 200% 100%;
                    }
                    .pres-card .pres-fallback {
                        display: none;
                        width: 100%;
                        min-height: 520px;
                        background: linear-gradient(135deg, #252631, #3a3a4a);
                        align-items: center;
                        justify-content: center;
                    }
                    .pres-card .pres-info-bar {
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        padding: 28px 28px 24px;
                        background: linear-gradient(to top, rgba(26,26,46,0.95) 0%, rgba(26,26,46,0.75) 60%, transparent 100%);
                        display: none;
                    }
                    .pres-card .pres-info-bar .pres-badge {
                        display: inline-block;
                        background: #D40032;
                        color: #fff;
                        font-family: 'DM Sans', sans-serif;
                        font-size: 0.65rem;
                        font-weight: 700;
                        text-transform: uppercase;
                        letter-spacing: 1.5px;
                        padding: 4px 14px;
                        border-radius: 20px;
                        margin-bottom: 10px;
                    }
                    .pres-card .pres-info-bar h5 {
                        font-family: 'Poppins', sans-serif;
                        font-size: 1.2rem;
                        font-weight: 700;
                        color: #fff;
                        margin: 0 0 4px;
                        text-transform: capitalize;
                    }
                    .pres-card .pres-info-bar p {
                        font-family: 'DM Sans', sans-serif;
                        font-size: 0.85rem;
                        color: rgba(255,255,255,0.7);
                        margin: 0;
                    }
                    @media (max-width: 992px) {
                        .pres-card .pres-img,
                        .pres-card .pres-skeleton,
                        .pres-card .pres-fallback { min-height: 420px; }
                    }
                    @media (max-width: 576px) {
                        .pres-card .pres-img,
                        .pres-card .pres-skeleton,
                        .pres-card .pres-fallback { min-height: 350px; }
                        .pres-card .pres-info-bar { padding: 20px 18px 18px; }
                        .pres-card .pres-info-bar h5 { font-size: 1rem; }
                    }
                </style>
                <div class="pres-card" id="presidentContainer">
                    {{-- Skeleton loader --}}
                    <div class="pres-skeleton" id="presidentSkeleton"></div>

                    {{-- President image --}}
                    <img src="" alt="President" id="presidentImg" class="pres-img img-fluid shadow-sm">

                    {{-- Fallback --}}
                    <div class="pres-fallback" id="presidentFallback">
                        <i class="bi bi-person-fill" style="font-size:5rem; color:rgba(255,255,255,0.15);"></i>
                    </div>

                    {{-- Info overlay --}}
                    <div class="pres-info-bar" id="presidentOverlay">
                        <span class="pres-badge" id="presidentBadge">President</span>
                        <h5 id="presidentName"></h5>
                        <p id="presidentTitle"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- The PCCI Advantage Section --}}
<div class="py-5 about-advantage">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="fw-bold text-uppercase mb-2 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; color: #D40032;">
                The PCCI Advantage
            </span>
            <h2 class="fw-bold mb-3 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); letter-spacing: -0.01em; color: var(--text-main);">
                Your Partner in Growth & Success
            </h2>
            <p class="mx-auto mb-0" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.1rem; line-height: 1.7; color: var(--text-secondary);">
                Joining PCCI Valenzuela unlocks a wealth of opportunities and resources tailored to elevate your business and drive local economic excellence.
            </p>
        </div>

        <div class="row g-4 mb-5">
            {{-- Connect & Collaborate --}}
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: var(--bg-card); transition: background-color 0.3s ease;">
                    <div class="mx-auto mb-3 feature-icon-box">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Connect & Collaborate</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                        Unlock unparalleled networking opportunities. We foster a dynamic ecosystem where businesses connect and forge powerful collaborations.
                    </p>
                </div>
            </div>

            {{-- Advocate & Represent --}}
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: var(--bg-card); transition: background-color 0.3s ease;">
                    <div class="mx-auto mb-3 feature-icon-box">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Advocate & Represent</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                        Your voice, amplified. We champion the interests of Valenzuela's businesses, ensuring your concerns are heard at key policy-making levels.
                    </p>
                </div>
            </div>

            {{-- Develop & Innovate --}}
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: var(--bg-card); transition: background-color 0.3s ease;">
                    <div class="mx-auto mb-3 feature-icon-box">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Develop & Innovate</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                        Stay ahead of the curve. Gain access to cutting-edge training and resources designed to enhance your operations and embrace innovation.
                    </p>
                </div>
            </div>

            {{-- Strengthen Community --}}
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: var(--bg-card); transition: background-color 0.3s ease;">
                    <div class="mx-auto mb-3 feature-icon-box">
                        <i class="bi bi-building-fill-check"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Build Community</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                        We invest in Valenzuela's future through community-focused programs that promote social responsibility and shared prosperity.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a onclick="window.location.href='{{ route('event') }}'" class="btn fw-bold px-4 py-2 text-uppercase d-inline-flex align-items-center gap-2 text-white"
               style="font-family: 'DM Sans', sans-serif; font-size: 0.9rem; letter-spacing: 0.05em; border-radius: 6px; background-color: #D40032;">
                Explore our Events
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- Our Values Section --}}
{{-- Applied var(--bg-section-gray) --}}
<div class="py-5" style="background-color: var(--bg-section-gray); transition: background-color 0.3s ease;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="fw-bold text-uppercase mb-2 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; color: #D40032;">
                Our Values
            </span>
            <h2 class="fw-bold mb-3 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); color: var(--text-main);">
                The Foundation of Our Commitment.
            </h2>
            <p class="mx-auto mb-0" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.05rem; line-height: 1.7; color: var(--text-secondary);">
                These principles are woven into every action we take and every service we provide to the Valenzuela business community.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Discipline --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4 about-value-card" style="border-radius: 12px;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fff1f3; border-radius: 12px;">
                        <i class="bi bi-shield-check" style="font-size: 1.75rem; color: #D40032;"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Discipline</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                        We uphold the highest levels of professional integrity and organizational order in every initiative we lead.
                    </p>
                </div>
            </div>

            {{-- Good Taste --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4 about-value-card" style="border-radius: 12px;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fff1f3; border-radius: 12px;">
                        <i class="bi bi-heart-fill" style="font-size: 1.75rem; color: #D40032;"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Good Taste</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                        Fostering a community that values quality, professional aesthetics, and thoughtful execution in business.
                    </p>
                </div>
            </div>

            {{-- Excellence --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4 about-value-card" style="border-radius: 12px;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fff1f3; border-radius: 12px;">
                        <i class="bi bi-star-fill" style="font-size: 1.75rem; color: #D40032;"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Excellence</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                        Striving for the highest standards in all our endeavors to ensure Valenzuela remains a competitive business hub.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Our Impact Section (Split Layout Style) --}}
{{-- Changed bg-white to var(--bg-body) --}}
<section class="w-100 overflow-hidden" id="impact" style="background-color: var(--bg-body); transition: background-color 0.3s ease;">
    <div class="row g-0">
        {{-- Left: Visual Side (Image) --}}
        <div class="col-lg-6 position-relative" style="min-height: 600px;">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2000" 
                 alt="Valenzuela Business Impact" 
                 class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
            
            {{-- Brand Red Tint Overlay --}}
            <div class="position-absolute top-0 start-0 w-100 h-100" 
                 style="background: linear-gradient(to right, rgba(212, 0, 50, 0.4), rgba(212, 0, 50, 0));"></div>
        </div>

        {{-- Right: Content Side --}}
        <div class="col-lg-6 d-flex flex-column justify-content-center p-5 about-impact-content">
            <div class="p-lg-4 mx-auto w-100" style="max-width: 650px;">

                {{-- Header --}}
                <span class="text-uppercase fw-bold mb-3 d-block" style="font-family: 'DM Sans', sans-serif; letter-spacing: 0.15em; font-size: 0.85rem; color: #D40032;">
                    Our Impact
                </span>
                <h2 class="fw-bold mb-4 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(2rem, 4vw, 3rem); line-height: 1.1; color: var(--text-main);">
                    Building a Stronger Valenzuela, One Business at a Time.
                </h2>
                <p class="mb-5" style="font-family: 'DM Sans', sans-serif; line-height: 1.7; font-size: 1.1rem; color: var(--text-secondary);">
                    We measure our success by the tangible growth and prosperity of our members and the broader Valenzuela community.
                </p>

                {{-- Stats Grid --}}
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="p-4 h-100 impact-stat-box" style="background: rgba(212, 0, 50, 0.05); border: 1px solid rgba(212, 0, 50, 0.15); border-radius: 12px;">
                            <h3 class="fw-bold mb-1" id="stat-members" style="font-family: 'Poppins', sans-serif; font-size: 2.2rem; letter-spacing: -0.02em; color: #D40032;">...</h3>
                            <div class="fw-bold text-uppercase mb-2" style="font-family: 'DM Sans', sans-serif; font-size: 0.75rem; letter-spacing: 0.05em; color: var(--text-main);">Active Members</div>
                            <p class="mb-0 small" style="font-family: 'DM Sans', sans-serif; color: var(--text-secondary);">Growing network</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 h-100 impact-stat-box" style="background: rgba(212, 0, 50, 0.05); border: 1px solid rgba(212, 0, 50, 0.15); border-radius: 12px;">
                            <h3 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif; font-size: 2.2rem; letter-spacing: -0.02em; color: #D40032;">32+</h3>
                            <div class="fw-bold text-uppercase mb-2" style="font-family: 'DM Sans', sans-serif; font-size: 0.75rem; letter-spacing: 0.05em; color: var(--text-main);">Years of Service</div>
                            <p class="mb-0 small" style="font-family: 'DM Sans', sans-serif; color: var(--text-secondary);">Dedicated progress</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 h-100 impact-stat-box" style="background: rgba(212, 0, 50, 0.05); border: 1px solid rgba(212, 0, 50, 0.15); border-radius: 12px;">
                            <h3 class="fw-bold mb-1" id="stat-events" style="font-family: 'Poppins', sans-serif; font-size: 2.2rem; letter-spacing: -0.02em; color: #D40032;">...</h3>
                            <div class="fw-bold text-uppercase mb-2" style="font-family: 'DM Sans', sans-serif; font-size: 0.75rem; letter-spacing: 0.05em; color: var(--text-main);">Events Hosted</div>
                            <p class="mb-0 small" style="font-family: 'DM Sans', sans-serif; color: var(--text-secondary);">Fostering connections</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 h-100 impact-stat-box" style="background: rgba(212, 0, 50, 0.05); border: 1px solid rgba(212, 0, 50, 0.15); border-radius: 12px;">
                            <h3 class="fw-bold mb-1" id="stat-applicants" style="font-family: 'Poppins', sans-serif; font-size: 2.2rem; letter-spacing: -0.02em; color: #D40032;">...</h3>
                            <div class="fw-bold text-uppercase mb-2" style="font-family: 'DM Sans', sans-serif; font-size: 0.75rem; letter-spacing: 0.05em; color: var(--text-main);">Applicants</div>
                            <p class="mb-0 small" style="font-family: 'DM Sans', sans-serif; color: var(--text-secondary);">Business applications</p>
                        </div>
                    </div>
                </div>

                <script>
                (function() {
                    function animateCount(el, target) {
                        let current = 0;
                        const duration = 600;
                        const steps = 30;
                        const increment = target / steps;
                        const interval = duration / steps;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                clearInterval(timer);
                                el.textContent = target;
                            } else {
                                el.textContent = Math.floor(current);
                            }
                        }, interval);
                    }

                    async function fetchAboutStats() {
                        const token = localStorage.getItem('token');
                        const headers = { 'Accept': 'application/json' };
                        if (token) headers['Authorization'] = `Bearer ${token}`;

                        // Fetch members (business directory - public)
                        try {
                            const res = await fetch(`${window.API_BASE_URL}/v1/business`, { headers });
                            const data = await res.json();
                            if (res.ok) {
                                const count = data.data ? data.data.length : (Array.isArray(data) ? data.length : 0);
                                animateCount(document.getElementById('stat-members'), count);
                            } else {
                                document.getElementById('stat-members').textContent = '—';
                            }
                        } catch (e) { document.getElementById('stat-members').textContent = '—'; }

                        // Fetch events (public)
                        try {
                            const res = await fetch(`${window.API_BASE_URL}/v1/events`, { headers: { 'Accept': 'application/json' } });
                            const data = await res.json();
                            if (res.ok) {
                                const count = data.data ? data.data.length : (Array.isArray(data) ? data.length : 0);
                                animateCount(document.getElementById('stat-events'), count);
                            } else {
                                document.getElementById('stat-events').textContent = '—';
                            }
                        } catch (e) { document.getElementById('stat-events').textContent = '—'; }

                        // Fetch applicants (needs auth)
                        if (token) {
                            try {
                                const res = await fetch(`${window.API_BASE_URL}/v1/applicants`, { headers });
                                const data = await res.json();
                                if (res.ok) {
                                    const count = data.data ? data.data.length : (Array.isArray(data) ? data.length : 0);
                                    animateCount(document.getElementById('stat-applicants'), count);
                                } else {
                                    document.getElementById('stat-applicants').textContent = '—';
                                }
                            } catch (e) { document.getElementById('stat-applicants').textContent = '—'; }
                        } else {
                            document.getElementById('stat-applicants').textContent = '—';
                        }
                    }

                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', fetchAboutStats);
                    } else {
                        fetchAboutStats();
                    }
                })();
                </script>

            </div>
        </div>
    </div>
</section>

{{-- Swiper CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

{{-- Community Gallery Section --}}
{{-- Class community-section handles the background color change via CSS at the top --}}
<div class="community-section">
    <div class="container-fluid px-0">
        {{-- Section Header --}}
        <div class="text-center mb-4">
            <span class="fw-bold text-uppercase mb-2 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.15em; color: #D40032;">
                Gallery
            </span>
            <h2 class="fw-bold text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); color: var(--text-main);">
                Glimpses of our <span style="color: #D40032;">Community</span> in Action
            </h2>
        </div>

        <div class="carousel-outer-container">
            {{-- Navigation Arrow - Left --}}
            <button class="nav-arrow nav-prev" id="prevBtn" aria-label="Previous slide">
                <i class="bi bi-chevron-left" style="font-size: 1.5rem;"></i>
            </button>

            {{-- Carousel Content --}}
            <div class="carousel-content">
                <div class="swiper communitySwiper">
                    <div class="swiper-wrapper">
                        {{-- Slide 1: Networking --}}
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?q=80&w=800&h=600&fit=crop" alt="PCCI Valenzuela Networking">
                        </div>
                        {{-- Slide 2: Industry/Manufacturing --}}
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=800&h=600&fit=crop" alt="Valenzuela Industry">
                        </div>
                        {{-- Slide 3: Team Collaboration --}}
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=800&h=600&fit=crop" alt="Business Collaboration">
                        </div>
                        {{-- Slide 4: Leadership Meeting --}}
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=800&h=600&fit=crop" alt="Board Meeting">
                        </div>
                        {{-- Slide 5: Seminar/Workshop --}}
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1540317580384-e5d43616b9aa?q=80&w=800&h=600&fit=crop" alt="Business Workshop">
                        </div>
                    </div>
                    
                    {{-- Pagination Dots --}}
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            {{-- Navigation Arrow - Right --}}
            <button class="nav-arrow nav-next" id="nextBtn" aria-label="Next slide">
                <i class="bi bi-chevron-right" style="font-size: 1.5rem;"></i>
            </button>
        </div>
    </div>
</div>

{{-- Swiper JS Implementation --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper with Coverflow Effect
        var swiper = new Swiper('.communitySwiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            loop: true,
            
            // Smooth premium animation speed
            speed: 800,
            
            // Refined Coverflow configuration
            coverflowEffect: {
                rotate: 0,
                stretch: 100, // Pulls slides closer for overlap
                depth: 250,   // Enhances the 3D perspective
                modifier: 1,
                slideShadows: false,
            },
            
            // Interactive Pagination (Brand Red via CSS)
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: false,
            },
            
            // Autoplay with user-friendly pause
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Optimized Touch for Mobile
            touchRatio: 1.5,
            resistance: true,
            resistanceRatio: 0.85,
        });
        
        // Custom Navigation Elements
        var prevBtn = document.getElementById('prevBtn');
        var nextBtn = document.getElementById('nextBtn');
        
        // Manual Navigation triggers
        if(prevBtn && nextBtn) {
            prevBtn.addEventListener('click', function() {
                swiper.slidePrev(800);
            });
            
            nextBtn.addEventListener('click', function() {
                swiper.slideNext(800);
            });
            
            // Tactile Feedback for Navigation Buttons
            [prevBtn, nextBtn].forEach(function(btn) {
                btn.addEventListener('mousedown', function() {
                    this.style.transform = 'translateY(-50%) scale(0.92)';
                });
                btn.addEventListener('mouseup', function() {
                    this.style.transform = 'translateY(-50%) scale(1)';
                });
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(-50%) scale(1)';
                });
            });
        }
    });
</script>

{{-- Final CTA Section --}}
{{-- Changed bg-white to var(--bg-body) --}}
<section class="py-5 border-top" style="background-color: var(--bg-body); border-color: var(--border-color) !important; transition: background-color 0.3s ease;">
    <div class="container text-center py-5">
        {{-- Section Header --}}
        <span class="fw-bold text-uppercase mb-3 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.15em; color: #D40032;">
            Take the Next Step
        </span>
        <h2 class="fw-bold mb-4 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 5vw, 2.75rem); color: var(--text-main); line-height: 1.2;">
            Be Part of Valenzuela's <br class="d-none d-md-block"> Business Renaissance.
        </h2>
        
        <p class="mx-auto mb-5" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.15rem; line-height: 1.8; color: var(--text-secondary);">
            PCCI Valenzuela is more than a chamber; it's a community dedicated to fostering a vibrant, sustainable, and inclusive business environment. Invest in your growth and the future of our city.
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            {{-- Primary Action --}}
            <a onclick="window.location.href='{{ route('signup') }}'" class="btn text-white fw-bold px-5 py-3 text-uppercase d-inline-flex align-items-center gap-3 shadow-sm" 
               style="font-family: 'DM Sans', sans-serif; background-color: #D40032; border: none; border-radius: 6px; font-size: 1rem; letter-spacing: 0.05em;">
                Become a Member Today
                <i class="bi bi-arrow-right" style="font-size: 1.2rem;"></i>
            </a>

            {{-- Secondary Action --}}
            <a href="{{ url('/contact') }}" class="btn btn-outline-danger fw-bold px-5 py-3 text-uppercase" 
               style="font-family: 'DM Sans', sans-serif; border-radius: 6px; font-size: 1rem; letter-spacing: 0.05em; border: 2px solid #D40032; color: #D40032;">
                Contact Us
            </a>
        </div>
    </div>
</section>

{{-- Fetch President from API --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const skeleton  = document.getElementById('presidentSkeleton');
    const img       = document.getElementById('presidentImg');
    const fallback  = document.getElementById('presidentFallback');
    const overlay   = document.getElementById('presidentOverlay');
    const nameEl    = document.getElementById('presidentName');
    const titleEl   = document.getElementById('presidentTitle');
    const badgeEl   = document.getElementById('presidentBadge');
    const quoteEl   = document.getElementById('quoteAttribution');

    fetch(window.API_BASE_URL + '/v1/trustees')
        .then(res => res.json())
        .then(data => {
            const trustees = Array.isArray(data) ? data : (data.data || []);

            const president = trustees.find(t => {
                let pos = '';
                if (t.position && typeof t.position === 'object') pos = t.position.position || '';
                else if (typeof t.position === 'string') pos = t.position;
                return pos.toLowerCase() === 'president';
            });

            skeleton.style.display = 'none';

            if (!president) {
                fallback.style.display = 'flex';
                return;
            }

            const gender = (president.gender || '').toLowerCase();
            const prefix = gender === 'female' ? 'Ms.' : 'Mr.';
            const fullName = `${prefix} ${president.firstname || ''}${president.middlename ? ' ' + president.middlename : ''} ${president.lastname || ''}`.trim();

            let posName = 'President';
            if (president.position && typeof president.position === 'object') posName = president.position.position || 'President';

            nameEl.textContent = fullName;
            titleEl.textContent = 'PCCI Valenzuela';
            badgeEl.textContent = posName;
            overlay.style.display = 'block';

            if (president.image_url) {
                img.src = president.image_url;
                img.alt = fullName;
                img.onload = function() { img.style.display = 'block'; };
                img.onerror = function() { fallback.style.display = 'flex'; };
            } else {
                fallback.style.display = 'flex';
            }

            if (quoteEl) {
                quoteEl.textContent = '– ' + fullName + ', ' + posName;
            }
        })
        .catch(err => {
            console.error('Error fetching president:', err);
            skeleton.style.display = 'none';
            fallback.style.display = 'flex';
        });
});
</script>

@endsection