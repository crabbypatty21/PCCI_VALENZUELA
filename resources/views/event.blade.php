@extends('layouts.app')

@section('title', 'Events - PCCI Valenzuela')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>
    :root {
        --pcci-red: #A40033;
        --pcci-dark: #212529;
        --pcci-gray: #6c757d;
        --card-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    body {
        font-family: 'DM Sans', sans-serif;
        background-color: #ffffff;
    }

    /* --- Existing Hero & Layout Styles --- */
    .events-hero {
        background: linear-gradient(rgba(26, 26, 46, 0.9), rgba(26, 26, 46, 0.9));
        background-size: cover;
        background-position: center;
        padding: 150px 0;
        color: white;
        text-align: center;
    }

    .events-hero h6 { text-transform: uppercase; letter-spacing: 2px; font-weight: 600; font-size: 0.9rem; }
    .events-hero h1 { font-family: 'Poppins', sans-serif; font-size: 4rem; font-weight: 800; margin: 10px 0; }
    .events-hero p { max-width: 700px; margin: 0 auto; font-size: 1.1rem; line-height: 1.6; opacity: 0.9; }

    .filter-section { padding: 40px 0; }
    .search-input { border-radius: 5px; border: 1px solid #ddd; padding: 10px 15px 10px 40px; }
    .filter-select { border-radius: 5px; border: 1px solid #ddd; padding: 10px; color: #666; }

    /* --- Card Styles --- */
    .event-card {
        border: 1px solid #eee;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        height: 100%;
    }
    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(236, 119, 119, 0.15);
        border-color: transparent; 
    }
    .event-img-container { position: relative; overflow: hidden; height: 220px; }
    .event-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .event-card:hover .event-img { transform: scale(1.05); }
    
    .status-badge {
        position: absolute; top: 15px; right: 15px; background: white; color: black;
        font-weight: 700; padding: 5px 12px; border-radius: 6px; font-size: 0.75rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .category-badge {
        display: inline-block; background: #f8f9fa; color: #666; padding: 4px 15px;
        border-radius: 20px; font-size: 0.8rem; margin-bottom: 15px; font-weight: 600;
    }

    .event-body { padding: 25px; }
    .event-card-title { font-weight: 700; font-size: 1.2rem; margin-bottom: 20px; line-height: 1.4; color: #333; }
    .meta-row { display: flex; align-items: center; margin-bottom: 10px; font-size: 0.9rem; color: #555; }
    .event-excerpt { font-size: 0.9rem; line-height: 1.6; margin-bottom: 25px; }

    .btn-view-details {
        display: block; width: 100%; text-align: center; border: 1px solid #A40033;
        color: #A40033; padding: 10px; border-radius: 8px; text-decoration: none;
        font-weight: 600; transition: all 0.3s ease; cursor: pointer;
    }
    .btn-view-details:hover { background-color: #A40033; color: white; }

    /* --- MODAL STYLES --- */
    
    /* 1. Modal Content */
    .modal-content {
        background-color: #ffffff; 
        position: relative;
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    .modal-lg { max-width: 900px; } 
    
    .modal-header { border-bottom: none; padding-bottom: 0; padding: 30px 30px 10px 30px; }
    .modal-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 700; color: #000; }
    
    .modal-body { padding: 0px 30px 30px 30px; }

    /* 2. Absolute Close Button (Top Right) */
    .btn-close-absolute {
        position: absolute;
        top: 25px;
        right: 25px;
        z-index: 1056; 
        background-color: #f8f9fa; 
        padding: 10px;
        border-radius: 50%; /* Added rounded shape */
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .modal-event-img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .modal-description-container {
        max-height: 380px; 
        overflow-y: auto;
        padding-right: 15px;
        text-align: justify;
        color: #444;
        font-size: 0.85rem;
        line-height: 1.8;
    }

    /* Scrollbar */
    .modal-description-container::-webkit-scrollbar { width: 5px; }
    .modal-description-container::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .modal-description-container::-webkit-scrollbar-thumb { background: var(--pcci-red); border-radius: 10px; }
    .modal-description-container::-webkit-scrollbar-thumb:hover { background: #800020; }

    .modal-meta-row { display: flex; align-items: flex-start; margin-bottom: 12px; font-size: 0.95rem; color: #333; }
    .modal-meta-icon { width: 25px; color: #212529; font-size: 1.1rem; }

    /* --- NEW: BLURRED BACKDROP --- */
    .modal-backdrop.show {
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px); /* Safari support */
        opacity: 0.7 !important; /* Adjust darkness of the overlay */
    }
</style>

<section class="events-hero">
    <div class="container">
        <h6>Join PCCI - Valenzuela</h6>
        <h1>Events</h1>
        <p>Join our community events designed to foster networking, learning, and business growth opportunities for all chamber members</p>
    </div>
</section>

<div class="container filter-section">
    <div class="row align-items-center">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="position-relative">
                <i class="fas fa-search position-absolute text-muted" style="left: 15px; top: 15px;"></i>
                <input type="text" class="form-control search-input" placeholder="Search events, locations, or keywords...">
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <select class="form-select filter-select"><option selected>All Categories</option></select>
        </div>
        <div class="col-md-2 mb-3 mb-md-0">
            <select class="form-select filter-select"><option selected>All Events</option></select>
        </div>
        <div class="col-md-3 text-md-end text-muted">Showing 6 of 23 events</div>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        @for ($i = 0; $i < 6; $i++)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="event-card">
                <div class="event-img-container">
                    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2069" class="event-img" alt="Event Image">
                    <span class="status-badge">Completed</span>
                </div>
                <div class="event-body">
                    <span class="category-badge">General</span>
                    <h3 class="event-card-title">A Purposeful Message to Business Owners</h3>
                    
                    <div class="meta-row"><i class="far fa-calendar-alt text-muted"></i><span class="ms-2">Tuesday, December 9, 2025</span></div>
                    <div class="meta-row"><i class="far fa-clock text-muted"></i><span class="ms-2">9:00 AM</span></div>
                    <div class="meta-row"><i class="fas fa-map-marker-alt text-muted"></i><span class="ms-2">Valenzuela City</span></div>

                    <p class="event-excerpt text-muted mt-3">
                        A PURPOSEFUL MESSAGE TO BUSINESS OWNERS, from outgoing president, Jundio Salvador: "The past four years of being entrusted with the privilege to serve...
                    </p>

                    <button type="button" class="btn-view-details" data-bs-toggle="modal" data-bs-target="#eventModal">
                        View Details
                    </button>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <div class="row mt-4">
        <div class="col-12 text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#" style="background-color: var(--pcci-red); border-color: var(--pcci-red);">1</a></li>
                    <li class="page-item"><a class="page-link" href="#" style="color: var(--pcci-red);">2</a></li>
                    <li class="page-item"><a class="page-link" href="#" style="color: var(--pcci-red);">3</a></li>
                    <li class="page-item"><a class="page-link" href="#" style="color: var(--pcci-red);">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            
            <button type="button" class="btn-close btn-close-absolute" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <span class="category-badge mt-2">General</span>
                </div>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 mb-4 mb-md-0">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2069" class="modal-event-img" alt="Event Detail">
                    </div>

                    <div class="col-md-7">
                        <div class="mb-4">
                            <div class="modal-meta-row">
                                <i class="fas fa-calendar-alt modal-meta-icon"></i>
                                <strong>Tuesday, December 9, 2025</strong>
                            </div>
                            <div class="modal-meta-row">
                                <i class="fas fa-clock modal-meta-icon"></i>
                                <strong>9:00 AM</strong>
                            </div>
                            <div class="modal-meta-row">
                                <i class="fas fa-map-marker-alt modal-meta-icon"></i>
                                <strong>Valenzuela City</strong>
                            </div>
                        </div>

                        <div class="modal-description-container">
                            <p>A PURPOSEFUL MESSAGE TO BUSINESS OWNERS, from outgoing president, Jundio Salvador: "The past four years of being entrusted with the privilege to serve the business community of Valenzuela have been nothing short of inspiring. We have faced challenges, embraced innovation, and built bridges that will last a lifetime.</p>
                            
                            <p>This event marks a significant milestone in our journey towards a more digital and sustainable future. We invite all members to join us as we reflect on our achievements and look forward to the opportunities that lie ahead.</p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                            
                            <p>Repeating text to demonstrate scrolling: The past four years of being entrusted with the privilege to serve the business community of Valenzuela have been nothing short of inspiring. We have faced challenges, embraced innovation, and built bridges that will last a lifetime.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection