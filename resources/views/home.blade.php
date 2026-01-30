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
        color: #A40033;
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
        color: #A40033;
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
        background-color: #f8f5f2;
    }
    
    .ai-icon-box {
        width: 60px;
        height: 60px;
        background-color: #A40033;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .ai-icon-box svg {
        width: 28px;
        height: 28px;
        stroke: #fff;
        fill: none;
    }
    
    .ai-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #2d2d2d;
    }
    
    .ai-title span {
        color: #A40033;
    }
    
    .ai-description {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 0;
    }
    
    .search-card {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    }
    
    .search-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #2d2d2d;
    }
    
    .search-label svg {
        width: 20px;
        height: 20px;
        stroke: #A40033;
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
        background-color: #A40033;
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
        color: #6c757d;
        font-size: 0.85rem;
    }
    
    .suggestion-tag {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        color: #2d2d2d;
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
    
 /* ===== CONFIGURATION ===== */
:root {
    --sw-ease: cubic-bezier(0.23, 1, 0.32, 1); /* "The Quint" - Ultra smooth */
    --sw-duration: 0.8s;
    --brand-red: #A40033;
    --glass-bg: rgba(255, 255, 255, 0.85);
    --glass-border: rgba(255, 255, 255, 0.5);
}

.officers-section {
    padding: 6rem 0;
    background: linear-gradient(to bottom, #fdf2f4 0%, #fff 100%);
    overflow: hidden;
}

.officers-carousel-wrapper {
    position: relative;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

.officers-swiper {
    padding: 60px 0 80px;
    overflow: visible !important;
}

/* ===== SLIDE ARCHITECTURE ===== */
.officers-swiper .swiper-slide {
    width: 300px !important;
    height: 420px !important; /* Portrait orientation looks more modern */
    border-radius: 20px;
    position: relative;
    z-index: 1;
    /* We don't animate width/height anymore - it causes jitter. 
       We animate scale instead for 60fps performance. */
    transition: transform var(--sw-duration) var(--sw-ease),
                opacity var(--sw-duration) var(--sw-ease),
                z-index 0s linear 0.4s; /* Delay z-index change */
}

/* The Container inside the slide (Mask) */
.slide-inner {
    position: absolute;
    inset: 0;
    border-radius: 20px;
    overflow: hidden;
    background: #000;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transform: translateZ(0); /* Hardware Acceleration */
    transition: box-shadow var(--sw-duration) var(--sw-ease);
}

/* The Image - Parallax Setup */
.officers-swiper .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Zoomed out slightly initially */
    transform: scale(1.2); 
    filter: grayscale(100%) brightness(0.7);
    transition: transform var(--sw-duration) var(--sw-ease),
                filter var(--sw-duration) var(--sw-ease);
    will-change: transform;
}

/* Gradient Overlay for Text Readability */
.slide-inner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 60%);
    opacity: 0.6;
    transition: opacity 0.5s ease;
}

/* ===== TEXT ANIMATION ===== */
.officer-info {
    position: absolute;
    bottom: 30px;
    left: 25px;
    right: 25px;
    z-index: 10;
    color: #fff;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.5s var(--sw-ease);
}

.officer-info h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 5px 0;
    line-height: 1.2;
}

.officer-info p {
    font-size: 0.9rem;
    font-weight: 400;
    margin: 0;
    opacity: 0.8;
    color: #ffdce5; /* Subtle tint of brand color */
}

/* ===== STATES ===== */

/* 1. Inactive State (Default) */
.officers-swiper .swiper-slide {
    transform: scale(0.85) translateY(10px);
    opacity: 0.6;
    pointer-events: none; /* Prevent clicking inactive slides */
}

/* 2. Active State (Center) */
.officers-swiper .swiper-slide-active {
    transform: scale(1.1) translateY(0);
    opacity: 1;
    z-index: 10;
    pointer-events: auto;
    transition-delay: 0s;
}

.officers-swiper .swiper-slide-active .slide-inner {
    box-shadow: 0 30px 60px rgba(164, 0, 51, 0.25), 
                0 10px 20px rgba(0,0,0,0.1);
}

.officers-swiper .swiper-slide-active img {
    transform: scale(1); /* Parallax Effect: Image shrinks as card grows */
    filter: grayscale(0%) brightness(1);
}

.officers-swiper .swiper-slide-active .officer-info {
    transform: translateY(0);
    opacity: 1;
    transition-delay: 0.3s; /* Text waits until card expands */
}

/* 3. Hover Effect on Active Slide */
.officers-swiper .swiper-slide-active:hover img {
    transform: scale(1.05); /* Gentle zoom */
}

/* ===== GLASSMORPHISM NAVIGATION ===== */
.officers-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 56px;
    height: 56px;
    
    /* Glass Effect */
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--glass-border);
    border-radius: 50%;
    
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 50;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}

.officers-nav svg {
    width: 24px;
    height: 24px;
    stroke: var(--brand-red);
    stroke-width: 2;
    transition: transform 0.3s ease;
}

.officers-nav:hover {
    background: #fff;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 15px 30px rgba(164, 0, 51, 0.15);
}

.officers-nav.prev:hover svg { transform: translateX(-3px); }
.officers-nav.next:hover svg { transform: translateX(3px); }

.officers-nav.prev { left: 10px; }
.officers-nav.next { right: 10px; }

/* ===== MODERN PAGINATION ===== */
.officers-swiper .swiper-pagination {
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.officers-swiper .swiper-pagination-bullet {
    width: 30px; /* Bars instead of dots */
    height: 4px;
    border-radius: 2px;
    background: #e0e0e0;
    opacity: 1;
    margin: 0 !important;
    transition: all 0.4s var(--sw-ease);
}

.officers-swiper .swiper-pagination-bullet-active {
    width: 50px;
    background: var(--brand-red);
    height: 4px;
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .officers-swiper .swiper-slide {
        width: 240px !important;
        height: 340px !important;
    }
    .officers-swiper .swiper-slide-active {
        transform: scale(1.05);
    }
    .officers-nav { display: none; }
}

    /* ===== MEMBER DIRECTORY SECTION ===== */
    .directory-section {
        padding: 5rem 0;
        background-color: #1a1a2e;
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
        border: 2px solid #fff;
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 30px;
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
        background: #A40033;
        border-radius: 12px;
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
        background: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .member-logo svg {
        width: 28px;
        height: 28px;
        fill: #A40033;
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
    
    /* ===== FOOTER ===== */
    .footer {
        background-color: #A40033;
        color: #fff;
        padding: 4rem 0 0;
    }
    
    .footer-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    
    .footer-logo-box {
        width: 50px;
        height: 50px;
        background: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .footer-logo-box svg {
        width: 28px;
        height: 28px;
        stroke: #A40033;
    }
    
    .footer-logo-text {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .footer-logo-text span {
        font-size: 0.7rem;
        font-weight: 400;
        display: block;
        opacity: 0.9;
    }
    
    .footer-description {
        font-size: 0.9rem;
        opacity: 0.9;
        line-height: 1.7;
        margin-bottom: 1rem;
    }
    
    .footer-social a {
        color: #fff;
        font-size: 1.25rem;
        margin-right: 1rem;
        transition: opacity 0.3s ease;
    }
    
    .footer-social a:hover {
        opacity: 0.7;
    }
    
    .footer h5 {
        font-family: 'DM Sans', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-links li {
        margin-bottom: 0.75rem;
    }
    
    .footer-links a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        font-size: 0.9rem;
        transition: opacity 0.3s ease;
    }
    
    .footer-links a:hover {
        opacity: 0.7;
    }
    
    .footer-contact li {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
    }
    
    .footer-contact li svg {
        margin-top: 3px;
        width: 18px;
        height: 18px;
        stroke: #fff;
        flex-shrink: 0;
    }
    
    .footer-contact a {
        color: #fff;
        text-decoration: none;
    }
    
    .footer-contact a:hover {
        text-decoration: underline;
    }
    
    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        padding: 1.5rem 0;
        margin-top: 3rem;
        text-align: center;
        font-size: 0.85rem;
        opacity: 0.9;
    }
    
    /* ===== SWIPER CUSTOMIZATION ===== */
    .swiper-pagination-bullet {
        background: #A40033;
    }
    
    .swiper-pagination-bullet-active {
        background: #A40033;
    }
    
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
        
        .officers-nav {
            display: none;
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
                <h2 class="ai-title"><span>AI-Powered</span><br>Member Discovery</h2>
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

<!-- Officers/Visionaries Section -->
<section class="officers-section">
    <div class="container-fluid px-0">
        <div class="text-center mb-4">
            <p class="section-label">PCCI – VALENZUELA</p>
            <h2 class="section-title">Meet the <span>Visionaries</span> Behind Our <span>Success</span></h2>
        </div>
        
        <div class="officers-carousel-wrapper">
            <!-- Navigation Arrow - Left -->
            <button class="officers-nav prev" id="officers-prev" aria-label="Previous slide">
                <svg viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            
            <!-- Swiper Carousel -->
            <div class="swiper officers-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&h=400&fit=crop" alt="Officer">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&h=400&fit=crop" alt="Officer">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=600&h=400&fit=crop" alt="Officer">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600&h=400&fit=crop" alt="Officer">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=400&fit=crop" alt="Officer">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&h=400&fit=crop" alt="Officer">
                    </div>
                </div>
                
                <!-- Pagination Dots -->
                <div class="swiper-pagination"></div>
            </div>
            
            <!-- Navigation Arrow - Right -->
            <button class="officers-nav next" id="officers-next" aria-label="Next slide">
                <svg viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
        
        <div class="officers-buttons">
            <a href="#" class="btn-hero-primary">Learn More</a>
            <a href="#" class="btn-officers-outline">Browse Members</a>
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
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#A40033"/><path d="M8 12l2 2 4-4" stroke="#fff" stroke-width="2" fill="none"/></svg>
                        Connect with local entrepreneurs
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#A40033"/><path d="M8 12l2 2 4-4" stroke="#fff" stroke-width="2" fill="none"/></svg>
                        Find business partners and suppliers
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#A40033"/><path d="M8 12l2 2 4-4" stroke="#fff" stroke-width="2" fill="none"/></svg>
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

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-logo">
                    <div class="footer-logo-box">
                        <svg viewBox="0 0 24 24" stroke-width="2" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>
                        </svg>
                    </div>
                    <div class="footer-logo-text">
                        PCCI - Valenzuela
                        <span>Philippine Chamber of Commerce</span>
                    </div>
                </div>
                <p class="footer-description">Empowering local businesses and fostering economic growth in Valenzuela City through collaboration, networking, and advocacy. Building the future of businesses in our community.</p>
                <div class="footer-social">
                    <a href="#"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ url('/membership') }}">Membership</a></li>
                    <li><a href="#">Business Directory</a></li>
                    <li><a href="#">Chamber Events</a></li>
                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5>Contact Information</h5>
                <ul class="footer-contact footer-links">
                    <li>
                        <svg viewBox="0 0 24 24" stroke-width="2" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>4th Floor, Legislative Bldg, Valenzuela City Hall, MacArthur Highway 1800 Philippines</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" stroke-width="2" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:09822658382">09822658382</a>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" stroke-width="2" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:info@pccivalenzuela.org">info@pccivalenzuela.org</a>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" stroke-width="2" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        <a href="#">pcci-valenzuela.com</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} PCCI - Valenzuela. All rights reserved. | Philippine Chamber of Commerce and Industry - Valenzuela Chapter<br>
            Fostering economic growth and business excellence in Valenzuela City</p>
        </div>
    </div>
</footer>

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
    
    // Officers Swiper - Smooth Coverflow Effect
    if (document.querySelector('.officers-swiper')) {
        const officersSwiper = new Swiper('.officers-swiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            loop: true,
            
            // Ultra smooth animation
            speed: 900,
            
            // Coverflow configuration - refined depth
            coverflowEffect: {
                rotate: 0,
                stretch: 60,
                depth: 150,
                modifier: 1.2,
                slideShadows: false,
            },
            
            // Pagination
            pagination: {
                el: '.officers-swiper .swiper-pagination',
                clickable: true,
            },
            
            // Autoplay
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            
            // Keyboard navigation
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Smooth touch
            touchRatio: 1.2,
            touchAngle: 45,
            resistance: true,
            resistanceRatio: 0.65,
            
            // Smooth transitions
            watchSlidesProgress: true,
            
            // On progress - for extra smooth fade effect
            on: {
                setTranslate: function() {
                    const slides = this.slides;
                    for (let i = 0; i < slides.length; i++) {
                        const slide = slides[i];
                        const progress = slide.progress;
                        const absProgress = Math.abs(progress);
                        
                        // Smooth opacity based on distance from center
                        let opacity = 1 - (absProgress * 0.4);
                        opacity = Math.max(opacity, 0.5);
                        
                        // Smooth scale
                        let scale = 1 - (absProgress * 0.12);
                        scale = Math.max(scale, 0.88);
                        
                        slide.style.opacity = opacity;
                        slide.style.transform = `scale(${scale}) translateZ(0)`;
                    }
                },
                setTransition: function(duration) {
                    const slides = this.slides;
                    for (let i = 0; i < slides.length; i++) {
                        slides[i].style.transition = `opacity ${duration}ms cubic-bezier(0.4, 0, 0.2, 1), transform ${duration}ms cubic-bezier(0.4, 0, 0.2, 1)`;
                    }
                }
            }
        });
        
        // Smooth navigation
        document.getElementById('officers-prev').addEventListener('click', function() {
            officersSwiper.slidePrev(900);
        });
        
        document.getElementById('officers-next').addEventListener('click', function() {
            officersSwiper.slideNext(900);
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