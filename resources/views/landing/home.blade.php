@extends('layouts.app')
@section('title', 'Home - PCCI Valenzuela')
@section('content')
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
        font-size: clamp(2.5rem, 8vw, 4rem); /* Responsive Font Size */
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
        width: 100%;
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
        width: 100%;
    }
    .btn-hero-outline:hover {
        background-color: #fff;
        color: #A40033;
    }
    @media (min-width: 576px) {
        .btn-hero-primary, .btn-hero-outline { width: auto; }
    }
    .hero-link {
        color: #fff;
        font-size: 0.9rem;
        text-decoration: underline;
        opacity: 0.9;
        transition: opacity 0.3s ease;
        display: block;
        margin-top: 1rem;
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
        background-color: var(--bg-body);
        transition: background-color 0.3s ease;
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
        font-size: clamp(1.75rem, 5vw, 2.5rem);
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 1rem;
    }

    .section-title span {
        color: #EB3223;
    }

    .section-description {
        color: var(--text-secondary);
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto 3rem;
        opacity: 0.8;
    }

    .value-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
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
        border-color: #EB3223;
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
        color: #ffffff;
    }

    .value-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--text-main);
    }

    .value-description {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.6;
    }
    /* ===== AI DISCOVERY SECTION ===== */
    .ai-discovery-section {
        padding: 5rem 0;
        background-color: #252631;
    }
    body.dark-mode .ai-discovery-section {
        background-color: #1a1a20;
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
    .ai-icon-box i {
        font-size: 1.75rem;
        color: #AC1D32;
    }
    .ai-title {
        font-family: 'DM Sans', sans-serif;
        font-size: clamp(1.75rem, 5vw, 2.25rem);
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
        flex-direction: column; /* Stacks on mobile */
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    @media (min-width: 576px) {
        .search-input-group { flex-direction: row; }
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
        justify-content: center;
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
        transition: background-color 0.3s ease;
    }
    body.dark-mode .visionaries-section {
        background-color: var(--bg-section-gray);
    }
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
        font-size: clamp(1.75rem, 5vw, 2.75rem);
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
    .visionaries-carousel-wrapper {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px; /* Reduced for mobile */
    }
    @media (min-width: 768px) {
        .visionaries-carousel-wrapper { padding: 0 80px; }
    }
    .visionaries-swiper {
        padding: 40px 0 60px;
        overflow: visible !important;
    }
    .visionaries-swiper .swiper-slide {
        width: 260px !important; /* Slightly smaller for mobile */
        height: 350px !important;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    @media (min-width: 768px) {
        .visionaries-swiper .swiper-slide {
            width: 300px !important;
            height: 400px !important;
        }
    }
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
        object-position: top center;
        transition: transform 0.5s ease;
    }
    .slide-card .slide-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 16px 18px;
        background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
        color: #fff;
        border-radius: 0 0 16px 16px;
    }
    .slide-card .slide-overlay h5 {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        margin: 0 0 2px;
        color: #fff !important;
        text-transform: capitalize;
    }
    .slide-card .slide-overlay p {
        font-family: 'Poppins', sans-serif;
        font-size: 0.7rem;
        font-weight: 500;
        margin: 0;
        opacity: 0.85;
        color: #fff !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .visionaries-swiper .swiper-slide { opacity: 0.7; transform: scale(0.85); }
    .visionaries-swiper .swiper-slide-active { opacity: 1; transform: scale(1); z-index: 10; }
    .visionaries-swiper .swiper-slide-active .slide-card { box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3); }
    .visionaries-swiper .swiper-slide-prev,
    .visionaries-swiper .swiper-slide-next { opacity: 0.85; transform: scale(0.88); }
    
    .visionaries-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px; /* Smaller on mobile */
        height: 40px;
        background: transparent;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 50;
        transition: all 0.3s ease;
        padding: 0;
        color: #A40033; 
    }
    @media (min-width: 768px) {
        .visionaries-nav { width: 50px; height: 50px; }
    }
    body.dark-mode .visionaries-nav { color: var(--text-main); }
    .visionaries-nav i { font-size: 2rem; transition: transform 0.3s ease; }
    @media (min-width: 768px) { .visionaries-nav i { font-size: 2.5rem; } }
    .visionaries-nav:hover i { transform: scale(1.15); }
    .visionaries-nav.prev { left: 0px; }
    .visionaries-nav.next { right: 0px; }
    .visionaries-nav.prev:hover i { transform: translateX(-3px) scale(1.15); }
    .visionaries-nav.next:hover i { transform: translateX(3px) scale(1.15); }
    
    .visionaries-swiper .swiper-pagination { bottom: 10px; display: flex; justify-content: center; align-items: center; gap: 10px; }
    .visionaries-swiper .swiper-pagination-bullet { width: 10px; height: 10px; border-radius: 50%; background: #B8B8B8; opacity: 1; margin: 0 !important; transition: all 0.3s ease; }
    .visionaries-swiper .swiper-pagination-bullet-active { background: #A40033; transform: scale(1.2); }
    
    .visionaries-buttons { display: flex; flex-direction: column; justify-content: center; gap: 1rem; margin-top: 2rem; padding: 0 1rem;}
    @media (min-width: 576px) { .visionaries-buttons { flex-direction: row; } }
    .btn-visionaries-primary { background-color: #8B0A2D; color: #fff; padding: 0.9rem 2.25rem; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-weight: 600; font-size: 0.95rem; text-decoration: none; transition: all 0.3s ease; border: 2px solid #8B0A2D; text-align: center;}
    .btn-visionaries-primary:hover { background-color: #6d0823; border-color: #6d0823; color: #fff; }
    .btn-visionaries-outline { background-color: transparent; color: #A40033; padding: 0.9rem 2.25rem; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-weight: 600; font-size: 0.95rem; text-decoration: none; border: 2px solid #A40033; transition: all 0.3s ease; text-align: center;}
    .btn-visionaries-outline:hover { background-color: #A40033; color: #fff; }

    /* ===== MEMBER DIRECTORY SECTION ===== */
   :root {
    --dir-bg: #252631; 
    --dir-card-bg: #000000;
    --dir-accent: #e63946;
    --dir-text: #ffffff;
    }
    .directory-section { background-color: var(--dir-bg); color: var(--dir-text); padding: 100px 0; font-family: 'DM Sans', sans-serif; }
    .directory-section h1, .directory-section h2, .directory-section h3, .directory-section h4, .directory-section h5, .directory-section h6, .directory-section p, .directory-section span, .directory-section div, .directory-section li { color: #ffffff !important; }
    .text-highlight { color: var(--dir-accent) !important; }
    .section-desc { color: #ffffff !important; font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem; opacity: 0.9; }
    .feature-item { display: flex; align-items: center; gap: 15px; margin-bottom: 14px; font-size: 1.05rem; color: #ffffff !important; }
    .feature-icon { width: 24px; height: 24px; background-color: var(--dir-accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white !important; font-size: 0.8rem; }
    .btn-accent-cta { background: var(--dir-accent); color: #ffffff !important; padding: 14px 30px; border-radius: 8px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; border: 1px solid var(--dir-accent); }
    .btn-accent-cta:hover { background: transparent; border-color: #ffffff; transform: translateY(-2px); }
    .directory-card { background-color: var(--dir-card-bg); border: 1px solid #6B6B6B; border-radius: 8px; padding: 24px; height: 100%; transition: all 0.3s ease; }
    .directory-card:hover { border-color: var(--dir-accent); transform: translateY(-5px); }
    .card-logo-box { width: 50px; height: 50px; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #ffffff !important; font-weight: 800; font-size: 1.25rem; flex-shrink: 0; }
    .badge-outline-white { background: transparent; border: 1px solid rgba(255,255,255, 0.4); color: #ffffff !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; padding: 4px 8px; border-radius: 4px; }
    .card-desc { color: #ffffff !important; font-size: 0.9rem; line-height: 1.5; margin-bottom: 0; opacity: 0.8; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

    /* ===== EVENTS SECTION ===== */
    .events-section {
        padding: 5rem 0;
        background-color: #faf8f5;
        transition: background-color 0.3s ease;
    }
    body.dark-mode .events-section {
        background-color: var(--bg-section-gray);
    }
    body.dark-mode .events-section .section-label,
    body.dark-mode .events-section .section-title,
    body.dark-mode .events-section .section-description {
        color: var(--text-main) !important;
    }
    body.dark-mode .events-section .section-title span {
        color: #EB3223 !important;
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
    .event-date-badge .day-name { font-size: 0.65rem; font-weight: 500; text-transform: uppercase; opacity: 0.9; display: block; }
    .event-date-badge .day-number { font-size: 1.5rem; font-weight: 700; line-height: 1; display: block; }
    .event-date-badge .month { font-size: 0.65rem; font-weight: 500; text-transform: uppercase; opacity: 0.9; display: block; }
    .event-card-body { padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1; text-align: left; }
    .event-location { display: flex; align-items: center; gap: 0.5rem; color: #6b7280; font-size: 0.85rem; margin-bottom: 0.5rem; font-weight: 500; }
    body.dark-mode .event-location { color: var(--text-secondary); }
    .event-location i { font-size: 1rem; color: #A40033; }
    .event-card-title { font-family: 'DM Sans', sans-serif; font-size: 1.15rem; font-weight: 700; color: #111827; margin-bottom: 1rem; line-height: 1.4; min-height: 3.5rem; }
    body.dark-mode .event-card-title { color: var(--text-main); }
    .btn-event-details { display: inline-flex; align-items: center; justify-content: center; width: 100%; background: white; color: #A40033; padding: 0.75rem; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-weight: 600; text-decoration: none; transition: all 0.3s ease; border: 1px solid #A40033; margin-top: auto; }
    body.dark-mode .btn-event-details { background: transparent; color: #A40033; }
    .btn-event-details:hover { background: #A40033; color: #fff; }
    .btn-view-all-events { display: inline-flex; align-items: center; gap: 0.5rem; background: transparent; color: #A40033; padding: 0.75rem 2rem; border-radius: 30px; font-family: 'DM Sans', sans-serif; font-weight: 600; text-decoration: none; transition: all 0.3s ease; margin-top: 3rem; border: 2px solid #A40033; }
    .btn-view-all-events:hover { background: #A40033; color: #fff; }
    
  /* ===== TESTIMONIALS SECTION ===== */
    .testimonials-section { padding: 5rem 0; background-color: #252631; transition: background-color 0.3s ease; }
    body.dark-mode .testimonials-section { background-color: var(--bg-body); }
    .testimonial-card { background: #252631; border-radius: 16px; padding: 2.5rem 2rem; height: 100%; border: 1px solid #f3f4f6; transition: all 0.3s ease; position: relative; display: flex; flex-direction: column; align-items: center; text-align: center; box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1); }
    body.dark-mode .testimonial-card { background: var(--bg-card); border-color: var(--border-color); }
    .testimonial-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); border-color: #A40033; }
    .testimonial-quote-icon { width: 40px; height: 40px; background: #A40033; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(164, 0, 51, 0.3); }
    .testimonial-quote-icon i { font-size: 1.25rem; color: #fff; }
    .testimonial-avatar { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
    .testimonial-text { font-family: 'Poppins', sans-serif; font-size: 0.95rem; line-height: 1.8; color: #9e9e9e; font-style: italic; margin-bottom: 1.5rem; flex-grow: 1; }
    .testimonial-author h5 { font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 1.1rem; color: #bcbcbc; margin-bottom: 0.2rem; }
    .testimonial-author span { font-size: 0.85rem; color: #A40033; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    
    .member-card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; border: 1px solid #D40032 !important; }
    
    /* ===== AFFILIATED PARTNERS SECTION ===== */
    .partners-section { padding: 5rem 0; background-color: #faf8f5; }
    body.dark-mode .partners-section { background-color: var(--bg-section-gray); }
    .partner-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 4px; height: 100px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    body.dark-mode .partner-card { background: var(--bg-card); border-color: var(--border-color); }
    .partner-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
    .partner-logo { max-width: 80%; max-height: 60px; font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 1.5rem; color: #333; display: flex; align-items: center; gap: 5px; }
    .partner-logo span { color: #A40033; font-style: italic; }
    .sponsor-card { background-color: #EB3223; color: #fff; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; text-decoration: none; height: 100px; border-radius: 4px; transition: background-color 0.3s ease; }
    .sponsor-card:hover { background-color: #c91e10; color: #fff; }
    .sponsor-text { font-family: 'DM Sans', sans-serif; font-weight: 700; line-height: 1.2; font-size: 1.1rem; }

    /* ===== MAP & MEMBER DISCOVERY SECTION ===== */
    .map-section { background-color: #252631; color: #fff; padding: 5rem 0; }
    .map-header { text-align: center; margin-bottom: 3rem; }
    .map-container-box { display: flex; flex-direction: column; background: #111111; border: 1px solid #333; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
    .map-sidebar { width: 100%; background: #1B1C24; padding: 2rem; display: flex; flex-direction: column; border-bottom: 1px solid #333; }
    .map-sidebar-title { font-family: 'DM Sans', sans-serif; font-size: 1.2rem; font-weight: 700; color: #fff; margin-bottom: 1.5rem; letter-spacing: 0.5px; text-transform: uppercase; }
    .map-search-wrapper { position: relative; margin-bottom: 1rem; }
    .map-search-input { width: 100%; background: #fff; border: 1px solid #ccc; border-radius: 4px; padding: 0.75rem 1rem 0.75rem 2.5rem; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; color: #333; }
    .map-search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #666; font-size: 1rem; }
    .filter-label { font-size: 0.75rem; color: #888; margin-bottom: 0.25rem; display: block; }
    .map-filter-select { width: 100%; background: #fff; border: 1px solid #ccc; border-radius: 4px; padding: 0.75rem 1rem; margin-bottom: 2rem; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; color: #333; appearance: none; background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1em; }
    .member-list-scroll { flex: 1; overflow-y: auto; padding-right: 5px; min-height: 300px; max-height: 500px; }
    .member-list-scroll::-webkit-scrollbar { width: 4px; }
    .member-list-scroll::-webkit-scrollbar-track { background: #1A1A1A; }
    .member-list-scroll::-webkit-scrollbar-thumb { background: #444; border-radius: 2px; }
    .map-member-card { display: flex; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid #333; cursor: pointer; transition: background-color 0.2s; }
    .map-member-card:hover { background-color: rgba(255,255,255,0.05); }
    .map-member-card:last-child { border-bottom: none; }
    .member-logo-box { width: 50px; height: 50px; background-color: #A40033; color: #fff; display: flex; align-items: center; justify-content: center; border-radius: 4px; font-weight: 700; font-size: 1.2rem; flex-shrink: 0; font-family: 'Times New Roman', serif; }
    .member-info-box { flex: 1; }
    .member-badge { display: inline-block; background-color: #FFD6D6; color: #A40033; font-size: 0.65rem; font-weight: 800; padding: 2px 6px; border-radius: 4px; text-transform: uppercase; margin-bottom: 0.35rem; letter-spacing: 0.5px; }
    .member-name { color: #fff; font-size: 0.95rem; font-weight: 700; margin-bottom: 0.2rem; line-height: 1.2; }
    .member-desc { color: #888; font-size: 0.8rem; margin: 0; }
    .map-view-area { width: 100%; min-height: 350px; height: 400px; position: relative; background-color: #333; }
    .map-view-area iframe { width: 100%; height: 100%; border: 0; display: block; }
    @media (min-width: 992px) {
        .map-container-box { flex-direction: row; height: 600px; }
        .map-sidebar { width: 380px; border-right: 1px solid #333; border-bottom: none; flex-shrink: 0; padding: 2.5rem; }
        .map-view-area { height: 100%; min-height: 0; flex: 1; }
        .member-list-scroll { max-height: none; }
    }

   /* --- BACKGROUND VIDEO SECTION --- */
    .video-section { position: relative; padding: 8rem 0; overflow: hidden; display: flex; align-items: center; justify-content: center; color: #fff; }
    .video-bg { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; }
    .video-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 1; }
    .video-content { position: relative; z-index: 2; text-align: center; max-width: 800px; padding: 0 20px; }
    .btn-video-cta { position: relative; display: inline-block; padding: 12px 30px; font-size: 16px; font-weight: 600; color: #fff; background-color: #AC1D32; text-decoration: none; overflow: hidden; transition: color 0.4s ease; border-radius: 8px;}
    .btn-video-cta::before { content: ""; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: #fff; transition: left 0.4s ease; z-index: 0; }
    .btn-video-cta:hover::before { left: 0; }
    .btn-video-cta span { position: relative; z-index: 1; }
    .btn-video-cta:hover { color: #AC1D32; }

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
        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mb-3">
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
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="value-title">Discipline</h3>
                    <p class="value-description">Fostering a community that values quality, aesthetics, and thoughtful experiences.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h3 class="value-title">Good Taste</h3>
                    <p class="value-description">Fostering a community that values quality, aesthetics, and thoughtful experiences.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="value-card">
                    <div class="value-icon">
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
        <div class="row align-items-center g-4 g-lg-5 text-center text-lg-start">
            <div class="col-lg-5">
                <div class="ai-icon-box mx-auto mx-lg-0">
                    <i class="bi bi-cpu-fill"></i>
                </div>
                <h2 class="ai-title">AI-<span>Powered</span><br>Member Discovery</h2>
                <p class="ai-description">Describe your needs in detail, and our intelligent assistant will carefully assess your requirements to connect you with the most suitable PCCI Valenzuela members who can provide the right products, services, or expertise.</p>
            </div>
            <div class="col-lg-7">
                <div class="search-card text-start">
                    <div class="search-label">
                        <i class="bi bi-search"></i>
                        <span>What are you looking for?</span>
                    </div>
                    <div class="search-input-group">
                        <input type="text" placeholder="e.g., 'Architect for new office'">
                        <button class="btn-search">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                    <div class="search-suggestions">
                        <span>Suggestions:</span>
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
        <div class="visionaries-carousel-wrapper">
            <div class="swiper visionaries-swiper">
                <div class="swiper-wrapper" id="visionariesWrapper">
                    {{-- Dynamically populated from API --}}
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

<section class="directory-section">
    <div class="container">
        <div class="row align-items-center text-center text-lg-start">
            {{-- LEFT COLUMN --}}
            <div class="col-lg-5 mb-5 mb-lg-0">
                <span class="section-label" style="color: #ffffff !important;">Member Directory</span>
                <h2 class="section-title">
                    Discover Local <span class="text-highlight">Businesses</span>
                </h2>
                <p class="section-desc mx-auto mx-lg-0">
                    Explore our comprehensive directory of member businesses across various industries in Valenzuela City.
                </p>
                <ul class="feature-list list-unstyled d-inline-block text-start mb-4">
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
                <div class="w-100 text-center text-lg-start">
                    <a href="{{ url('/membership') }}" class="btn-accent-cta">
                        View all members <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="col-lg-7">
                <div class="row g-4" id="directoryCards">
                    <div class="col-12 text-center" style="padding: 40px 0;">
                        <i class="bi bi-arrow-repeat" style="font-size: 2rem; color: rgba(255,255,255,0.3);"></i>
                        <p style="color: rgba(255,255,255,0.5); margin-top: 10px;">Loading members...</p>
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
        <div class="row g-4 justify-content-center" id="homeEventsGrid">
            {{-- Loading placeholder --}}
            @for ($i = 0; $i < 3; $i++)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="event-card">
                    <div class="event-card-image-wrapper d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg,#c0392b,#7d1a1a);">
                        <div class="spinner-border text-white" role="status"><span class="visually-hidden">Loading...</span></div>
                    </div>
                    <div class="event-card-body">
                        <div class="event-location"><i class="bi bi-geo-alt-fill"></i> Loading...</div>
                        <h3 class="event-card-title placeholder-glow"><span class="placeholder col-8"></span></h3>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center">
            <a href="{{ route('event') }}" class="btn-view-all-events">
                View All Events <i class="bi bi-arrow-right"></i>
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
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-quote-icon"><i class="bi bi-quote"></i></div>
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                    <p class="testimonial-text">"PCCI Valenzuela has been instrumental in connecting us with key partners. The networking events are top-notch and always well-organized."</p>
                    <div class="testimonial-author">
                        <h5>Maria Santos</h5><span>CEO, Santos Trading</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-quote-icon"><i class="bi bi-quote"></i></div>
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                    <p class="testimonial-text">"The advocacy programs have really helped our industry voice concerns to the local government. Highly recommended for any business owner."</p>
                    <div class="testimonial-author">
                        <h5>Juan Dela Cruz</h5><span>Founder, TechSolutions</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="testimonial-card">
                    <div class="testimonial-quote-icon"><i class="bi bi-quote"></i></div>
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop" alt="Member" class="testimonial-avatar">
                    <p class="testimonial-text">"Joining PCCI was the best decision for my startup. The mentorship and support from fellow members are invaluable."</p>
                    <div class="testimonial-author">
                        <h5>Ana Reyes</h5><span>Director, Reyes Logistics</span>
                    </div>
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
        <div class="row g-3 justify-content-center mx-auto" style="max-width: 1000px;">
            <div class="col-6 col-md-4 col-lg-3"><div class="partner-card"><div class="partner-logo"><span>n</span>Vision</div></div></div>
            <div class="col-6 col-md-4 col-lg-3"><div class="partner-card"><div class="partner-logo"><span>n</span>Vision</div></div></div>
            <div class="col-6 col-md-4 col-lg-3"><div class="partner-card"><div class="partner-logo"><span>n</span>Vision</div></div></div>
            <div class="col-6 col-md-4 col-lg-3"><div class="partner-card"><div class="partner-logo"><span>n</span>Vision</div></div></div>
            <div class="col-6 col-md-4 col-lg-3"><div class="partner-card"><div class="partner-logo"><span>n</span>Vision</div></div></div>
            <div class="col-6 col-md-4 col-lg-3"><div class="partner-card"><div class="partner-logo"><span>n</span>Vision</div></div></div>
            <div class="col-6 col-md-4 col-lg-3"><div class="partner-card"><div class="partner-logo"><span>n</span>Vision</div></div></div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('contact') }}" class="sponsor-card">
                    <span class="sponsor-text">Become<br>a Sponsor</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="container">
        <div class="map-header">
            <p class="section-label" style="color: #fff; letter-spacing: 2px; font-size: 0.8rem; margin-bottom: 10px;">OUR NETWORK</p>
            <h2 class="section-title" style="color: white; font-size: clamp(1.75rem, 5vw, 2.5rem);">Discover <span style="color: #EB3223;">Our Members</span> Around the City</h2>
            <p class="section-description" style="color: #aaa; margin-top: 10px;">Discover the locations of our diverse member businesses through the interactive map below.</p>
        </div>

        <div class="row g-0 map-container-box">
            <div class="col-12 col-lg-4 map-sidebar">
                <div class="map-sidebar-title">OUR MEMBERS</div>

                <div class="map-search-wrapper">
                    <i class="bi bi-search map-search-icon"></i>
                    <input type="text" class="map-search-input" id="mapSearchInput" placeholder="Search members...">
                </div>

                <div>
                    <span class="filter-label">Filter by Industry</span>
                    <select class="map-filter-select" id="mapIndustryFilter">
                        <option value="">Select Industry</option>
                    </select>
                </div>

                <div class="member-list-scroll" id="mapMemberList">
                    <div class="text-center py-4">
                        <div class="spinner-border spinner-border-sm text-light" role="status"></div>
                        <p class="member-desc mt-2">Loading members...</p>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-8 map-view-area">
                <iframe
                    id="mapIframe"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30880.945786399286!2d120.95583565!3d14.6942407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b3e0c1fc1c4d%3A0x5e3459f1b4e8d7a0!2sValenzuela%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1710700000000!5m2!1sen!2sph"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<section class="py-5 network-section" style="background-color: #F7F5F0; transition: background-color 0.3s ease;">
    <style>
        body.dark-mode .network-section { background-color: var(--bg-section-gray) !important; }
        body.dark-mode .network-section .network-title { color: var(--text-main) !important; }
        body.dark-mode .network-section .network-desc { color: var(--text-secondary) !important; }
    </style>
    <div class="container px-4 px-lg-5">

        <div class="text-center mb-5">
            <h6 class="fw-bold text-uppercase mb-2" style="color: #D40032; letter-spacing: 0.05em; font-size: 0.85rem;">
                Our Network
            </h6>
            <h2 class="section-title network-title mb-3" style="color: #1a1a1a; font-family: 'DM Sans', sans-serif; font-weight: 800; font-size: clamp(2rem, 5vw, 2.5rem);">
                Why Join PCCI <span style="color: #D40032;">Valenzuela</span>
            </h2>
            <p class="section-description network-desc mx-auto" style="max-width: 700px; color: #6c757d; font-size: 1.1rem; font-weight: 500;">
                Explore our growing network of member businesses across various industries in Valenzuela City.
            </p>
        </div>

        <div class="row g-4" id="networkCards">
            <div class="col-12 text-center py-4">
                <i class="bi bi-arrow-repeat" style="font-size: 2rem; color: #ccc;"></i>
                <p style="color: #999; margin-top: 10px;">Loading businesses...</p>
            </div>
        </div>

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
        <h2 class="section-title" style="color: #fff; font-size: clamp(1.75rem, 5vw, 3rem); margin-bottom: 1.5rem;">
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
{{-- JS Script for Map, Visionaries, and Business population --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hero Slider
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-dot');
    let currentSlide = 0;
    function showSlide(index) {
        heroSlides.forEach((slide, i) => { slide.classList.toggle('active', i === index); });
        heroDots.forEach((dot, i) => { dot.classList.toggle('active', i === index); });
        currentSlide = index;
    }
    heroDots.forEach((dot, index) => { dot.addEventListener('click', () => showSlide(index)); });
    setInterval(() => { showSlide((currentSlide + 1) % heroSlides.length); }, 5000);

    // Map Search Functionality Support
    window.navigateMap = function(card) {
        const query = card.getAttribute('data-map-query');
        if (!query) return;
        document.querySelectorAll('.map-member-card').forEach(c => c.style.backgroundColor = '');
        card.style.backgroundColor = 'rgba(164, 0, 51, 0.15)';
        const iframe = document.getElementById('mapIframe');
        const encoded = encodeURIComponent(query);
        iframe.src = `https://maps.google.com/maps?q=$${encoded}&t=&z=16&ie=UTF8&iwloc=&output=embed`;
    };

    // Populate Events 
    (function() {
        async function loadHomeEvents() {
            const grid = document.getElementById('homeEventsGrid');
            try {
                const response = await fetch(`${window.API_BASE_URL}/v1/events`, { headers: { 'Accept': 'application/json' }});
                const data = await response.json();
                const events = (data.data ? data.data : (Array.isArray(data) ? data : [])).slice(0, 3);

                if (!events.length) { grid.innerHTML = '<p class="text-center w-100 text-muted">No events available.</p>'; return; }

                const apiOrigin = window.API_BASE_URL.replace(/\/api\/?$/, '');
                const dayNames = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                const monthNames = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                grid.innerHTML = events.map(ev => {
                    let dayName = '', dayNum = '', month = '';
                    if (ev.date) {
                        const d = new Date(ev.date + 'T00:00:00');
                        dayName = dayNames[d.getDay()]; dayNum = String(d.getDate()).padStart(2, '0'); month = monthNames[d.getMonth()];
                    }
                    return `
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="event-card" data-event-home-id="${ev.id}">
                            <div class="event-card-image-wrapper" style="background: linear-gradient(135deg,#c0392b,#7d1a1a);">
                                ${ev.date ? `<div class="event-date-badge"><span class="day-name">${dayName}</span><span class="day-number">${dayNum}</span><span class="month">${month}</span></div>` : ''}
                            </div>
                            <div class="event-card-body">
                                <div class="event-location"><i class="bi bi-geo-alt-fill"></i> ${ev.location || 'TBA'}</div>
                                <h3 class="event-card-title">${ev.title || 'Untitled Event'}</h3>
                                <a href="{{ route('event') }}" class="btn-event-details">View Details</a>
                            </div>
                        </div>
                    </div>`;
                }).join('');

                events.forEach(ev => {
                    const rawImg = ev.imagel || ev.image || null;
                    if (!rawImg) return;
                    const imgSrc = (rawImg.startsWith('http') || rawImg.startsWith('data:')) ? rawImg : apiOrigin + '/storage/' + rawImg;
                    const wrapper = grid.querySelector(`.event-card[data-event-home-id="${ev.id}"] .event-card-image-wrapper`);
                    if (wrapper) wrapper.innerHTML += `<img src="${imgSrc}" alt="${ev.title || 'Event'}" onerror="this.style.display='none'">`;
                });
            } catch (err) { grid.innerHTML = '<p class="text-center w-100 text-danger">Failed to load events.</p>'; }
        }
        loadHomeEvents();
    })();

    // Visionaries
    (function() {
        const wrapper = document.getElementById('visionariesWrapper');
        fetch(window.API_BASE_URL + '/v1/trustees').then(res => res.json()).then(data => {
            const trustees = Array.isArray(data) ? data : (data.data || []);
            trustees.sort((a, b) => Number(a.board_position_id || (a.position && a.position.id) || 999) - Number(b.board_position_id || (b.position && b.position.id) || 999));
            trustees.forEach(t => {
                const fullName = `${t.gender?.toLowerCase()==='female'?'Ms.':'Mr.'} ${t.firstname||''}${t.middlename?' '+t.middlename:''} ${t.lastname||''}`.trim();
                const posName = t.position?.position || 'Trustee';
                const imgUrl = t.image_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(t.firstname+' '+t.lastname)}&background=252631&color=fff&bold=true&size=600`;
                wrapper.innerHTML += `<div class="swiper-slide"><div class="slide-card" style="position:relative;"><img src="${imgUrl}" alt="${fullName}"><div class="slide-overlay"><h5>${fullName}</h5><p>${posName}</p></div></div></div>`;
            });
            if(trustees.length) {
                new Swiper('.visionaries-swiper', { effect:'coverflow', grabCursor:true, centeredSlides:true, slidesPerView:'auto', loop:trustees.length>2, navigation:{nextEl:'#visionaries-next',prevEl:'#visionaries-prev'}, coverflowEffect:{rotate:0,stretch:80,depth:200,modifier:1,slideShadows:false}, pagination:{el:'.visionaries-swiper .swiper-pagination',clickable:true}, autoplay:{delay:5000,disableOnInteraction:false}, breakpoints:{320:{coverflowEffect:{stretch:40,depth:100}},768:{coverflowEffect:{stretch:60,depth:150}},1024:{coverflowEffect:{stretch:80,depth:200}}} });
            }
        });
    })();

    // Directory businesses
    (function() {
        const container = document.getElementById('directoryCards');
        const hexColors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'];
        fetch(window.API_BASE_URL + '/v1/business').then(res => res.json()).then(data => {
            const businesses = Array.isArray(data) ? data : (data.data || []);
            businesses.sort((a, b) => new Date(b.created_at || 0) - new Date(a.created_at || 0));
            container.innerHTML = businesses.slice(0, 4).length === 0 ? '<div class="col-12 text-center text-muted">No businesses available.</div>' : businesses.slice(0, 4).map((biz, i) => {
                const name = biz.registered_business_name || 'Unknown Business';
                const words = name.split(' ');
                const initials = words.length > 1 && words[1].length > 0 ? (words[0][0] + words[1][0]).toUpperCase() : name.substring(0, 2).toUpperCase();
                const avatar = biz.photo_url && !biz.photo_url.includes('N/A') && !biz.photo_url.includes('null') ? `<img src="${biz.photo_url}" class="rounded-circle w-100 h-100" style="object-fit: cover;">` : initials;
                return `<div class="col-12 col-md-6"><a href="/business/${biz.id || '#'}" class="text-decoration-none"><div class="directory-card"><div class="d-flex align-items-center mb-3"><div class="card-logo-box shadow-sm" style="background-color:${hexColors[i%hexColors.length]}">${avatar}</div><div class="ms-3 overflow-hidden"><h5 class="text-truncate text-white mb-1">${name}</h5><span class="badge-outline-white">${biz.industry||'Business'}</span></div></div><p class="card-desc text-muted small">${biz.business_tagline ? '"'+biz.business_tagline+'"' : 'Providing excellence in Valenzuela City.'}</p></div></a></div>`;
            }).join('');
        });
    })();

    // Map logic & Network cards (Combined loading logic)
    (function() {
        const networkGrid = document.getElementById('networkCards');
        const list = document.getElementById('mapMemberList');
        const filterSelect = document.getElementById('mapIndustryFilter');
        const searchInput = document.getElementById('mapSearchInput');
        const cardColors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info', 'bg-danger', 'bg-secondary'];
        
        let allMapMembers = [];

        fetch(window.API_BASE_URL + '/v1/business').then(res => res.json()).then(data => {
            allMapMembers = Array.isArray(data) ? data : (data.data || []);
            
            // 1. Populate Network Cards
            const sortedNet = [...allMapMembers].map((b,i)=>{b._idx=i;return b;}).sort((a,b)=>new Date(b.created_at||0)-new Date(a.created_at||0));
            networkGrid.innerHTML = sortedNet.slice(0, 6).length === 0 ? '<div class="col-12 text-center text-muted">No businesses available.</div>' : sortedNet.slice(0, 6).map((biz, i) => {
                const name = biz.registered_business_name || 'Unknown Business';
                const colorClass = cardColors[i % cardColors.length];
                const textClass = (colorClass === 'bg-warning' || colorClass === 'bg-info') ? 'text-dark' : 'text-white';
                const words = name.split(' ');
                const initials = words.length > 1 && words[1].length > 0 ? (words[0][0] + words[1][0]).toUpperCase() : name.substring(0, 2).toUpperCase();
                const avatar = biz.photo_url && !biz.photo_url.includes('N/A') && !biz.photo_url.includes('null') ? `<img src="${biz.photo_url}" class="rounded-circle" style="width:56px;height:56px;object-fit:cover;">` : `<div class="rounded-circle ${colorClass} d-flex align-items-center justify-content-center ${textClass} fw-bold" style="width:56px;height:56px;font-size:1.2rem;">${initials}</div>`;
                const tags = Array.isArray(biz.tags) ? biz.tags.map(t=>`<span class="px-2 py-1 rounded text-white" style="background-color:rgba(255,255,255,0.1);font-weight:600;">${t}</span>`).join('') : '';
                return `<div class="col-12 col-md-6 col-lg-4"><a href="/business/${biz._idx}" class="card h-100 border-0 shadow p-3 text-decoration-none member-card-hover" style="border-radius:12px;background-color:#242530;"><div class="d-flex align-items-center gap-3 mb-3">${avatar}<div style="overflow:hidden;"><span class="d-inline-block rounded px-2 py-1 mb-1 fw-bold text-uppercase text-white" style="font-size:0.65rem;background-color:rgba(255,255,255,0.15);">${biz.industry||'Business'}</span><h5 class="fw-bold mb-0 text-white text-truncate">${name}</h5>${biz.business_tagline&&biz.business_tagline!=='N/A'?`<small class="text-white d-block text-truncate" style="opacity:0.8;font-style:italic;">"${biz.business_tagline}"</small>`:''}</div></div><div class="card-body p-0 d-flex flex-column flex-grow-1">${tags?`<div class="mb-3"><div class="d-flex gap-2 small flex-wrap">${tags}</div></div>`:''}<div class="mt-auto pt-3 border-top" style="border-color:rgba(255,255,255,0.1)!important;"><div class="small text-white mb-2" style="opacity:0.9;overflow:hidden;">${biz.email?`<div class="text-truncate"><i class="bi bi-envelope"></i> ${biz.email}</div>`:''}${biz.telephone_no?`<div class="text-truncate"><i class="bi bi-telephone"></i> ${biz.telephone_no}</div>`:''}</div><div class="d-flex justify-content-end"><span class="btn py-1 px-3 text-white fw-bold" style="background-color:#D40032;border-radius:6px;font-size:0.8rem;">View Details</span></div></div></div></a></div>`;
            }).join('');

            // 2. Populate Map Options
            [...new Set(allMapMembers.map(b => b.industry).filter(Boolean))].sort().forEach(ind => {
                filterSelect.innerHTML += `<option value="${ind}">${ind}</option>`;
            });

            // 3. Render Map List
            function renderMap() {
                const search = (searchInput.value || '').toLowerCase();
                const industry = filterSelect.value;
                const filtered = allMapMembers.filter(b => {
                    const matchS = !search || (b.registered_business_name||'').toLowerCase().includes(search) || (b.business_tagline||'').toLowerCase().includes(search);
                    const matchI = !industry || b.industry === industry;
                    return matchS && matchI;
                });
                list.innerHTML = filtered.length === 0 ? '<p class="member-desc text-center py-3">No members found.</p>' : filtered.map((biz, idx) => {
                    const name = biz.registered_business_name || 'Unknown Business';
                    const initials = name.substring(0,2).toUpperCase();
                    let mapQuery = name + ', Valenzuela City';
                    if (biz.business_location) {
                        const loc = biz.business_location;
                        mapQuery = (loc.location_link && loc.location_link !== 'N/A') ? loc.location_link : [loc.business_address, loc.city_municipality, loc.province].filter(p=>p&&p!=='N/A').join(', ');
                    }
                    return `<div class="map-member-card" data-map-query="${mapQuery.replace(/"/g, '"')}" onclick="navigateMap(this)"><div class="member-logo-box">${initials}</div><div class="member-info-box"><span class="member-badge">${biz.industry||'BUSINESS'}</span><div class="member-name">${name}</div><p class="member-desc">${biz.business_tagline||''}</p></div></div>`;
                }).join('');
            }
            renderMap();
            searchInput.addEventListener('input', renderMap);
            filterSelect.addEventListener('change', renderMap);
        });
    })();
});
</script>
@endsection