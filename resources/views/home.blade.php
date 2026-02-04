@extends('layouts.app')

@section('title', 'Home - PCCI Valenzuela')

@section('content')

{{-- Additional Styles for Homepage --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* ===== HERO SECTION ===== */
    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        margin-top: -80px;
        padding-top: 80px;
    }
    
    .hero-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    
    .hero-slide.active {
        opacity: 1;
    }
    
    .hero-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(164, 0, 51, 0.85) 0%, rgba(26, 26, 46, 0.9) 100%);
    }
    
    .hero-content {
        position: relative;
        z-index: 10;
        max-width: 800px;
        padding: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
        font-weight: 400;
        letter-spacing: 1px;
        margin-bottom: 1rem;
        opacity: 0.95;
    }
    
    .hero-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.1;
    }
    
    .hero-description {
        font-size: 1.1rem;
        font-weight: 300;
        max-width: 600px;
        margin: 0 auto 2rem;
        opacity: 0.95;
        line-height: 1.7;
    }
    
    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    
    .btn-hero-primary {
        background-color: #A40033;
        border: 2px solid #A40033;
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 30px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-hero-primary:hover {
        background-color: #8a002b;
        border-color: #8a002b;
        color: #fff;
        transform: translateY(-2px);
    }
    
    .btn-hero-outline {
        background-color: transparent;
        border: 2px solid #fff;
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 30px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-hero-outline:hover {
        background-color: #fff;
        color: #A40033;
    }
    
    .hero-link {
        color: #fff;
        font-size: 0.9rem;
        text-decoration: underline;
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }
    
    .hero-link:hover {
        opacity: 1;
        color: #fff;
    }
    
    .hero-dots {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .hero-dot {
        width: 30px;
        height: 6px;
        border-radius: 3px;
        background-color: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .hero-dot.active {
        background-color: #fff;
        width: 40px;
    }
    
    /* ===== VALUES SECTION ===== */
    .values-section {
        padding: 5rem 0;
        background-color: #faf8f5;
    }
    
    .section-label {
        color: #EB3223;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }
    
    .section-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 1rem;
    }
    
    .section-title span {
        color: #EB3223;
    }
    
    .section-description {
        color: #6c757d;
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto 3rem;
    }
    
    .value-card {
        background: #fff;
        border-radius: 16px;
        padding: 2.5rem 2rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }
    
    .value-icon {
        width: 70px;
        height: 70px;
        background-color: #A40033;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .value-icon svg {
        width: 32px;
        height: 32px;
        stroke: #fff;
        fill: none;
    }
    
    .value-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #2d2d2d;
    }
    
    .value-description {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    /* ===== AI DISCOVERY SECTION ===== */
    .ai-discovery-section {
        padding: 5rem 0;
        background-color: #252631;
    }
    
    .ai-icon-box {
        width: 60px;
        height: 60px;
        background-color: #ffff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .ai-icon-box svg {
        width: 28px;
        height: 28px;
        stroke: #AC1D32;
        fill: none;
    }
    
    .ai-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #ffffff;
    }
    
    .ai-title span {
        color: #EB3223;
    } 
    
    .ai-description {
        color: #ffffff;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 0;
    }
    
    .search-card {
        background: #252631;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(69, 70, 123, 0.58);
    }
    
    .search-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #ffffff;
    }
    
    .search-label svg {
        width: 35px;
        height: 35px;
        background-color: #ffff;
        border-radius: 20px;
        display: flex;
        stroke: #AC1D32;
        
    }
    
    .search-input-group {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .search-input-group input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
    }
    
    .search-input-group input:focus {
        outline: none;
        border-color: #A40033;
    }
    
    .btn-search {
        background-color: #AC1D32;
        color: #fff;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .btn-search:hover {
        background-color: #8a002b;
    }
    
    .search-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: center;
    }
    
    .search-suggestions span:first-child {
        color: #ffffff;
        font-size: 0.85rem;
    }
    
    .suggestion-tag {
        background-color: #252631;
        border: 1px solid #6A8AFF;
        color: #6A8AFF;
        padding: 0.4rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .suggestion-tag:hover {
        border-color: #A40033;
        color: #A40033;
    }
    
    /* ===== VISIONARIES SECTION ===== */
    .visionaries-section {
        padding: 5rem 0;
        background-color: #EDEAE3;
        overflow: hidden;
    }

    /* Header Styling */
    .visionaries-label {
        color: #A40033;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 2px;
        margin-bottom: 0.75rem;
        text-transform: uppercase;
    }

    .visionaries-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 2.75rem;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .visionaries-title .highlight-red {
        color: #A40033;
        font-style: 'DM Sans', sans-serif;
        position: relative;
        display: inline-block;
    }
    
    .visionaries-title .highlight-blue {
        color: #A40033;
    }

    /* Carousel Wrapper */
    .visionaries-carousel-wrapper {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 80px;
    }

    /* Swiper Configuration */
    .visionaries-swiper {
        padding: 40px 0 60px;
        overflow: visible !important;
    }

    .visionaries-swiper .swiper-slide {
        width: 400px !important;
        height: 280px !important;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* Slide Card */
    .slide-card {
        width: 100%;
        height: 100%;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        background: #fff;
    }

    .slide-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    /* Inactive Slides */
    .visionaries-swiper .swiper-slide {
        opacity: 0.7;
        transform: scale(0.85);
    }

    /* Active Slide */
    .visionaries-swiper .swiper-slide-active {
        opacity: 1;
        transform: scale(1);
        z-index: 10;
    }

    .visionaries-swiper .swiper-slide-active .slide-card {
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
    }

    /* Adjacent Slides (Prev/Next) */
    .visionaries-swiper .swiper-slide-prev,
    .visionaries-swiper .swiper-slide-next {
        opacity: 0.85;
        transform: scale(0.88);
    }

    /* Navigation Arrows */
    .visionaries-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: transparent;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 50;
        transition: all 0.3s ease;
        padding: 0;
    }

    .visionaries-nav svg {
        width: 44px;
        height: 44px;
        stroke: #A40033;
        stroke-width: 2.5;
        transition: transform 0.3s ease;
    }

    .visionaries-nav:hover svg {
        transform: scale(1.15);
    }

    .visionaries-nav.prev { left: 0px; }
    .visionaries-nav.next { right: 0px; }

    .visionaries-nav.prev:hover svg { transform: translateX(-3px) scale(1.15); }
    .visionaries-nav.next:hover svg { transform: translateX(3px) scale(1.15); }

    /* Pagination Dots */
    .visionaries-swiper .swiper-pagination {
        bottom: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .visionaries-swiper .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #B8B8B8;
        opacity: 1;
        margin: 0 !important;
        transition: all 0.3s ease;
    }

    .visionaries-swiper .swiper-pagination-bullet-active {
        background: #A40033;
        transform: scale(1.2);
    }

    /* CTA Buttons */
    .visionaries-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-visionaries-primary {
        background-color: #8B0A2D;
        color: #fff;
        padding: 0.9rem 2.25rem;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid #8B0A2D;
    }

    .btn-visionaries-primary:hover {
        background-color: #6d0823;
        border-color: #6d0823;
        color: #fff;
    }

    .btn-visionaries-outline {
        background-color: transparent;
        color: #A40033;
        padding: 0.9rem 2.25rem;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        border: 2px solid #A40033;
        transition: all 0.3s ease;
    }

    .btn-visionaries-outline:hover {
        background-color: #A40033;
        color: #fff;
    }

    /* Responsive - Visionaries */
    @media (max-width: 992px) {
        .visionaries-swiper .swiper-slide {
            width: 320px !important;
            height: 240px !important;
        }
        
        .visionaries-carousel-wrapper {
            padding: 0 60px;
        }
    }

    @media (max-width: 768px) {
        .visionaries-title {
            font-size: 2rem;
        }
        
        .visionaries-swiper .swiper-slide {
            width: 280px !important;
            height: 200px !important;
        }
        
        .visionaries-carousel-wrapper {
            padding: 0 50px;
        }
        
        .visionaries-nav svg {
            width: 36px;
            height: 36px;
        }
        
        .visionaries-buttons {
            flex-direction: column;
            align-items: center;
        }
    }

    @media (max-width: 576px) {
        .visionaries-section {
            padding: 3rem 0;
        }
        
        .visionaries-title {
            font-size: 1.5rem;
        }
        
        .visionaries-swiper .swiper-slide {
            width: 240px !important;
            height: 170px !important;
        }
        
        .visionaries-carousel-wrapper {
            padding: 0 40px;
        }
        
        .visionaries-nav {
            width: 40px;
            height: 40px;
        }
        
        .visionaries-nav.prev { left: 5px; }
        .visionaries-nav.next { right: 5px; }
    }

    /* ===== MEMBER DIRECTORY SECTION ===== */
    .directory-section {
        padding: 5rem 0;
        background-color: #252631 ;
        color: #fff;
    }
    
    .directory-description {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1.5rem;
    }
    
    .directory-features {
        list-style: none;
        padding: 0;
        margin-bottom: 2rem;
    }
    
    .directory-features li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .directory-features li svg {
        width: 20px;
        height: 20px;
        fill: #A40033;
    }
    
    .btn-outline-light-custom {
        border: 2px solid #f70000;
        background-color: #fff;
        color: #f70000;
        padding: 0.75rem 1.5rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-outline-light-custom:hover {
        background-color: #fff;
        color: #1a1a2e;
    }
    
    .member-card {
        background:  rgba(0, 0, 0, 0.26);
        border: 1px solid #ffff;
        border-radius: 12px;
        width: 300px;
        padding: 1.25rem;
        display: flex;
        gap: 1rem;
        transition: all 0.3s ease;
    }
    
    .member-card:hover {
        transform: translateY(-3px);
    }
    
    .member-logo {
        width: 50px;
        height: 50px;
        border: 2px solid #ffffff;
        background: #ff0000;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .member-logo svg {
        width: 28px;
        height: 28px;
        fill: #ffffff;
    }
    
    .member-info h5 {
        font-family: 'DM Sans', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #fff;
    }
    
    .member-badge {
        background: #fff;
        color: #A40033;
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    
    .member-info p {
        font-size: 0.8rem;
        opacity: 0.9;
        margin: 0;
        line-height: 1.4;
        color: #fff;
    }
    
    /* ===== EVENTS SECTION ===== */
    .events-section {
        padding: 5rem 0;
        background-color: #faf8f5;
    }
    
    /* ===== TESTIMONIALS SECTION ===== */
    .testimonials-section {
        padding: 5rem 0;
        background-color: #fff;
    }
    
    .testimonial-card {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        height: 100%;
    }
    
    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #A40033;
        margin-bottom: 1.5rem;
    }
    
    .testimonial-text {
        color: #2d2d2d;
        font-size: 0.95rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }
    
    .testimonial-name {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 0;
    }
    
    .testimonials-nav {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
        margin-bottom: 2rem;
    }
    
    .testimonials-nav button {
        width: 45px;
        height: 45px;
        border: 1px solid #e0e0e0;
        background: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .testimonials-nav button:hover {
        border-color: #A40033;
        color: #A40033;
    }
    
    /* ===== SWIPER CUSTOMIZATION ===== */
    /* .swiper-pagination-bullet {
        background: #A40033;
    }
    
    .swiper-pagination-bullet-active {
        background: #A40033;
    }
     */
    /* ===== RESPONSIVE ===== */
    @media (max-width: 767px) {
        .hero-title {
            font-size: 2.25rem;
        }
        
        .section-title {
            font-size: 1.75rem;
        }
        
        .ai-title {
            font-size: 1.75rem;
        }
        
        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1920&q=80');"></div>
    <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1559223607-a43c990c692c?w=1920&q=80');"></div>
    <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=1920&q=80');"></div>
    
    <div class="hero-content">
        <p class="hero-subtitle">Philippine Chamber of Commerce and Industry</p>
        <h1 class="hero-title">PCCI – Valenzuela</h1>
        <p class="hero-description">
            Empowering local businesses and fostering economic growth in Valenzuela City through collaboration, networking, and advocacy. Join our vibrant community of entrepreneurs and business leaders.
        </p>
        <div class="hero-buttons">
            <a href="{{ url('/membership') }}" class="btn-hero-primary">Join PCCI Today</a>
            <a href="{{ route('about') }}" class="btn-hero-outline">Learn More</a>
        </div>
        <a href="{{ route('login') }}" class="hero-link">Already a Member?</a>
        
        <div class="hero-dots">
            <div class="hero-dot active" data-slide="0"></div>
            <div class="hero-dot" data-slide="1"></div>
            <div class="hero-dot" data-slide="2"></div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <div class="text-center">
            <p class="section-label">OUR VALUES</p>
            <h2 class="section-title">The Foundation of our Commitment.</h2>
            <p class="section-description">These principles are woven into every action we take and every service we provide.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon">
                        <svg viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="value-title">Discipline</h3>
                    <p class="value-description">Fostering a community that values quality, aesthetics, and thoughtful experiences.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon">
                        <svg viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="value-title">Good Taste</h3>
                    <p class="value-description">Fostering a community that values quality, aesthetics, and thoughtful experiences.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon">
                        <svg viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h3 class="value-title">Excellence</h3>
                    <p class="value-description">Striving for the highest standards in all our endeavors and initiatives.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- AI Discovery Section -->
<section class="ai-discovery-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="ai-icon-box">
                    <svg viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="ai-title">AI-<span>Powered</span><br>Member Discovery</h2>
                <p class="ai-description">Describe your needs in detail, and our intelligent assistant will carefully assess your requirements to connect you with the most suitable PCCI Valenzuela members who can provide the right products, services, or expertise.</p>
            </div>
            <div class="col-lg-7">
                <div class="search-card">
                    <div class="search-label">
                        <svg viewBox="0 0 24 24" stroke-width="2" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>What are you looking for?</span>
                    </div>
                    <div class="search-input-group">
                        <input type="text" placeholder="e.g., 'Architect for new office'">
                        <button class="btn-search">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                            Search
                        </button>
                    </div>
                    <div class="search-suggestions">
                        <span>Suggestions:</span>
                        <span class="suggestion-tag">Office Renovation</span>
                        <span class="suggestion-tag">Digital marketing agency</span>
                        <span class="suggestion-tag">Office Renovation</span>
                        <span class="suggestion-tag">Digital marketing agency</span>
                        <span class="suggestion-tag">Local Events Catering</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visionaries Section -->
<section class="visionaries-section">
    <div class="container-fluid px-0">
        <div class="text-center mb-5">
            <p class="visionaries-label">PCCI – VALENZUELA</p>
            <h2 class="visionaries-title">Meet the <span class="highlight-red">Visionaries</span> Behind Our <span class="highlight-blue">Success</span></h2>
        </div>
        
        <div class="visionaries-carousel-wrapper">
            <!-- Navigation Arrow - Left -->
            <button class="visionaries-nav prev" id="visionaries-prev" aria-label="Previous slide">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            
            <!-- Swiper Carousel -->
            <div class="swiper visionaries-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-card">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&h=400&fit=crop" alt="Officer 1">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-card">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&h=400&fit=crop" alt="Officer 2">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-card">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=600&h=400&fit=crop" alt="Officer 3">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-card">
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600&h=400&fit=crop" alt="Officer 4">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-card">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=400&fit=crop" alt="Officer 5">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-card">
                            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&h=400&fit=crop" alt="Officer 6">
                        </div>
                    </div>
                </div>
                
                <!-- Pagination Dots -->
                <div class="swiper-pagination"></div>
            </div>
            
            <!-- Navigation Arrow - Right -->
            <button class="visionaries-nav next" id="visionaries-next" aria-label="Next slide">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
        
        <div class="visionaries-buttons">
            <a href="#" class="btn-visionaries-primary">Learn More</a>
            <a href="#" class="btn-visionaries-outline">Browse Members</a>
        </div>
    </div>
</section>

<!-- Member Directory Section -->
<section class="directory-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <p class="section-label">MEMBER DIRECTORY</p>
                <h2 class="section-title" style="color: #fff;">Discover Local <span>Businesses</span></h2>
                <p class="directory-description">Explore our comprehensive directory of member businesses across various industries in Valenzuela City.</p>
                <ul class="directory-features">
                    <li>
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#EB3223"/><path d="M8 12l2 2 4-4" stroke="#fff" stroke-width="2" fill="none"/></svg>
                        Connect with local entrepreneurs
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#EB3223"/><path d="M8 12l2 2 4-4" stroke="#fff" stroke-width="2" fill="none"/></svg>
                        Find business partners and suppliers
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#EB3223"/><path d="M8 12l2 2 4-4" stroke="#fff" stroke-width="2" fill="none"/></svg>
                        Support local commerce
                    </li>
                </ul>
                <a href="{{ url('/membership') }}" class="btn-outline-light-custom">
                    View all members
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="member-card">
                            <div class="member-logo">
                                <svg viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div class="member-info">
                                <h5>1234 Company ABC</h5>
                                <span class="member-badge">Services</span>
                                <p>123 company lusemnu kakarochi providing goods to you</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="member-card">
                            <div class="member-logo">
                                <svg viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div class="member-info">
                                <h5>1234 Company ABC</h5>
                                <span class="member-badge">Services</span>
                                <p>123 company lusemnu kakarochi providing goods to you</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="member-card">
                            <div class="member-logo">
                                <svg viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div class="member-info">
                                <h5>1234 Company ABC</h5>
                                <span class="member-badge">Services</span>
                                <p>123 company lusemnu kakarochi providing goods to you</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="member-card">
                            <div class="member-logo">
                                <svg viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div class="member-info">
                                <h5>1234 Company ABC</h5>
                                <span class="member-badge">Services</span>
                                <p>123 company lusemnu kakarochi providing goods to you</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Events Section -->
<section class="events-section">
    <div class="container">
        <div class="text-center">
            <p class="section-label">PCCI – VALENZUELA</p>
            <h2 class="section-title">Join Our Business <span>Community</span></h2>
            <p class="section-description">Participate in our upcoming events designed to foster networking, learning, and business growth</p>
        </div>
        
        <div class="text-center mt-4">
            <a href="#" class="btn-hero-primary">View All Events</a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-4">
                <p class="section-label">MEMBER DIRECTORY</p>
                <h2 class="section-title">Hear What Our Members Have to Say about PCCI-Valenzuela!</h2>
            </div>
            <div class="col-lg-8">
                <div class="testimonials-nav">
                    <button class="testimonial-prev">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <button class="testimonial-next">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
                
                <div class="swiper testimonials-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="testimonial-card">
                                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                                        <p class="testimonial-text">I am very satisfied with the quality of service and professionalism they provide. Their team is organized, responsive, and easy to work with, making the entire process smooth and efficient.</p>
                                        <p class="testimonial-name">Maria Santos</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="testimonial-card">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                                        <p class="testimonial-text">I am very satisfied with the quality of service and professionalism they provide. Their team is organized, responsive, and easy to work with, making the entire process smooth and efficient.</p>
                                        <p class="testimonial-name">Juan Dela Cruz</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="testimonial-card">
                                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                                        <p class="testimonial-text">I am very satisfied with the quality of service and professionalism they provide. Their team is organized, responsive, and easy to work with, making the entire process smooth and efficient.</p>
                                        <p class="testimonial-name">Ana Reyes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

{{-- Carousel and slider scripts --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hero Slider
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-dot');
    let currentSlide = 0;
    
    function showSlide(index) {
        heroSlides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        heroDots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        currentSlide = index;
    }
    
    heroDots.forEach((dot, index) => {
        dot.addEventListener('click', () => showSlide(index));
    });
    
    // Auto-slide
    setInterval(() => {
        const nextSlide = (currentSlide + 1) % heroSlides.length;
        showSlide(nextSlide);
    }, 5000);
    
    // Visionaries Swiper - Coverflow Effect
    if (document.querySelector('.visionaries-swiper')) {
        const visionariesSwiper = new Swiper('.visionaries-swiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            loop: true,
            speed: 600,
            coverflowEffect: {
                rotate: 0,
                stretch: 80,
                depth: 200,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: '.visionaries-swiper .swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            breakpoints: {
                320: {
                    coverflowEffect: {
                        stretch: 40,
                        depth: 100,
                    }
                },
                768: {
                    coverflowEffect: {
                        stretch: 60,
                        depth: 150,
                    }
                },
                1024: {
                    coverflowEffect: {
                        stretch: 80,
                        depth: 200,
                    }
                }
            }
        });
        
        // Navigation buttons
        document.getElementById('visionaries-prev').addEventListener('click', function() {
            visionariesSwiper.slidePrev(600);
        });
        
        document.getElementById('visionaries-next').addEventListener('click', function() {
            visionariesSwiper.slideNext(600);
        });
    }
    
    // Testimonials Swiper
    if (document.querySelector('.testimonials-swiper')) {
        const testimonialsSwiper = new Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true
        });
        
        document.querySelector('.testimonial-prev').addEventListener('click', function() {
            testimonialsSwiper.slidePrev();
        });
        
        document.querySelector('.testimonial-next').addEventListener('click', function() {
            testimonialsSwiper.slideNext();
        });
    }
});
</script>

@endsection