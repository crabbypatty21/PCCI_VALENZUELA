@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="w-100 mb-0 d-flex flex-column align-items-center" style="
    height: 623px;
    margin-top: -1px; 
    background-color: #252631;
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
<div class="py-5" style="background-color: #e9ecef;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="fw-bold text-uppercase mb-3 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; color: #D40032;">
                    Our Purpose
                </span>
                <h2 class="fw-bold mb-4" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.2; color: #212529;">
                    Guiding Principles for a Thriving Valenzuela.
                </h2>
                
                <div class="mb-4">
                    <h5 class="fw-bold mb-2" style="font-family: 'Poppins', sans-serif; color: #D40032;">Our Mission</h5>
                    <p style="font-family: 'DM Sans', sans-serif; line-height: 1.7; color: #4b4b4b; font-size: 1.05rem;">
                        To champion the growth and success of Valenzuela businesses through robust advocacy, impactful networking, comprehensive development programs, and dedicated community engagement.
                    </p>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-2" style="font-family: 'Poppins', sans-serif; color: #D40032;">Our Vision</h5>
                    <p style="font-family: 'DM Sans', sans-serif; line-height: 1.7; color: #4b4b4b; font-size: 1.05rem;">
                        To be the leading catalyst for a vibrant, innovative, and sustainable business environment in Valenzuela City, recognized for driving economic prosperity and community well-being.
                    </p>
                </div>

                <div class="p-4 mb-4" style="background-color: #fff1f3; border-radius: 12px; border-left: 5px solid #D40032;">
                    <p class="fst-italic mb-3" style="font-family: 'DM Sans', sans-serif; line-height: 1.8; color: #2c2c2c; font-size: 1.1rem;">
                        "Together, we are forging a resilient and dynamic future for Valenzuela. Our Chamber is committed to empowering every member to reach their full potential and contribute to our city's collective success."
                    </p>
                    <p class="fw-bold mb-0" style="font-family: 'DM Sans', sans-serif; color: #D40032;">– Mr. Jundio Salvador, President</p>
                </div>

                <a href="{{ route('leadership') }}" class="btn text-white px-4 py-2 fw-bold text-uppercase d-inline-flex align-items-center gap-2" 
                   style="font-family: 'DM Sans', sans-serif; font-size: 0.9rem; letter-spacing: 0.05em; background-color: #D40032; border-radius: 6px;">
                    Meet Our Leadership
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1000" 
                         alt="President Jundio Salvador" 
                         class="img-fluid shadow-sm"
                         style="border-radius: 12px; border: 8px solid white;">
                    
                    <div class="position-absolute bottom-0 start-0 p-4 text-white w-100" 
                         style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); border-radius: 0 0 12px 12px;">
                        <h5 class="fw-bold mb-0" style="font-family: 'Poppins', sans-serif;">Mr. Jundio Salvador</h5>
                        <p class="mb-0" style="font-family: 'DM Sans', sans-serif; opacity: 0.9;">President, PCCI Valenzuela</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- The PCCI Advantage Section --}}
<div class="py-5" style="background-color: #D40032;">
    <div class="container text-white py-4">
        <div class="text-center mb-5">
            <span class="text-white fw-bold text-uppercase mb-2 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; opacity: 0.9;">
                The PCCI Advantage
            </span>
            <h2 class="fw-bold mb-3 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); letter-spacing: -0.01em;">
                Your Partner in Growth & Success
            </h2>
            <p class="mx-auto mb-0" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.1rem; line-height: 1.7; opacity: 0.9;">
                Joining PCCI Valenzuela unlocks a wealth of opportunities and resources tailored to elevate your business and drive local economic excellence.
            </p>
        </div>

        <div class="row g-4 mb-5">
            {{-- Connect & Collaborate --}}
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: white;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fff1f3; border-radius: 12px;">
                        <i class="bi bi-people-fill" style="font-size: 1.75rem; color: #D40032;"></i>
                    </div>
                    <h5 class="fw-bold mb-3 text-dark" style="font-family: 'Poppins', sans-serif;">Connect & Collaborate</h5>
                    <p class="text-secondary mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6;">
                        Unlock unparalleled networking opportunities. We foster a dynamic ecosystem where businesses connect and forge powerful collaborations.
                    </p>
                </div>
            </div>

            {{-- Advocate & Represent --}}
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: white;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fff1f3; border-radius: 12px;">
                        <i class="bi bi-megaphone-fill" style="font-size: 1.75rem; color: #D40032;"></i>
                    </div>
                    <h5 class="fw-bold mb-3 text-dark" style="font-family: 'Poppins', sans-serif;">Advocate & Represent</h5>
                    <p class="text-secondary mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6;">
                        Your voice, amplified. We champion the interests of Valenzuela's businesses, ensuring your concerns are heard at key policy-making levels.
                    </p>
                </div>
            </div>

            {{-- Develop & Innovate --}}
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: white;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fff1f3; border-radius: 12px;">
                        <i class="bi bi-lightbulb-fill" style="font-size: 1.75rem; color: #D40032;"></i>
                    </div>
                    <h5 class="fw-bold mb-3 text-dark" style="font-family: 'Poppins', sans-serif;">Develop & Innovate</h5>
                    <p class="text-secondary mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6;">
                        Stay ahead of the curve. Gain access to cutting-edge training and resources designed to enhance your operations and embrace innovation.
                    </p>
                </div>
            </div>

            {{-- Strengthen Community --}}
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: white;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fff1f3; border-radius: 12px;">
                        <i class="bi bi-building-fill-check" style="font-size: 1.75rem; color: #D40032;"></i>
                    </div>
                    <h5 class="fw-bold mb-3 text-dark" style="font-family: 'Poppins', sans-serif;">Build Community</h5>
                    <p class="text-secondary mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6;">
                        We invest in Valenzuela's future through community-focused programs that promote social responsibility and shared prosperity.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a onclick="window.location.href='{{ route('event') }}'" class="btn btn-light fw-bold px-4 py-2 text-uppercase d-inline-flex align-items-center gap-2" 
               style="font-family: 'DM Sans', sans-serif; font-size: 0.9rem; letter-spacing: 0.05em; border-radius: 6px; color: #D40032;">
                Explore our Events
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- Our Values Section --}}
<div class="py-5" style="background-color: #e9ecef;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="fw-bold text-uppercase mb-2 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; color: #D40032;">
                Our Values
            </span>
            <h2 class="fw-bold mb-3 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); color: #212529;">
                The Foundation of Our Commitment.
            </h2>
            <p class="text-secondary mx-auto mb-0" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.05rem; line-height: 1.7;">
                These principles are woven into every action we take and every service we provide to the Valenzuela business community.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Discipline --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center text-white p-4" style="border-radius: 12px; background-color: #D40032;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(255,255,255,0.15); border-radius: 12px;">
                        <i class="bi bi-shield-check" style="font-size: 1.75rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">Discipline</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; opacity: 0.9;">
                        We uphold the highest levels of professional integrity and organizational order in every initiative we lead.
                    </p>
                </div>
            </div>

            {{-- Good Taste --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center text-white p-4" style="border-radius: 12px; background-color: #D40032;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(255,255,255,0.15); border-radius: 12px;">
                        <i class="bi bi-heart-fill" style="font-size: 1.75rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">Good Taste</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; opacity: 0.9;">
                        Fostering a community that values quality, professional aesthetics, and thoughtful execution in business.
                    </p>
                </div>
            </div>

            {{-- Excellence --}}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center text-white p-4" style="border-radius: 12px; background-color: #D40032;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(255,255,255,0.15); border-radius: 12px;">
                        <i class="bi bi-star-fill" style="font-size: 1.75rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">Excellence</h5>
                    <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; opacity: 0.9;">
                        Striving for the highest standards in all our endeavors to ensure Valenzuela remains a competitive business hub.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Our Impact Section (Split Layout Style) --}}
<section class="w-100 overflow-hidden bg-white" id="impact">
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

        {{-- Right: Content Side (Brand Red Background) --}}
        <div class="col-lg-6 d-flex flex-column justify-content-center p-5" style="background-color: #D40032;">
            <div class="p-lg-4 mx-auto w-100 text-white" style="max-width: 650px;">
                
                {{-- Header --}}
                <span class="text-uppercase fw-bold mb-3 d-block" style="font-family: 'DM Sans', sans-serif; letter-spacing: 0.15em; font-size: 0.85rem; opacity: 0.9;">
                    Our Impact
                </span>
                <h2 class="fw-bold mb-4 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(2rem, 4vw, 3rem); line-height: 1.1;">
                    Building a Stronger Valenzuela, One Business at a Time.
                </h2>
                <p class="mb-5" style="font-family: 'DM Sans', sans-serif; line-height: 1.7; font-size: 1.1rem; opacity: 0.9;">
                    We measure our success by the tangible growth and prosperity of our members and the broader Valenzuela community.
                </p>

                {{-- Stats Grid --}}
                <div class="row g-4">
                    @foreach([
                        ['number' => '100+', 'label' => 'Active Members', 'desc' => 'Growing network'],
                        ['number' => '32+', 'label' => 'Years of Service', 'desc' => 'Dedicated progress'],
                        ['number' => '200+', 'label' => 'Events Hosted', 'desc' => 'Fostering connections'],
                        ['number' => '₱500M+', 'label' => 'Value Created', 'desc' => 'Facilitated growth'],
                    ] as $stat)
                    <div class="col-sm-6">
                        <div class="p-4 h-100" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px;">
                            <h3 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif; font-size: 2.2rem; letter-spacing: -0.02em;">{{ $stat['number'] }}</h3>
                            <div class="fw-bold text-uppercase mb-2" style="font-family: 'DM Sans', sans-serif; font-size: 0.75rem; letter-spacing: 0.05em; opacity: 0.9;">{{ $stat['label'] }}</div>
                            <p class="mb-0 small" style="font-family: 'DM Sans', sans-serif; opacity: 0.7;">{{ $stat['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>

{{-- Swiper CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    .community-section {
        background-color: #fdf2f4;
        padding: 80px 0;
        overflow: hidden;
    }
    
    .carousel-outer-container {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Navigation Arrows */
    .nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: white;
        border: none;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 50;
        transition: all 0.3s ease;
        color: #333;
    }
    
    .nav-arrow:hover {
        background-color: #D40032;
        color: white;
        transform: translateY(-50%) scale(1.1);
    }
    
    .nav-prev { left: 20px; }
    .nav-next { right: 20px; }
    
    /* Swiper customization */
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
        .nav-arrow { display: none; } /* Hide arrows on mobile for better touch experience */
    }
</style>

{{-- Community Gallery Section --}}
<div class="community-section">
    <div class="container-fluid px-0">
        {{-- Section Header --}}
        <div class="text-center mb-4">
            <span class="fw-bold text-uppercase mb-2 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.15em; color: #D40032;">
                Gallery
            </span>
            <h2 class="fw-bold text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); color: #212529;">
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
<section class="py-5 bg-white border-top">
    <div class="container text-center py-5">
        {{-- Section Header --}}
        <span class="fw-bold text-uppercase mb-3 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.15em; color: #D40032;">
            Take the Next Step
        </span>
        <h2 class="fw-bold mb-4 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 5vw, 2.75rem); color: #212529; line-height: 1.2;">
            Be Part of Valenzuela's <br class="d-none d-md-block"> Business Renaissance.
        </h2>
        
        <p class="text-secondary mx-auto mb-5" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.15rem; line-height: 1.8;">
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
            <a href="{{ url('/contact') }}" class="btn btn-outline-dark fw-bold px-5 py-3 text-uppercase" 
               style="font-family: 'DM Sans', sans-serif; border-radius: 6px; font-size: 1rem; letter-spacing: 0.05em;">
                Contact Us
            </a>
        </div>
    </div>
</section>

@endsection