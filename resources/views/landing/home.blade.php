@extends('layouts.app')
@section('title', 'Home - PCCI Valenzuela')
@section('content')

@extends('layouts.app')

@section('content')

{{-- Add this line to the top of EVERY file! --}}
@include('partials.api-config')

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
        background-color: #252631; /* Fallback */
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
        color: #fff;
    }
    .hero-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.1;
        color: #ffffff !important; 
    }
    .hero-description {
        font-size: 1.1rem;
        font-weight: 300;
        max-width: 600px;
        margin: 0 auto 2rem;
        opacity: 0.95;
        line-height: 1.7;
        color: #fff;
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
        background-color: #ffffff; /* Updated to pure white to match your request */
        transition: background-color 0.3s ease;
    }

    /* LABEL (Kept red for accent, but you can change to #000 if needed) */
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
        color: #000000; /* FORCE BLACK */
        margin-bottom: 1rem;
    }

    .section-title span {
        color: #EB3223; /* Keeps the accent span red */
    }

    .section-description {
        color: #000000; /* FORCE BLACK */
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto 3rem;
        opacity: 0.8; /* Optional: Slight opacity to make it distinct from title */
    }

    .value-card {
        background: #ffffff; /* White Card */
        border: 1px solid #f0f0f0; /* Subtle border for visibility on white bg */
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
        border-color: #EB3223; /* Hover effect */
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

    .value-icon i {
        font-size: 2rem;
        color: #ffffff; /* Icon stays white inside the red box */
    }

    .value-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #000000; /* FORCE BLACK */
    }

    .value-description {
        color: #000000; /* FORCE BLACK */
        font-size: 0.9rem;
        line-height: 1.6;
    }
    /* ===== AI DISCOVERY SECTION ===== */
    .ai-discovery-section {
        padding: 5rem 0;
        background-color: #252631; /* Always dark base */
    }
    body.dark-mode .ai-discovery-section {
        background-color: #1a1a20; /* Slightly darker in dark mode */
    }
    .ai-icon-box {
        width: 60px;
        height: 60px;
        background-color: #ffffff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    body.dark-mode .ai-icon-box {
        background-color: var(--bg-card);
    }
    /* ICON REPLACEMENT STYLE */
    .ai-icon-box i {
        font-size: 1.75rem;
        color: #AC1D32;
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
        color: #e0e0e0;
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
    body.dark-mode .search-card {
        background-color: #1e1e24;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    .search-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #ffffff;
    }
    /* ICON REPLACEMENT STYLE */
    .search-label i {
        width: 35px;
        height: 35px;
        background-color: #ffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #AC1D32;
        font-size: 1.25rem;
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
    body.dark-mode .search-input-group input {
        background-color: #2a2a35;
        border-color: #444450;
        color: #fff;
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
    .btn-search i {
        font-size: 1rem;
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
        transition: background-color 0.3s ease;
    }
    body.dark-mode .visionaries-section {
        background-color: var(--bg-body);
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
    body.dark-mode .visionaries-title {
        color: var(--text-main);
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
        /* REMOVED: style="margin-right: 170px;" to fix alignment issue */
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
    body.dark-mode .slide-card {
        background: var(--bg-card);
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
        color: #A40033; /* Default Color */
    }
    body.dark-mode .visionaries-nav {
        color: var(--text-main);
    }
    /* ICON REPLACEMENT STYLE */
    .visionaries-nav i {
        font-size: 2.5rem;
        transition: transform 0.3s ease;
    }
    .visionaries-nav:hover i {
        transform: scale(1.15);
    }
    .visionaries-nav.prev { left: 0px; }
    .visionaries-nav.next { right: 0px; }
    .visionaries-nav.prev:hover i { transform: translateX(-3px) scale(1.15); }
    .visionaries-nav.next:hover i { transform: translateX(3px) scale(1.15); }
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
    /* ===== MEMBER DIRECTORY SECTION ===== */
   :root {
    --dir-bg: #252631; 
    --dir-card-bg: #000000;
    --dir-accent: #e63946;
    --dir-text: #ffffff; /* FORCE WHITE */
}

.directory-section {
    background-color: var(--dir-bg);
    color: var(--dir-text);
    padding: 100px 0;
    font-family: 'DM Sans', sans-serif;
}

/* Force all standard text to white */
h1, h2, h3, h4, h5, h6, p, span, div, li {
    color: #ffffff !important;
}

/* Override for specific colored elements if needed (like the red span) */
.text-highlight {
    color: var(--dir-accent) !important;
}

/* SECTION TEXT */
.section-desc {
    color: #ffffff !important; /* Pure white, no grey */
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    opacity: 0.9; /* Slight opacity for readability, but still white */
}

/* FEATURE LIST */
.feature-item {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 14px;
    font-size: 1.05rem;
    color: #ffffff !important; /* Pure White */
}

.feature-icon {
    width: 24px;
    height: 24px;
    background-color: var(--dir-accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white !important;
    font-size: 0.8rem;
}

/* NEW BUTTON STYLE (Red BG so text can be White) */
.btn-accent-cta {
    background: var(--dir-accent);
    color: #ffffff !important; /* White Text */
    padding: 14px 30px;
    border-radius: 8px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    border: 1px solid var(--dir-accent);
}

.btn-accent-cta:hover {
    background: transparent;
    border-color: #ffffff;
    transform: translateY(-2px);
}

/* RIGHT COLUMN - CARD STYLES */
.directory-card {
    background-color: var(--dir-card-bg);
    border: 1px solid #6B6B6B;
    border-radius: 8px;
    padding: 24px;
    height: 100%;
    transition: all 0.3s ease;
}

.directory-card:hover {
    border-color: var(--dir-accent);
    transform: translateY(-5px);
}

.card-logo-box {
    width: 50px;
    height: 50px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff !important;
    font-weight: 800;
    font-size: 1.25rem;
    flex-shrink: 0;
}

/* NEW BADGE STYLE (Outline so text can be White) */
.badge-outline-white {
    background: transparent;
    border: 1px solid rgba(255,255,255, 0.4);
    color: #ffffff !important; /* White Text */
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 4px 8px;
    border-radius: 4px;
}

.card-desc {
    color: #ffffff !important; /* Pure White */
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 0;
    opacity: 0.8; /* Slight adjustment so it doesn't clash with title */
    
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ===== EVENTS SECTION (Static Grid) ===== */
    .events-section {
        padding: 5rem 0;
        background-color: #faf8f5;
        transition: background-color 0.3s ease;
    }
    body.dark-mode .events-section {
        background-color: var(--bg-section-gray);
    }
    .events-grid-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    @media (min-width: 768px) {
        .events-grid-wrapper {
            grid-template-columns: repeat(2, 1fr); 
        }
    }
    @media (min-width: 1024px) {
        .events-grid-wrapper {
            grid-template-columns: repeat(3, 1fr); 
        }
    }
    .event-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        border: 1px solid #f3f4f6;
        display: flex;
        flex-direction: column;
    }
    body.dark-mode .event-card {
        background: var(--bg-card);
        border-color: var(--border-color);
    }
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #A40033;
    }
    .event-card-image-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
    }
    .event-card-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .event-card:hover .event-card-image-wrapper img {
        transform: scale(1.05);
    }
    /* Date Badge */
    .event-date-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #A40033;
        color: #fff;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        text-align: center;
        min-width: 60px;
        z-index: 10;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .event-date-badge .day-name {
        font-size: 0.65rem;
        font-weight: 500;
        text-transform: uppercase;
        opacity: 0.9;
        display: block;
    }
    .event-date-badge .day-number {
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        display: block;
    }
    .event-date-badge .month {
        font-size: 0.65rem;
        font-weight: 500;
        text-transform: uppercase;
        opacity: 0.9;
        display: block;
    }
    /* Card Body */
    .event-card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        text-align: left;
    }
    .event-location {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }
    body.dark-mode .event-location {
        color: var(--text-secondary);
    }
    /* ICON REPLACEMENT STYLE */
    .event-location i {
        font-size: 1rem;
        color: #A40033;
    }
    .event-card-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
        line-height: 1.4;
        min-height: 3.5rem; 
    }
    body.dark-mode .event-card-title {
        color: var(--text-main);
    }
    .btn-event-details {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        background: white;
        color: #A40033;
        padding: 0.75rem;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #A40033;
        margin-top: auto;
    }
    body.dark-mode .btn-event-details {
        background: transparent;
        color: #A40033;
    }
    .btn-event-details:hover {
        background: #A40033;
        color: #fff;
    }
    .btn-view-all-events {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: transparent;
        color: #A40033;
        padding: 0.75rem 2rem;
        border-radius: 30px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 3rem; /* More space above button */
        border: 2px solid #A40033;
    }
    .btn-view-all-events:hover {
        background: #A40033;
        color: #fff;
    }
    /* Events Section Responsive */
    @media (max-width: 992px) {
        .event-card {
            height: 360px;
        }
    }
    @media (max-width: 768px) {
        .events-section {
            padding: 3rem 0;
        }
        .event-card {
            height: 340px;
        }
        .event-card-title {
            font-size: 1.1rem;
        }
    }
    @media (max-width: 576px) {
        .events-carousel-wrapper {
            padding: 0 10px;
        }
        .event-card {
            height: 320px;
        }
        .events-nav-btn {
            width: 40px;
            height: 40px;
        }
    }
  /* ===== TESTIMONIALS SECTION ===== */
    .testimonials-section {
        padding: 5rem 0;
        background-color: #252631; /* Base Dark */
        transition: background-color 0.3s ease;
    }
    body.dark-mode .testimonials-section {
        background-color: var(--bg-body);
    }
    /* Grid Layout (Matches Events) */
    .testimonials-grid-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    @media (min-width: 768px) {
        .testimonials-grid-wrapper {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width: 1024px) {
        .testimonials-grid-wrapper {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    /* Testimonial Card Design */
    .testimonial-card {
        background: #252631; /* Light contrasting card bg */
        border-radius: 16px;
        padding: 2.5rem 2rem;
        height: 100%;
        border: 1px solid #f3f4f6;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center; /* Center content */
        text-align: center;
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
    }
    body.dark-mode .testimonial-card {
        background: var(--bg-card);
        border-color: var(--border-color);
    }
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border-color: #A40033; /* Red border on hover */
    }
    /* Quote Icon */
    .testimonial-quote-icon {
        width: 40px;
        height: 40px;
        background: #A40033;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 10px rgba(164, 0, 51, 0.3);
    }
    /* ICON REPLACEMENT STYLE */
    .testimonial-quote-icon i {
        font-size: 1.25rem;
        color: #fff;
    }
    /* Avatar */
    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }
    /* Text Content */
    .testimonial-text {
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
        line-height: 1.8;
        color: #9e9e9e;
        font-style: italic;
        margin-bottom: 1.5rem;
        flex-grow: 1; /* Pushes name to bottom */
    }
    /* Author Info */
    .testimonial-author h5 {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: #bcbcbc;
        margin-bottom: 0.2rem;
    }
    .testimonial-author span {
        font-size: 0.85rem;
        color: #A40033;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
    }

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
        background-color: #252631;
    }
    /* ... (Keep existing Hero, Values, AI, Visionaries styles) ... */


    /* =========================================
       NEW SECTIONS STYLES (ADD THESE)
       ========================================= */
     .member-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        border: 1px solid #D40032 !important;
    }
    /* ===== AFFILIATED PARTNERS SECTION ===== */
    .partners-section {
        padding: 5rem 0;
        background-color: #faf8f5; /* Cream background */
    }

    body.dark-mode .partners-section {
        background-color: var(--bg-section-gray);
    }

    .partners-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    @media (min-width: 768px) {
        .partners-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .partner-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    body.dark-mode .partner-card {
        background: var(--bg-card);
        border-color: var(--border-color);
    }

    .partner-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }

    .partner-logo {
        max-width: 80%;
        max-height: 60px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        color: #333;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Simulate the nVision logo */
    .partner-logo span { color: #A40033; font-style: italic; }

    .sponsor-card {
        background-color: #EB3223; /* Bright Red */
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        text-decoration: none;
        height: 100px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .sponsor-card:hover {
        background-color: #c91e10;
        color: #fff;
    }

    .sponsor-text {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        line-height: 1.2;
        font-size: 1.1rem;
    }

    /* ===== MAP & MEMBER DISCOVERY SECTION (MATCHING IMAGE) ===== */
    .map-section {
        background-color: #252631; /* Dark background from image footer */
        color: #fff;
        padding: 5rem 0;
    }
    
    .map-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    /* MAIN WIDGET CONTAINER */
    .map-container-box {
        display: flex;
        flex-direction: column; /* Mobile: Stack */
        background: #111111; /* Very dark container background */
        border: 1px solid #333;
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    /* LEFT SIDEBAR */
    .map-sidebar {
        width: 100%;
        background: #1B1C24; /* Dark sidebar background */
        padding: 2rem;
        display: flex;
        flex-direction: column;
        border-bottom: 1px solid #333;
    }

    .map-sidebar-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 1.5rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* INPUTS */
    .map-search-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }

    .map-search-input {
        width: 100%;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 0.75rem 1rem 0.75rem 2.5rem; /* Space for icon */
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        color: #333;
    }

    .map-search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 1rem;
    }

    .filter-label {
        font-size: 0.75rem;
        color: #888;
        margin-bottom: 0.25rem;
        display: block;
    }

    .map-filter-select {
        width: 100%;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 0.75rem 1rem;
        margin-bottom: 2rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        color: #333;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1em;
    }

    /* MEMBER LIST */
    .member-list-scroll {
        flex: 1;
        overflow-y: auto;
        padding-right: 5px;
        min-height: 300px;
        max-height: 500px; /* Limit height on mobile */
    }
    
    .member-list-scroll::-webkit-scrollbar { width: 4px; }
    .member-list-scroll::-webkit-scrollbar-track { background: #1A1A1A; }
    .member-list-scroll::-webkit-scrollbar-thumb { background: #444; border-radius: 2px; }

    /* MEMBER CARD ITEM */
    .map-member-card {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #333;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .map-member-card:hover {
        background-color: rgba(255,255,255,0.05);
    }

    .map-member-card:last-child {
        border-bottom: none;
    }

    .member-logo-box {
        width: 50px;
        height: 50px;
        background-color: #A40033; /* The red box from image */
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        font-weight: 700;
        font-size: 1.2rem;
        flex-shrink: 0;
        font-family: 'Times New Roman', serif; /* Matching "abc" style */
    }
    
    .member-info-box {
        flex: 1;
    }

    .member-badge {
        display: inline-block;
        background-color: #FFD6D6; /* Pinkish background */
        color: #A40033; /* Red text */
        font-size: 0.65rem;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
        text-transform: uppercase;
        margin-bottom: 0.35rem;
        letter-spacing: 0.5px;
    }

    .member-name {
        color: #fff;
        font-size: 0.95rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
        line-height: 1.2;
    }

    .member-desc {
        color: #888; /* Gray text */
        font-size: 0.8rem;
        margin: 0;
    }

    /* RIGHT SIDE (MAP) */
    .map-view-area {
        width: 100%;
        height: 400px; /* Mobile height */
        position: relative;
        background-color: #333;
        /* Using a satellite/dark map image as placeholder to match image */
        background-image: url('https://upload.wikimedia.org/wikipedia/commons/e/ec/Valenzuela_City_Map.png'); 
        background-size: cover;
        background-position: center;
        filter: brightness(0.9);
    }

    /* DESKTOP LAYOUT (Side by Side) */
    @media (min-width: 992px) {
        .map-container-box {
            flex-direction: row;
            height: 600px; /* Fixed height for desktop widget */
            border: 1px solid #A6A6A6;
        }

        .map-sidebar {
            width: 380px; /* Fixed width sidebar */
            border-right: 1px solid #333;
            border-bottom: none;
            flex-shrink: 0;
            padding: 2.5rem;
        }

        .map-view-area {
            height: 100%;
            flex: 1;
        }
        
        .member-list-scroll {
            max-height: none; /* Let flexbox handle height */
        }
    }

    /* --- SHARED STYLES --- */
    .section-bg-cream {
        background-color: #faf8f5; /* Light cream background from image */
        padding: 5rem 0;
    }

    .section-title-red {
        color: #EB3223;
    }

   /* --- HOW TO JOIN SECTION (CLONED UI) --- */
    .join-steps-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
        max-width: 1000px; /* Constrains width to match the partner grid look */
        margin: 3rem auto 0;
    }

    /* Desktop layout: 3 columns x 2 rows = 6 items */
    @media (min-width: 768px) {
        .join-steps-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .step-card-ui {
        background: #f4f4f4; /* Gray-ish background matching the image */
        border-top: 4px solid #EB3223; /* The distinct red top border */
        border-radius: 4px;
        height: 140px; /* Fixed height for uniformity */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08); /* Subtle drop shadow */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    body.dark-mode .step-card-ui {
        background: #1e1e24; /* Adapts to dark mode if you have it */
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .step-card-ui:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.15);
    }

    .step-number {
        font-family: 'DM Sans', sans-serif;
        font-weight: 800;
        font-size: 1.5rem;
        color: #A40033; /* Darker red for the number */
        margin-bottom: 0.25rem;
        line-height: 1;
    }

    .step-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.05rem;
        color: #333;
        margin: 0;
        line-height: 1.3;
    }

    body.dark-mode .step-title {
        color: #fff;
    }

   /* --- BACKGROUND VIDEO SECTION --- */
    .video-section {
        position: relative;
        padding: 10rem 0; /* Height of the section */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .video-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures video covers the whole area */
        z-index: 0;
    }

    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6); /* Darkens video so text is readable */
        z-index: 1;
    }

    .video-content {
        position: relative;
        z-index: 2; /* Puts text above the video */
        text-align: center;
        max-width: 800px;
        padding: 0 20px;
    }

   .btn-video-cta {
    position: relative;
    display: inline-block;
    padding: 12px 30px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    background-color: #AC1D32;
    text-decoration: none;
    overflow: hidden;
    transition: color 0.4s ease;
}

.btn-video-cta::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: #fff;
    transition: left 0.4s ease;
    z-index: 0;
}

.btn-video-cta:hover::before {
    left: 0;
}

.btn-video-cta span {
    position: relative;
    z-index: 1;
}

.btn-video-cta:hover {
    color: #AC1D32;
}

</style>

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
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="value-title">Discipline</h3>
                    <p class="value-description">Fostering a community that values quality, aesthetics, and thoughtful experiences.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon">
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h3 class="value-title">Good Taste</h3>
                    <p class="value-description">Fostering a community that values quality, aesthetics, and thoughtful experiences.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon">
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <h3 class="value-title">Excellence</h3>
                    <p class="value-description">Striving for the highest standards in all our endeavors and initiatives.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ai-discovery-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="ai-icon-box">
                    {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                    <i class="bi bi-cpu-fill"></i>
                </div>
                <h2 class="ai-title">AI-<span>Powered</span><br>Member Discovery</h2>
                <p class="ai-description">Describe your needs in detail, and our intelligent assistant will carefully assess your requirements to connect you with the most suitable PCCI Valenzuela members who can provide the right products, services, or expertise.</p>
            </div>
            <div class="col-lg-7">
                <div class="search-card">
                    <div class="search-label">
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-search"></i>
                        <span>What are you looking for?</span>
                    </div>
                    <div class="search-input-group">
                        <input type="text" placeholder="e.g., 'Architect for new office'">
                        <button class="btn-search">
                            {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                            <i class="bi bi-search"></i>
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
<section class="visionaries-section">
    <div class="container-fluid px-0 position-relative">
        <div class="text-center mb-5">
            <p class="visionaries-label">PCCI – VALENZUELA</p>
            <h2 class="visionaries-title">Meet the <span class="highlight-red">Visionaries</span> Behind Our <span class="highlight-blue">Success</span></h2>
        </div>
        <button class="visionaries-nav prev" id="visionaries-prev" aria-label="Previous slide" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); z-index: 10;">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="visionaries-nav next" id="visionaries-next" aria-label="Next slide" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); z-index: 10;">
            <i class="bi bi-chevron-right"></i>
        </button>
        {{-- REMOVED inline margin-right style here to fix the "push to right" issue --}}
        <div class="visionaries-carousel-wrapper"> 
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
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="visionaries-buttons">
            <a href="#" class="btn-visionaries-primary">Learn More</a>
            <a href="#" class="btn-visionaries-outline">Browse Members</a>
        </div>
    </div>
</section>

@php
    $networkBusinesses = collect([
        [
            'id' => 1,
            'name' => 'Tech Solutions', 
            'initials' => 'TS', 
            'hex' => '#3b82f6', // Blue for Tech
            'category' => 'Technology', 
            'industry' => 'SaaS Development'
        ],
        [
            'id' => 2,
            'name' => 'Green Earth', 
            'initials' => 'GE', 
            'hex' => '#10b981', // Green for Eco
            'category' => 'Eco-Friendly', 
            'industry' => 'Agriculture & Supply'
        ],
        [
            'id' => 3,
            'name' => 'Urban Build', 
            'initials' => 'UB', 
            'hex' => '#f59e0b', // Orange for Const
            'category' => 'Construction', 
            'industry' => 'Real Estate Dev'
        ],
        [
            'id' => 4,
            'name' => 'MediCare Plus', 
            'initials' => 'MC', 
            'hex' => '#ef4444', // Red for Health
            'category' => 'Healthcare', 
            'industry' => 'Medical Equipment'
        ],
    ]);
@endphp

<section class="directory-section">
    <div class="container">
        <div class="row align-items-center">
            
            {{-- LEFT COLUMN --}}
            <div class="col-lg-5 mb-5 mb-lg-0">
                
                <span class="section-label" style="color: #ffffff !important;">Member Directory</span>
                
                <h2 class="section-title">
                    Discover Local <span class="text-highlight">Businesses</span>
                </h2>
                
                <p class="section-desc">
                    Explore our comprehensive directory of member businesses across various industries in Marikina City.
                </p>
                
                <ul class="feature-list">
                    <li class="feature-item">
                        <div class="feature-icon"><i class="bi bi-arrow-right"></i></div>
                        Connect with local entrepreneurs
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon"><i class="bi bi-arrow-right"></i></div>
                        Find business partners and suppliers
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon"><i class="bi bi-arrow-right"></i></div>
                        Support local commerce
                    </li>
                </ul>
                
                {{-- UPDATED BUTTON: Red Background, White Text --}}
                <a href="{{ url('/membership') }}" class="btn-accent-cta">
                    View all members <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="col-lg-7">
                <div class="row g-4">
                    @foreach ($networkBusinesses->take(4) as $business)
                        <div class="col-md-6">
                            <a href="{{ route('business.show', $business['id']) }}" class="text-decoration-none">
                                <div class="directory-card">
                                    
                                    <div class="d-flex align-items-center mb-3">
                                        {{-- Logo Box --}}
                                        <div class="card-logo-box" style="background-color: {{ $business['hex'] }};">
                                            {{ $business['initials'] }}
                                        </div>
                                        
                                        <div class="ms-3 overflow-hidden">
                                            <h5 class="text-truncate mb-1" style="font-size: 1.1rem; font-weight: 700;">
                                                {{ $business['name'] }}
                                            </h5>
                                            
                                            {{-- UPDATED BADGE: White Border, White Text --}}
                                            <span class="badge-outline-white">
                                                {{ $business['category'] }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <p class="card-desc">
                                        {{ $business['industry'] }} company providing excellent goods for you and your business needs.
                                    </p>

                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<section class="events-section">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">PCCI – VALENZUELA</p>
            <h2 class="section-title">Join Our Business <span>Community</span></h2>
            <p class="section-description">Participate in our upcoming events designed to foster networking, learning, and business growth</p>
        </div>
        <div class="events-grid-wrapper">
            <div class="event-card">
                <div class="event-card-image-wrapper">
                    <div class="event-date-badge">
                        <span class="day-name">Tue</span>
                        <span class="day-number">21</span>
                        <span class="month">Jan</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=400&fit=crop" alt="Event Image">
                </div>
                <div class="event-card-body">
                    <div class="event-location">
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-geo-alt-fill"></i>
                        Valenzuela City
                    </div>
                    <h3 class="event-card-title">Most Outstanding Advocacy Award National Tourism</h3>
                    <a href="{{ route('event') }}" class="btn-event-details">View Details</a>
                </div>
            </div>
            <div class="event-card">
                <div class="event-card-image-wrapper">
                    <div class="event-date-badge">
                        <span class="day-name">Wed</span>
                        <span class="day-number">05</span>
                        <span class="month">Feb</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=600&h=400&fit=crop" alt="Event Image">
                </div>
                <div class="event-card-body">
                    <div class="event-location">
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-geo-alt-fill"></i>
                        PCCI Hall
                    </div>
                    <h3 class="event-card-title">Business Networking Summit 2025</h3>
                    <a href="{{ route('event') }}" class="btn-event-details">View Details</a>
                </div>
            </div>
            <div class="event-card">
                <div class="event-card-image-wrapper">
                    <div class="event-date-badge">
                        <span class="day-name">Fri</span>
                        <span class="day-number">15</span>
                        <span class="month">Mar</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&h=400&fit=crop" alt="Event Image">
                </div>
                <div class="event-card-body">
                    <div class="event-location">
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-geo-alt-fill"></i>
                        Valenzuela Trade Center
                    </div>
                    <h3 class="event-card-title">Entrepreneurship Workshop Series</h3>
                    <a href="{{ route('event') }}" class="btn-event-details">View Details</a>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('event') }}" class="btn-view-all-events">
                View All Events
                {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<section class="testimonials-section">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">MEMBER VOICES</p>
            <h2 class="section-title" style="color: #fff;">What Our Members <span style="color: #EB3223;">Say</span></h2>
            <p class="section-description" style="color: rgba(255,255,255,0.7);">Real stories from business leaders who have grown with PCCI-Valenzuela.</p>
        </div>
        <div class="testimonials-grid-wrapper">
            <div class="testimonial-card">
                <div class="testimonial-quote-icon">
                    {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                    <i class="bi bi-quote"></i>
                </div>
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                <p class="testimonial-text">"PCCI Valenzuela has been instrumental in connecting us with key partners. The networking events are top-notch and always well-organized."</p>
                <div class="testimonial-author">
                    <h5>Maria Santos</h5>
                    <span>CEO, Santos Trading</span>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-quote-icon">
                    {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                    <i class="bi bi-quote"></i>
                </div>
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                <p class="testimonial-text">"The advocacy programs have really helped our industry voice concerns to the local government. Highly recommended for any business owner."</p>
                <div class="testimonial-author">
                    <h5>Juan Dela Cruz</h5>
                    <span>Founder, TechSolutions</span>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-quote-icon">
                    {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                    <i class="bi bi-quote"></i>
                </div>
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                <p class="testimonial-text">"Joining PCCI was the best decision for my startup. The mentorship and support from fellow members are invaluable."</p>
                <div class="testimonial-author">
                    <h5>Ana Reyes</h5>
                    <span>Director, Reyes Logistics</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="partners-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Affiliated <span style="color: #EB3223;">Partners</span></h2>
            <p class="section-description">We appreciate the organizations that support our mission and community.</p>
        </div>

        <div class="partners-grid">
            <div class="partner-card">
                <div class="partner-logo">
                    <span>n</span>Vision
                </div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">
                    <span>n</span>Vision
                </div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">
                    <span>n</span>Vision
                </div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">
                    <span>n</span>Vision
                </div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">
                    <span>n</span>Vision
                </div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">
                    <span>n</span>Vision
                </div>
            </div>
            <div class="partner-card">
                <div class="partner-logo">
                    <span>n</span>Vision
                </div>
            </div>
            <a href="{{ route('contact') }}" class="sponsor-card">
                <span class="sponsor-text">Become<br>a Sponsor</span>
            </a>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="container">
        <div class="map-header">
            <p class="section-label" style="color: #fff; letter-spacing: 2px; font-size: 0.8rem; margin-bottom: 10px;">OUR NETWORK</p>
            <h2 class="section-title" style="color: white; font-size: 2.5rem;">Discover <span style="color: #EB3223;">Our Members</span> Around the City</h2>
            <p class="section-description" style="color: #aaa; margin-top: 10px;">Discover the locations of our diverse member businesses through the interactive map below.</p>
        </div>

        <div class="map-container-box">
            
            <div class="map-sidebar">
                <div class="map-sidebar-title">OUR MEMBERS</div>
                
                <div class="map-search-wrapper">
                    <i class="bi bi-search map-search-icon"></i>
                    <input type="text" class="map-search-input" placeholder="Search members...">
                </div>
                
                <div>
                    <span class="filter-label">Filter by Industry</span>
                    <select class="map-filter-select">
                        <option value="">Select Industry</option>
                        <option value="manufacturing">Manufacturing</option>
                        <option value="services">Services</option>
                        <option value="retail">Retail</option>
                    </select>
                </div>

                <div class="member-list-scroll">
                    
                    <div class="map-member-card">
                        <div class="member-logo-box">
                            <span style="font-family: serif; font-style: italic;">abc</span>
                        </div>
                        <div class="member-info-box">
                            <span class="member-badge">MANUFACTURING</span>
                            <div class="member-name">Abcor Industrial Corp.</div>
                            <p class="member-desc">For you metal fabrication needs.</p>
                        </div>
                    </div>
                    
                    <div class="map-member-card">
                        <div class="member-logo-box">
                            <span style="font-family: serif; font-style: italic;">abc</span>
                        </div>
                        <div class="member-info-box">
                            <span class="member-badge">MANUFACTURING</span>
                            <div class="member-name">Abcor Industrial Corp.</div>
                            <p class="member-desc">For you metal fabrication needs.</p>
                        </div>
                    </div>

                    <div class="map-member-card">
                        <div class="member-logo-box">
                            <span style="font-family: serif; font-style: italic;">abc</span>
                        </div>
                        <div class="member-info-box">
                            <span class="member-badge">MANUFACTURING</span>
                            <div class="member-name">Abcor Industrial Corp.</div>
                            <p class="member-desc">For you metal fabrication needs.</p>
                        </div>
                    </div>

                    <div class="map-member-card">
                        <div class="member-logo-box">
                            <span style="font-family: serif; font-style: italic;">abc</span>
                        </div>
                        <div class="member-info-box">
                            <span class="member-badge">MANUFACTURING</span>
                            <div class="member-name">Abcor Industrial Corp.</div>
                            <p class="member-desc">For you metal fabrication needs.</p>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="map-view-area">
                <div style="position: absolute; top: 45%; left: 55%; color: #EB3223; font-size: 2rem; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.5)); cursor: pointer;">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                
                <div style="position: absolute; bottom: 20px; right: 20px; display: flex; flex-direction: column; gap: 5px;">
                    <button style="width: 32px; height: 32px; background: white; border: none; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.3); font-weight: bold; color: #444;">+</button>
                    <button style="width: 32px; height: 32px; background: white; border: none; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.3); font-weight: bold; color: #444;">-</button>
                </div>
            </div>
            
        </div>
    </div>
</section>

@php
    // Fetching the first 6 items from your membership array
    $networkBusinesses = [
        ['id' => 1, 'name' => 'Tech Corp Inc.', 'category' => 'Manufacturing', 'industry' => 'Technology & Software', 'email' => 'contact@techcorp.ph', 'phone' => '+63 912 345', 'color' => 'bg-primary', 'initials' => 'TC', 'tags' => ['Hardware', 'Software']],
        ['id' => 2, 'name' => 'Green Fields', 'category' => 'Distributor', 'industry' => 'Agriculture & Supply', 'email' => 'sales@greenfields.com', 'phone' => '(02) 8123', 'color' => 'bg-success', 'initials' => 'GF', 'tags' => ['Organic', 'Wholesale']],
        ['id' => 3, 'name' => 'BuildLink', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 4, 'name' => 'BuildLink 4', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 5, 'name' => 'BuildLink 5', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 6, 'name' => 'BuildLink 6', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
    ];
@endphp

<section class="py-5" style="background-color: #F7F5F0; transition: background-color 0.3s ease;">
    <div class="container px-4 px-lg-5">
        
        {{-- Header Section to match the Image --}}
        <div class="text-center mb-5">
            {{-- Small Red Eyebrow Text --}}
            <h6 class="fw-bold text-uppercase mb-2" style="color: #D40032; letter-spacing: 0.05em; font-size: 0.85rem;">
                Our Network
            </h6>

            {{-- Main Title --}}
            <h2 class="section-title mb-3" style="color: #1a1a1a; font-family: 'DM Sans', sans-serif; font-weight: 800; font-size: 2.5rem;">
                Why Join PCCI <span style="color: #D40032;">Valenzuela</span>
            </h2>

            {{-- Subtitle Description --}}
            <p class="section-description mx-auto" style="max-width: 700px; color: #6c757d; font-size: 1.1rem; font-weight: 500;">
                Discover the locations of our diverse member businesses through the interactive map below.
            </p>
        </div>

        {{-- Business Cards Grid --}}
        <div class="row g-4">
            @foreach ($networkBusinesses as $business)
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('business.show', $business['id']) }}" 
                       class="card h-100 border-0 shadow p-3 text-decoration-none member-card-hover" 
                       style="border-radius: 12px; 
                              background-color: #242530; 
                              display: block; 
                              transition: all 0.3s ease;">                        
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle {{ $business['color'] }} d-flex align-items-center justify-content-center {{ $business['color'] == 'bg-warning' ? 'text-dark' : 'text-white' }} fw-bold" style="width: 56px; height: 56px; font-size: 1.2rem;">
                                {{ $business['initials'] }}
                            </div>
                            <div>
                                <span class="d-inline-block rounded px-2 py-1 mb-1 fw-bold text-uppercase text-white" style="font-size: 0.65rem; background-color: rgba(255, 255, 255, 0.15);">
                                    {{ $business['category'] }}
                                </span>
                                <h5 class="fw-bold mb-0 text-white">{{ $business['name'] }}</h5>
                                <small class="text-white" style="opacity: 0.8;">{{ $business['industry'] }}</small>
                            </div>
                        </div>
                        
                        <div class="card-body p-0 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                <div class="d-flex gap-2 small">
                                    @foreach ($business['tags'] as $tag)
                                        <span class="px-2 py-1 rounded text-white" style="background-color: rgba(255, 255, 255, 0.1); font-weight: 600;">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top" style="border-color: rgba(255, 255, 255, 0.1) !important;">
                                <div class="small text-white" style="opacity: 0.9;">
                                    <i class="bi bi-envelope"></i> {{ $business['email'] }}<br>
                                    <i class="bi bi-telephone"></i> {{ $business['phone'] }}
                                </div>
                                
                                <span class="btn py-1 px-3 text-white fw-bold" style="background-color: #D40032; border-radius: 6px; font-size: 0.8rem;">
                                    View Details
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Bottom Button --}}
        <div class="text-center mt-5">
            <a href="{{ url('/membership') }}" class="btn fw-bold text-white px-4 py-3 text-uppercase" style="background-color: #D40032; border-radius: 6px; font-size: 0.95rem; letter-spacing: 0.05em;">
                View Full Directory <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

    </div>
</section>


<section class="video-section">
    <video class="video-bg" autoplay muted loop playsinline poster="{{ asset('images/TRY.png') }}">
        
        <source src="{{ asset('videos/Vid1.mp4') }}" type="video/mp4">
        
        Your browser does not support the video tag.
    </video>

    <div class="video-overlay"></div>

    <div class="container video-content d-flex flex-column align-items-center justify-content-center text-center">
        
        <h2 class="section-title" style="color: #fff; font-size: clamp(1.5rem, 4vw, 3rem); margin-bottom: 1.5rem; white-space: nowrap;">
         Ready to Join Our <span style="color: #EB3223;">Business</span> Community?
        </h2>
        
        <p class="section-description mx-auto" style="color: rgba(255,255,255,0.9); font-size: 1.25rem; line-height: 1.8; max-width: 800px;">
            Become a member of PCCI Valenzuela and unlock opportunities for growth, networking, and business development.
        </p>

        <a href="{{ route('signup') }}" class="btn-video-cta">
           <span>Join PCCI Today</span>
        </a>
        
    </div>
</section>

{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
{{-- Carousel and slider scripts --}}
<script>
    if (document.querySelector('.events-swiper')) {
    const eventsSwiper = new Swiper('.events-swiper', {
    });
    }  
    if (document.querySelector('.testimonials-swiper')) {
    const testimonialsSwiper = new Swiper('.testimonials-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true
    });
    // ...
}
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
            // UPDATED: Added native navigation config here
            navigation: {
                nextEl: '#visionaries-next',
                prevEl: '#visionaries-prev',
            },
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
        // UPDATED: Removed the manual event listeners for prevBtn/nextBtn here
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