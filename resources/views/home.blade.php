@extends('layouts.app')

@section('title', 'Home - PCCI Valenzuela')

@section('content')

{{-- Additional Styles for Homepage --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* =========================================
       DARK MODE & THEME ADAPTATIONS
       ========================================= */
    
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
    
    /* EXPLICITLY WHITE FOR "PCCI - Valenzuela" */
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
        background-color: #faf8f5;
        transition: background-color 0.3s ease;
    }

    body.dark-mode .values-section {
        background-color: var(--bg-section-gray);
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
        color: var(--text-main); /* ADAPTIVE TEXT COLOR */
        margin-bottom: 1rem;
    }
    
    .section-title span {
        color: #EB3223;
    }
    
    .section-description {
        color: var(--text-secondary); /* ADAPTIVE TEXT COLOR */
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto 3rem;
    }
    
    .value-card {
        background: var(--bg-card); /* ADAPTIVE BG */
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
    
    /* ICON REPLACEMENT STYLE */
    .value-icon i {
        font-size: 2rem;
        color: #fff;
    }
    
    .value-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--text-main); /* ADAPTIVE TEXT COLOR */
    }
    
    .value-description {
        color: var(--text-secondary); /* ADAPTIVE TEXT COLOR */
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
        position: relative; /* Ensure relative positioning for buttons */
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
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 100px;
        box-sizing: border-box;
    }

    /* Swiper Configuration */
    .visionaries-swiper {
        padding: 40px 0 60px;
        overflow: visible !important;
        width: 100%;
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
        width: 60px;
        height: 60px;
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
        font-size: 3rem;
        transition: transform 0.3s ease;
    }

    .visionaries-nav:hover i {
        transform: scale(1.15);
        color: #8B0A2D;
    }

    /* Position buttons in the padding area */
    .visionaries-nav.prev { left: 20px; }
    .visionaries-nav.next { right: 20px; }

    .visionaries-nav.prev:hover i { transform: translateX(-5px) scale(1.15); }
    .visionaries-nav.next:hover i { transform: translateX(5px) scale(1.15); }

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
    .directory-section {
        padding: 5rem 0;
        background-color: #252631; /* Always dark base */
        color: #fff;
    }

    body.dark-mode .directory-section {
        background-color: #16161a;
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
    
    /* ICON REPLACEMENT STYLE */
    .directory-features li i {
        color: #A40033;
        font-size: 1.25rem;
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
        border-radius: 6px;
    }
    
    .btn-outline-light-custom:hover {
        background-color: #e0e0e0;
        color: #d00000;
    }
    
    .member-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        width: 100%;
        padding: 1.25rem;
        display: flex;
        gap: 1rem;
        transition: all 0.3s ease;
    }
    
    .member-card:hover {
        transform: translateY(-3px);
        background: rgba(255, 255, 255, 0.1);
        border-color: #A40033;
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
    
    /* ICON REPLACEMENT STYLE */
    .member-logo i {
        font-size: 1.5rem;
        color: #ffffff;
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
        color: #e0e0e0;
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
        
        /* Ensure visionaries buttons don't get squashed on mobile */
        .visionaries-carousel-wrapper {
            padding: 0 50px;
        }
        
        .visionaries-nav {
            width: 40px;
            height: 40px;
        }
        
        .visionaries-nav i {
            font-size: 2rem;
        }
        
        .visionaries-nav.prev { left: 10px; }
        .visionaries-nav.next { right: 10px; }
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
    <div class="container-fluid px-0">
        <div class="text-center mb-5">
            <p class="visionaries-label">PCCI – VALENZUELA</p>
            <h2 class="visionaries-title">Meet the <span class="highlight-red">Visionaries</span> Behind Our <span class="highlight-blue">Success</span></h2>
        </div>
        
        <div class="visionaries-carousel-wrapper">
            <button class="visionaries-nav prev" id="visionaries-prev" aria-label="Previous slide">
                {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                <i class="bi bi-chevron-left"></i>
            </button>
            
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
            
            <button class="visionaries-nav next" id="visionaries-next" aria-label="Next slide">
                {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
        
        <div class="visionaries-buttons">
            <a href="#" class="btn-visionaries-primary">Learn More</a>
            <a href="#" class="btn-visionaries-outline">Browse Members</a>
        </div>
    </div>
</section>

<section class="directory-section">
    <div class="container">
        <div class="row align-items-center g-5">
            {{-- Text Side: 5 Columns --}}
            <div class="col-lg-5">
                <p class="section-label">MEMBER DIRECTORY</p>
                {{-- Ensure Title stays on one line on wider screens --}}
                <h2 class="section-title text-white" style="white-space: nowrap;">Discover Local <span>Businesses</span></h2>
                <p class="directory-description">Explore our comprehensive directory of member businesses across various industries in Valenzuela City.</p>
                <ul class="directory-features">
                    <li>
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-check-circle-fill"></i>
                        Connect with local entrepreneurs
                    </li>
                    <li>
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-check-circle-fill"></i>
                        Find business partners and suppliers
                    </li>
                    <li>
                        {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                        <i class="bi bi-check-circle-fill"></i>
                        Support local commerce
                    </li>
                </ul>
                <a href="{{ url('/membership') }}" class="btn-outline-light-custom">
                    View all members
                    {{-- REPLACED SVG WITH BOOTSTRAP ICON --}}
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            {{-- Cards Side: 7 Columns (Push to Right) --}}
            <div class="col-lg-7">
                <div class="row g-3 justify-content-end"> {{-- Justify end pushes content right --}}
                    <div class="col-md-6">
                        <div class="member-card">
                            <div class="member-logo">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="member-info">
                                <h5>1234 Company ABC</h5>
                                <span class="member-badge">Services</span>
                                <p>123 company lusemnu kakarochi providing goods to you</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="member-card">
                            <div class="member-logo">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="member-info">
                                <h5>1234 Company ABC</h5>
                                <span class="member-badge">Services</span>
                                <p>123 company lusemnu kakarochi providing goods to you</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="member-card">
                            <div class="member-logo">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="member-info">
                                <h5>1234 Company ABC</h5>
                                <span class="member-badge">Services</span>
                                <p>123 company lusemnu kakarochi providing goods to you</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="member-card">
                            <div class="member-logo">
                                <i class="bi bi-building"></i>
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
        const prevBtn = document.getElementById('visionaries-prev');
        const nextBtn = document.getElementById('visionaries-next');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                visionariesSwiper.slidePrev(600);
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                visionariesSwiper.slideNext(600);
            });
        }
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