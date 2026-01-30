@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="position-relative w-100 overflow-hidden" style="background: linear-gradient(135deg, rgba(245, 48, 3, 0.9), rgba(200, 35, 0, 0.9)), url('https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2069') center/cover; min-height: 500px;">
    <div class="container text-white text-center py-5" style="position: relative; z-index: 2;">
        <p class="text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.1em; opacity: 0.95;">
            JOIN PCCI - VALENZUELA
        </p>
        <h1 class="display-4 fw-bold mb-4" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1.2;">
            Empowering Valenzuela's Future, Together.
        </h1>
        <p class="mx-auto mb-5" style="max-width: 800px; font-size: 1.1rem; line-height: 1.7; opacity: 0.95;">
            PCCI New Marikina is the vibrant heart of our city's business ecosystem. We are passionately committed to fostering economic growth, driving innovation, and building a resilient community where every enterprise can flourish.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#membership" class="btn btn-light fw-bold px-4 py-2" style="border-radius: 6px; text-decoration: none; color: #F53003;">
                Become a Member
            </a>
            <a href="#impact" class="btn btn-outline-light fw-bold px-4 py-2" style="border-radius: 6px; text-decoration: none;">
                Discover our Impact
            </a>
        </div>
    </div>
</div>

{{-- Our Purpose Section --}}
<div class="bg-light text-dark py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h6 class="text-accent fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.05em;">OUR PURPOSE</h6>
                <h2 class="fw-bold mb-4" style="font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.3;">
                    Guiding Principles for a Thriving Valenzuela.
                </h2>
                
                <div class="mb-4">
                    <h5 class="text-accent fw-bold mb-3">Our Mission</h5>
                    <p style="line-height: 1.8; color: #4a4a4a;">
                        To champion the growth and success of Marikina businesses through robust advocacy, impactful networking, comprehensive development programs, and dedicated community engagement.
                    </p>
                </div>

                <div class="mb-5">
                    <h5 class="text-accent fw-bold mb-3">Our Vision</h5>
                    <p style="line-height: 1.8; color: #4a4a4a;">
                        To be the leading catalyst for a vibrant, innovative, and sustainable business environment in Marikina City, recognized for driving economic prosperity and community well-being.
                    </p>
                </div>

                <div class="p-4 mb-4" style="background-color: #ffe5e0; border-radius: 8px; border-left: 4px solid #F53003;">
                    <p class="fst-italic mb-3" style="line-height: 1.8; color: #2c2c2c; font-size: 1.05rem;">
                        "Together, we are forging a resilient and dynamic future for Valenzuela. Our Chamber is committed to empowering every member to reach their full potential and contribute to our city's collective success."
                    </p>
                    <p class="text-accent fw-bold mb-0">– Mr. Jundio Salvador, President</p>
                </div>

                <a href="{{ route('leadership') }}" class="btn btn-danger fw-bold px-4 py-2 d-inline-flex align-items-center gap-2" style="background-color: #F53003; border: none; border-radius: 6px;">
                    Meet Our Leadership
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1000" 
                         alt="President" 
                         class="img-fluid rounded shadow-lg"
                         style="border-radius: 12px !important; border: 8px solid white;">
                    <div class="position-absolute bottom-0 start-0 p-4 text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); width: 100%; border-radius: 0 0 12px 12px;">
                        <h5 class="fw-bold mb-0">Mr. Jundio Salvador</h5>
                        <p class="mb-0" style="opacity: 0.9;">President, PCCI Valenzuela</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- The PCCI Advantage Section --}}
<div class="py-5" style="background-color: #B91C1C;">
    <div class="container text-white">
        <div class="text-center mb-5">
            <p class="text-uppercase fw-bold mb-2" style="font-size: 0.9rem; letter-spacing: 0.1em; opacity: 0.9;">The PCCI Advantage</p>
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">Your Partner Growth & Success</h2>
            <p class="mx-auto" style="max-width: 800px; font-size: 1.05rem; opacity: 0.95;">
                Joining PCCI New Marikina unlocks a wealth of opportunities and resources tailored to elevate your business.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @foreach([
                [
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                    'title' => 'Connect & Collaborate',
                    'desc' => 'Unlock unparalleled networking opportunities. We foster a dynamic ecosystem where businesses connect, share insights, and forge powerful collaborations that drive mutual growth.'
                ],
                [
                    'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
                    'title' => 'Advocate and Represent',
                    'desc' => 'Your voice, amplified. We champion the interests of Marikina\'s businesses, ensuring your concerns are heard and addressed at key policy-making levels.'
                ],
                [
                    'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                    'title' => 'Develop and Innovate',
                    'desc' => 'Stay ahead of the curve. Gain access to cutting-edge training, workshops, and resources designed to enhance your operations, embrace innovation, and achieve new heights.'
                ],
                [
                    'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                    'title' => 'Strengthen our Community',
                    'desc' => 'More than just business. We actively invest in Marikina\'s future through community-focused programs and initiatives that promote social responsibility and shared prosperity.'
                ],
            ] as $advantage)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 text-center p-4" style="border-radius: 12px; background-color: white;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #FEE2E2; border-radius: 12px;">
                        <svg class="text-danger" width="30" height="30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $advantage['icon'] }}"></path>
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: #1f1f1f;">{{ $advantage['title'] }}</h5>
                    <p class="text-secondary mb-0 small" style="line-height: 1.6;">{{ $advantage['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="#events" class="btn btn-light fw-bold px-4 py-2 d-inline-flex align-items-center gap-2" style="border-radius: 6px; color: #1f1f1f;">
                Explore our Events
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- Our Values Section --}}
<div class="bg-light text-dark py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-accent fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.05em;">Our Values</h6>
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">The Foundation of Our Commitment.</h2>
            <p class="text-secondary mx-auto" style="max-width: 800px;">
                These principles are woven into every action we take and every service we provide.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                [
                    'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                    'title' => 'Discipline',
                    'desc' => 'Unlock unparalleled networking opportunities. We foster a dynamic ecosystem where businesses connect, share insights, and forge powerful collaborations that drive mutual growth.'
                ],
                [
                    'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'title' => 'Good Taste',
                    'desc' => 'Fostering a community that values quality, aesthetics, and thoughtful execution.'
                ],
                [
                    'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                    'title' => 'Excellence',
                    'desc' => 'Striving for the highest standards in all our endeavors and initiatives.'
                ],
            ] as $value)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 text-center text-white p-4" style="border-radius: 16px; background-color: #B91C1C;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(255,255,255,0.2); border-radius: 12px;">
                        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $value['icon'] }}"></path>
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-3">{{ $value['title'] }}</h5>
                    <p class="mb-0 small" style="line-height: 1.6; opacity: 0.95;">{{ $value['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Our Impact Section --}}
<div class="py-5" style="background-color: #B91C1C;" id="impact">
    <div class="container text-white">
        <div class="text-center mb-5">
            <h6 class="text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.1em; opacity: 0.9;">Our Impact</h6>
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">Building a Stronger Valenzuela, One Business at a Time.</h2>
            <p class="mx-auto" style="max-width: 800px; font-size: 1.05rem; opacity: 0.95;">
                We measure our success by the tangible growth and prosperity of our members and the broader Marikina community.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @foreach([
                ['number' => '100+', 'label' => 'Active Members', 'desc' => 'A growing network of diverse businesses', 'highlight' => true],
                ['number' => '32+', 'label' => 'Years of Service', 'desc' => 'Dedicated to Marikina\'s economic progress', 'highlight' => false],
                ['number' => '200+', 'label' => 'Events Hosted', 'desc' => 'Fostering connections and knowledge sharing', 'highlight' => false],
                ['number' => '₱500M+', 'label' => 'Business Facilitated', 'desc' => 'Fueling member collaborations and growth', 'highlight' => false],
            ] as $stat)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 text-center p-4" style="border-radius: 12px; background-color: {{ $stat['highlight'] ? '#FCA5A5' : 'white' }};">
                    <h2 class="fw-bold mb-2" style="font-size: 2.5rem; color: {{ $stat['highlight'] ? '#7F1D1D' : '#1f1f1f' }};">{{ $stat['number'] }}</h2>
                    <h6 class="fw-bold mb-2" style="color: {{ $stat['highlight'] ? '#7F1D1D' : '#1f1f1f' }};">{{ $stat['label'] }}</h6>
                    <p class="mb-0 small" style="color: {{ $stat['highlight'] ? '#7F1D1D' : '#6b7280' }};">{{ $stat['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ============================================== --}}
{{-- COMMUNITY GALLERY - SMOOTH COVERFLOW CAROUSEL --}}
{{-- ============================================== --}}

{{-- Swiper CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    .community-section {
        background-color: #fdf2f4;
        padding: 60px 0 80px;
        overflow: hidden;
    }
    
    .carousel-outer-container {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .carousel-content {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    
    /* Navigation Arrows - Far sides */
    .nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: transparent;
        border: none;
        cursor: pointer;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .nav-arrow:hover {
        transform: translateY(-50%) scale(1.15);
    }
    
    .nav-arrow:active {
        transform: translateY(-50%) scale(0.95);
    }
    
    .nav-arrow svg {
        width: 40px;
        height: 40px;
        stroke: #333;
        stroke-width: 2;
        fill: none;
        transition: stroke 0.3s ease;
    }
    
    .nav-arrow:hover svg {
        stroke: #A40033;
    }
    
    .nav-prev {
        left: 20px;
    }
    
    .nav-next {
        right: 20px;
    }
    
    /* Swiper customization */
    .communitySwiper {
        width: 100%;
        padding: 40px 0 60px;
        overflow: visible;
    }
    
    .communitySwiper .swiper-wrapper {
        align-items: center;
        transition-timing-function: cubic-bezier(0.25, 0.1, 0.25, 1) !important;
    }
    
    .communitySwiper .swiper-slide {
        width: 400px;
        height: 270px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        opacity: 0.5;
        transform: scale(0.85);
    }
    
    .communitySwiper .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .communitySwiper .swiper-slide:hover img {
        transform: scale(1.05);
    }
    
    /* Active slide - prominent center */
    .communitySwiper .swiper-slide-active {
        opacity: 1;
        transform: scale(1);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        z-index: 10;
    }
    
    /* Adjacent slides */
    .communitySwiper .swiper-slide-prev,
    .communitySwiper .swiper-slide-next {
        opacity: 0.7;
        transform: scale(0.9);
    }
    
    /* Pagination Dots */
    .swiper-pagination {
        position: relative;
        margin-top: 25px;
        bottom: auto !important;
    }
    
    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #ccc;
        opacity: 1;
        margin: 0 6px !important;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border-radius: 50%;
    }
    
    .swiper-pagination-bullet:hover {
        background: #999;
        transform: scale(1.2);
    }
    
    .swiper-pagination-bullet-active {
        background: #333;
        transform: scale(1.4);
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .nav-prev {
            left: 10px;
        }
        
        .nav-next {
            right: 10px;
        }
    }
    
    @media (max-width: 992px) {
        .communitySwiper .swiper-slide {
            width: 350px;
            height: 240px;
        }
        
        .nav-arrow svg {
            width: 32px;
            height: 32px;
        }
    }
    
    @media (max-width: 768px) {
        .communitySwiper .swiper-slide {
            width: 300px;
            height: 210px;
        }
        
        .nav-prev {
            left: 5px;
        }
        
        .nav-next {
            right: 5px;
        }
        
        .nav-arrow svg {
            width: 28px;
            height: 28px;
        }
    }
    
    @media (max-width: 576px) {
        .communitySwiper .swiper-slide {
            width: 260px;
            height: 180px;
        }
        
        .nav-arrow {
            width: 40px;
            height: 40px;
        }
        
        .nav-arrow svg {
            width: 24px;
            height: 24px;
        }
    }
</style>

<div class="community-section">
    <div class="container-fluid px-0">
        <div class="text-center  text-dark mb-4">
            <h2 class="fw-bold" style="font-size: clamp(1.75rem, 4vw, 2.5rem); font-family: 'DM Sans', sans-serif;">Glimpses of our Community in Action</h2>
        </div>

        <div class="carousel-outer-container">
            {{-- Navigation Arrow - Left --}}
            <button class="nav-arrow nav-prev" id="prevBtn" aria-label="Previous slide">
                <svg viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            {{-- Carousel Content --}}
            <div class="carousel-content">
                <div class="swiper communitySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?q=80&w=800&h=600&fit=crop" alt="Mountain Lake">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1470252649378-9c29740c9fa8?q=80&w=800&h=600&fit=crop" alt="Sunset Dock">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1475924156734-496f6cac6ec1?q=80&w=800&h=600&fit=crop" alt="Flower Field">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=800&h=600&fit=crop" alt="Team Meeting">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&h=600&fit=crop" alt="Portrait">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=800&h=600&fit=crop" alt="Workshop">
                        </div>
                    </div>
                    
                    {{-- Pagination Dots --}}
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            {{-- Navigation Arrow - Right --}}
            <button class="nav-arrow nav-next" id="nextBtn" aria-label="Next slide">
                <svg viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>
</div>

{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper('.communitySwiper', {
            // Coverflow effect
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            loop: true,
            
            // Smooth animation settings
            speed: 800,
            
            // Coverflow configuration
            coverflowEffect: {
                rotate: 0,
                stretch: 100,
                depth: 250,
                modifier: 1,
                slideShadows: false,
            },
            
            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: false,
            },
            
            // Autoplay with smooth transition
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            
            // Smooth easing
            cssMode: false,
            
            // Keyboard navigation
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Touch settings for smooth mobile experience
            touchRatio: 1.5,
            touchAngle: 45,
            
            // Resistance for edge bounce
            resistance: true,
            resistanceRatio: 0.85,
        });
        
        // Custom navigation with smooth animation
        var prevBtn = document.getElementById('prevBtn');
        var nextBtn = document.getElementById('nextBtn');
        
        prevBtn.addEventListener('click', function() {
            swiper.slidePrev(800); // 800ms smooth transition
        });
        
        nextBtn.addEventListener('click', function() {
            swiper.slideNext(800); // 800ms smooth transition
        });
        
        // Add visual feedback on button click
        [prevBtn, nextBtn].forEach(function(btn) {
            btn.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(-50%) scale(0.9)';
            });
            btn.addEventListener('mouseup', function() {
                this.style.transform = 'translateY(-50%) scale(1.15)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-50%) scale(1)';
            });
        });
    });
</script>

{{-- ============================================== --}}
{{-- END COMMUNITY GALLERY CAROUSEL --}}
{{-- ============================================== --}}

{{-- Final CTA Section --}}
<div class="py-5 bg-white">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem); color: #1f1f1f;">
            Be Part of our Valenzuela's Business Renaissance.
        </h2>
        <p class="text-secondary mx-auto mb-5" style="max-width: 800px; font-size: 1.05rem; line-height: 1.7;">
            PCCI Valenzuela is more than a chamber; it's a community dedicated to fostering a vibrant, sustainable, and inclusive business environment. Invest in your future and the future of Valenzuela.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#membership" class="btn btn-danger fw-bold px-5 py-3" style="background-color: #F53003; border: none; border-radius: 6px; font-size: 1.1rem;">
                Become a Member Today
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="#contact" class="btn btn-outline-dark fw-bold px-5 py-3" style="border-radius: 6px; font-size: 1.1rem;">
                Contact Us
            </a>
            
        </div>
    </div>
</div>

@endsection