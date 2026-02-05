@extends('layouts.app')

@section('title', 'Events - PCCI Valenzuela')

@section('content')

{{-- 
    STYLE MATCHING NOTES:
    1. Hero: Matched padding (140px top), gradient, and text sizes to Membership Reference.
    2. Filters: Converted to 'border-0 shadow-sm' style used in Business Directory.
    3. Cards: Applied 'card h-100 border-0 shadow-sm p-3' class structure.
--}}

{{-- HERO SECTION (Matched to Membership Reference) --}}
{{-- HERO SECTION (Updated to match other pages) --}}
<div class="w-100 mb-0 d-flex align-items-center" style="
    min-height: 500px;
    margin-top: -1px; 
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2069');
    background-size: cover;
    background-position: center;
">
    <div class="container d-flex flex-column align-items-center text-center">
        <span class="text-white fw-bold text-uppercase mb-3 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; opacity: 0.9;">
            PCCI - Valenzuela
        </span>
        <h1 class="headline-text fw-bold mb-4 text-uppercase text-white" style="font-family: 'Poppins', sans-serif; letter-spacing: -0.02em;">
            Events
        </h1>
        <p class="text-white mb-4" style="font-family: 'DM Sans', sans-serif; max-width: 600px; line-height: 1.7; font-size: 1.1rem; opacity: 0.9;">
            Join our community events designed to foster networking, learning, and business growth opportunities for all chamber members.
        </p>
    </div>
</div>

<div class="py-5" style="background-color: #e9ecef;">
    <div class="container mb-5">
        
        {{-- FILTERS (Matched to Business Directory Style) --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            
            {{-- Search Bar --}}
            <div class="w-100" style="max-width: 400px;">
                <div class="input-group shadow-sm bg-white rounded overflow-hidden border-0">
                    <span class="input-group-text bg-white border-0 ps-3">
                        <i class="bi bi-search text-secondary" style="font-size: 1.1rem;"></i>
                    </span>
                    <input type="text" class="form-control border-0 py-2 shadow-none text-secondary" 
                           style="font-family: 'DM Sans', sans-serif;"
                           placeholder="Search events..." aria-label="Search">
                </div>
            </div>

            {{-- Dropdowns --}}
            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-end" style="font-family: 'DM Sans', sans-serif;">
                <select class="form-select form-select-sm bg-white border-0 shadow-sm" style="width: auto; cursor: pointer; font-weight: 500; padding: 10px 30px 10px 15px;">
                    <option selected>All Categories</option>
                    <option value="networking">Networking</option>
                    <option value="seminars">Seminars</option>
                    <option value="ga">General Assembly</option>
                </select>

                <select class="form-select form-select-sm bg-white border-0 shadow-sm" style="width: auto; cursor: pointer; font-weight: 500; padding: 10px 30px 10px 15px;">
                    <option selected>All Status</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>

        {{-- EVENTS GRID --}}
        <div class="row g-4">
            @for ($i = 0; $i < 6; $i++)
            <div class="col-12 col-md-6 col-lg-4">
                {{-- CARD (Matched to Membership Reference: border-0, shadow-sm, p-3) --}}
                <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff;">
                    
                    {{-- Image Area --}}
                    <div class="position-relative mb-3 overflow-hidden rounded" style="height: 200px;">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2069" 
                             class="w-100 h-100 object-fit-cover" 
                             alt="Event Image">
                        
                        {{-- Status Badge --}}
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge {{ $i == 0 ? 'bg-success' : 'bg-secondary' }} shadow-sm text-uppercase" 
                                  style="font-family: 'DM Sans', sans-serif; font-size: 0.7rem; letter-spacing: 0.05em;">
                                {{ $i == 0 ? 'Upcoming' : 'Completed' }}
                            </span>
                        </div>
                    </div>

                    {{-- Card Content --}}
                    <div class="d-flex flex-column flex-grow-1">
                        {{-- Category Tag --}}
                        <span class="d-inline-block rounded px-2 py-1 mb-2 fw-bold text-uppercase align-self-start" 
                              style="font-family: 'DM Sans', sans-serif; font-size: 0.65rem; background-color: #fff1f3; color: #D40032; letter-spacing: 0.05em;">
                            General Assembly
                        </span>

                        <h5 class="fw-bold mb-2 text-dark" style="font-family: 'Poppins', sans-serif; font-size: 1.15rem; line-height: 1.4;">
                            A Purposeful Message to Business Owners
                        </h5>

                        {{-- Meta Data --}}
                        <div class="d-flex flex-column gap-2 small text-muted mb-3" style="font-family: 'DM Sans', sans-serif;">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-calendar3 text-danger"></i>
                                <span>Dec 9, 2025</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-clock text-danger"></i>
                                <span>9:00 AM - 12:00 PM</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-geo-alt text-danger"></i>
                                <span>Valenzuela City</span>
                            </div>
                        </div>

                        {{-- Action Button (Matched to Membership 'View Details' button) --}}
                        <div class="mt-auto pt-3 border-top d-flex justify-content-end">
                            <button type="button" class="btn py-1 px-3 text-white fw-bold d-flex align-items-center gap-2" 
                                    data-bs-toggle="modal" data-bs-target="#eventModal"
                                    style="font-family: 'DM Sans', sans-serif; font-size: 0.8rem; background-color: #D40032; border-radius: 6px; letter-spacing: 0.05em;">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        {{-- PAGINATION --}}
        <div class="row mt-5">
            <div class="col-12 text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center" style="gap: 5px;">
                        <li class="page-item disabled"><a class="page-link border-0 bg-transparent text-muted" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link rounded border-0 text-white fw-bold shadow-sm" href="#" style="background-color: #D40032;">1</a></li>
                        <li class="page-item"><a class="page-link rounded border-0 text-dark fw-bold" href="#">2</a></li>
                        <li class="page-item"><a class="page-link rounded border-0 text-dark fw-bold" href="#">3</a></li>
                        <li class="page-item"><a class="page-link border-0 bg-transparent text-dark fw-bold" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

{{-- MODAL (Styled to match System) --}}
<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            {{-- Modal Header --}}
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div>
                    <span class="d-inline-block rounded px-2 py-1 mb-2 fw-bold text-uppercase" 
                          style="font-family: 'DM Sans', sans-serif; font-size: 0.65rem; background-color: #fff1f3; color: #D40032; letter-spacing: 0.05em;">
                        General Assembly
                    </span>
                    <h4 class="modal-title fw-bold text-dark" style="font-family: 'Poppins', sans-serif;">A Purposeful Message</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-5">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2069" 
                             class="w-100 object-fit-cover shadow-sm rounded" 
                             style="height: 250px;" alt="Event Detail">
                        
                        {{-- Meta Box --}}
                        <div class="mt-3 p-3 bg-light rounded" style="font-family: 'DM Sans', sans-serif;">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-calendar-check text-danger me-3 fs-5"></i>
                                <div><small class="text-muted d-block" style="font-size: 0.75rem;">Date</small><strong style="font-size: 0.9rem;">Dec 9, 2025</strong></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-clock text-danger me-3 fs-5"></i>
                                <div><small class="text-muted d-block" style="font-size: 0.75rem;">Time</small><strong style="font-size: 0.9rem;">9:00 AM</strong></div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt text-danger me-3 fs-5"></i>
                                <div><small class="text-muted d-block" style="font-size: 0.75rem;">Location</small><strong style="font-size: 0.9rem;">Valenzuela City</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 d-flex flex-column">
                        <div style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.7; color: #444; max-height: 300px; overflow-y: auto; padding-right: 10px;">
                            <p class="lead fw-bold text-dark mb-3">A Message to Our Members</p>
                            <p>A PURPOSEFUL MESSAGE TO BUSINESS OWNERS, from outgoing president, Jundio Salvador: "The past four years of being entrusted with the privilege to serve the business community of Valenzuela have been nothing short of inspiring.</p>
                            <p>This event marks a significant milestone in our journey towards a more digital and sustainable future. We invite all members to join us as we reflect on our achievements.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        
                        <div class="mt-auto pt-3">
                            <button class="btn text-white w-100 fw-bold text-uppercase py-2" 
                                    style="font-family: 'DM Sans', sans-serif; background-color: #D40032; border-radius: 6px; letter-spacing: 0.05em;">
                                Register for this Event
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection