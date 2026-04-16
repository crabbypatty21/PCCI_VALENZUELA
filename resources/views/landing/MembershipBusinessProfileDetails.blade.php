@extends('layouts.app')
@include('partials.api-config')
@section('content')

{{-- LOADING SPINNER --}}
<div id="loading-spinner" class="text-center py-5 d-flex flex-column justify-content-center align-items-center" style="min-height: 80vh; padding-top: 100px;">
    <i class="bi bi-arrow-repeat text-danger" style="display:inline-block; animation: spin 1s linear infinite; font-size: 3rem;"></i>
    <p class="mt-3 fw-bold text-muted" style="font-family: 'Poppins', sans-serif;">Loading Business Profile...</p>
</div>

{{-- ERROR STATE --}}
<div id="error-state" class="container text-center py-5 d-flex flex-column justify-content-center align-items-center" style="display: none; min-height: 80vh; padding-top: 100px;">
    <h1 class="text-danger fw-bold" style="font-size: 4rem;"><i class="bi bi-exclamation-circle"></i></h1>
    <h2 class="fw-bold mt-3" style="color: var(--text-main);">Profile Not Found</h2>
    <p class="text-muted" id="error-message">The business profile you are looking for does not exist or couldn't be loaded.</p>
    <a href="{{ route('membership') }}" class="btn btn-danger mt-4 px-4 py-2 fw-bold rounded-pill">Return to Directory</a>
</div>

{{-- MAIN CONTENT WRAPPER --}}
<div id="main-content" style="display: none;">
    
    {{-- HERO SECTION --}}
    <div class="w-100" style="background:#1f2330; min-height: 420px; transition: all 0.3s ease;">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-md-start g-4" style="padding-top:120px; padding-bottom:80px;">

                {{-- LOGO / INITIALS --}}
                <div class="col-12 col-md-auto text-center text-md-start">
                    <div class="rounded-4 bg-light d-inline-flex align-items-center justify-content-center overflow-hidden shadow-lg mx-auto mx-md-0"
                         style="width:130px; height:130px; border: 4px solid rgba(255,255,255,0.1);" id="biz-avatar-container">
                        <span class="fw-bold text-danger" style="font-size: 2.5rem;" id="biz-initials">...</span>
                    </div>
                </div>

                {{-- HERO CONTENT --}}
                <div class="col-12 col-md text-center text-md-start">
                    <h1 class="fw-bold text-white mb-2 text-break w-100" style="font-family: 'DM Sans', sans-serif; font-size: clamp(1.75rem, 5vw, 2.5rem);" id="biz-name-main">
                        Loading...
                    </h1>
                    
                    <span class="badge rounded-pill mb-3 px-3 py-2 fw-bold text-uppercase d-inline-block text-truncate" style="background:#2e5aac; font-size: 0.85rem; max-width: 100%;" id="biz-industry">
                        Industry
                    </span>

                    <p class="text-light mb-4 font-italic mx-auto mx-md-0" style="max-width:750px; opacity:.9; font-size: clamp(0.95rem, 3vw, 1.1rem); line-height: 1.6;" id="biz-tagline">
                        Loading tagline...
                    </p>

                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-md-start gap-3 w-100 w-sm-auto">
                        <a href="#" id="biz-phone-btn" class="btn btn-danger px-4 py-3 py-md-2 fw-bold rounded-pill shadow-sm w-100 w-sm-auto">
                            <i class="bi bi-telephone-fill me-2"></i> CONTACT US
                        </a>
                        <a href="#" id="biz-email-btn" class="btn btn-outline-light px-4 py-3 py-md-2 fw-bold rounded-pill w-100 w-sm-auto">
                            <i class="bi bi-envelope-fill me-2"></i> EMAIL NOW
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5" style="font-family: 'DM Sans', sans-serif;">
        <div class="row g-4 g-lg-5">

            {{-- LEFT CONTENT --}}
            <div class="col-12 col-lg-8">

                {{-- ABOUT --}}
                <div class="card border border-danger shadow-sm p-4 p-md-5 rounded-4 mb-4" style="background: var(--bg-card);">
                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-3 mb-4 text-center text-sm-start">
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-buildings text-danger fs-4"></i>
                        </div>
                        <h4 class="fw-bold text-danger mb-0 mt-sm-2" style="font-family: 'Poppins', sans-serif;">About Our Company</h4>
                    </div>
                    <p id="biz-about-side" style="line-height: 1.8; color: var(--text-main); font-size: 1.05rem;" class="text-center text-sm-start">Loading...</p>
                </div>

                {{-- PRODUCTS & SERVICES (TAGS) --}}
                <div class="card border border-danger shadow-sm p-4 p-md-5 rounded-4 mb-4" style="background: var(--bg-card);">
                    <h4 class="fw-bold text-danger mb-4 d-flex align-items-center justify-content-center justify-content-sm-start gap-2 text-center text-sm-start">
                        <i class="bi bi-briefcase"></i>
                        <span>Products & Services</span>
                    </h4>
                    <div class="row g-3" id="biz-services">
                        {{-- Services injected here via JS --}}
                    </div>
                </div>

                {{-- MAP --}}
                <div class="card border border-danger shadow-sm p-4 p-md-5 rounded-4 mb-5 mb-lg-0" style="background: var(--bg-card);">
                    <h4 class="fw-bold text-danger mb-3 d-flex align-items-center justify-content-center justify-content-sm-start gap-2 text-center text-sm-start">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Our Location</span>
                    </h4>
                    <p class="mb-4 fw-bold text-center text-sm-start" style="color: var(--text-main); font-size: 1.1rem;">
                        <span id="biz-address-map">Loading...</span>
                    </p>
                    <div class="rounded-4 overflow-hidden shadow-sm border w-100" style="position: relative; padding-bottom: 56.25%; /* 16:9 Aspect Ratio */ height: 0;">
                        <iframe id="biz-map-frame"
                            src=""
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border:0;" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="col-12 col-lg-4">

                {{-- CONTACT INFO --}}
                <div class="card border border-danger shadow-sm p-4 rounded-4 mb-4" style="background: var(--bg-card);">
                    <h5 class="fw-bold text-danger mb-4 text-center text-sm-start" style="font-family: 'Poppins', sans-serif;">Contact Information</h5>
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-3 text-center text-sm-start">
                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width:45px;height:45px;">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="overflow-hidden w-100">
                                <small class="fw-bold text-uppercase text-danger" style="letter-spacing: 1px; font-size: 0.75rem;">Phone</small><br>
                                <span id="biz-phone" class="fw-medium text-break" style="color: var(--text-main); font-size: 1.05rem;">Loading...</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-3 text-center text-sm-start">
                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width:45px;height:45px;">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div class="overflow-hidden w-100">
                                <small class="fw-bold text-uppercase text-danger" style="letter-spacing: 1px; font-size: 0.75rem;">Email</small><br>
                                <span id="biz-email" class="fw-medium text-break" style="color: var(--text-main); font-size: 1.05rem;">Loading...</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-3 text-center text-sm-start">
                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width:45px;height:45px;">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="overflow-hidden w-100">
                                <small class="fw-bold text-uppercase text-danger" style="letter-spacing: 1px; font-size: 0.75rem;">Address</small><br>
                                <span id="biz-address" class="fw-medium text-break" style="color: var(--text-main); font-size: 1.05rem;">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BUSINESS HOURS --}}
                <div class="card border border-danger shadow-sm p-4 rounded-4 mb-4" style="background: var(--bg-card);">
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-start gap-2 mb-4 text-center text-sm-start">
                        <i class="bi bi-clock-history text-danger fs-4 flex-shrink-0"></i>
                        <h5 class="fw-bold text-danger mb-0" style="font-family: 'Poppins', sans-serif;">Business Hours</h5>
                    </div>
                    <div class="d-flex flex-column gap-2" id="biz-hours-container">
                        {{-- Hours injected here --}}
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="card border border-danger shadow-sm p-4 rounded-4 position-lg-sticky" style="top: 100px; background: var(--bg-card);">
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-start gap-2 mb-3 text-center text-sm-start">
                        <i class="bi bi-gear text-danger fs-4 flex-shrink-0"></i>
                        <h5 class="fw-bold text-danger mb-0">Quick Actions</h5>
                    </div>
                    <div class="d-flex flex-column gap-3 w-100">
                        <button class="btn btn-outline-danger fw-bold rounded-pill w-100 py-2 py-md-1">Request Quote</button>
                        <button class="btn btn-outline-danger fw-bold rounded-pill w-100 py-2 py-md-1">Schedule Call</button>
                        <hr class="my-2 text-muted">
                        <a href="{{ route('membership') }}" class="btn btn-outline-danger fw-bold rounded-pill py-2 w-100">
                            <i class="bi bi-arrow-left me-2"></i> Browse Directory
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    @keyframes spin { 100% { transform: rotate(360deg); } }
    .service-box { height: 100%; display: flex; flex-direction: column; }
    .service-box:hover { transform: translateY(-3px); transition: all 0.3s ease; box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
    @media (min-width: 576px) { .w-sm-auto { width: auto !important; } }
    
    /* Ensure sticky sidebar only applies on large screens so it doesn't break mobile flow */
    @media (min-width: 992px) {
        .position-lg-sticky { position: sticky !important; }
    }
</style>

{{-- ========================================= --}}
{{-- API FETCH LOGIC --}}
{{-- ========================================= --}}
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const targetId = {{ $id }};
        
        const baseUrl = window.API_BASE_URL || 'https://pcci-laravel-api.onrender.com/api';
        
        try {
            const token = localStorage.getItem('token');
            const headers = { 'Accept': 'application/json' };
            if (token) headers['Authorization'] = `Bearer ${token}`;

            const response = await fetch(`${baseUrl}/v1/business`, {
                method: 'GET',
                headers: headers
            });

            if (!response.ok) throw new Error("Failed to connect to the business directory API.");

            const result = await response.json();
            const allBusinesses = result.data || result || [];
            
            const biz = allBusinesses[targetId];

            document.getElementById('loading-spinner').style.setProperty('display', 'none', 'important');

            if (!biz) {
                document.getElementById('error-message').innerText = "The business profile you are looking for does not exist.";
                document.getElementById('error-state').style.setProperty('display', 'flex', 'important');
                return;
            }

            // === MAPPING YOUR API DATA ===
            const name = biz.registered_business_name || 'Business Name';
            const email = biz.email || 'N/A';
            const phone = biz.telephone_no || 'N/A';
            const industry = biz.industry || 'Business';
            const tagline = biz.business_tagline || '';
            const description = biz.description || tagline || 'No detailed description provided.';
            
            // Handle Nested Location Object
            let address = 'Valenzuela City';
            let mapQuery = name;
            
            if (biz.business_location) {
                const loc = biz.business_location;
                
                if (loc.location_link && loc.location_link !== 'N/A') {
                    address = loc.location_link; 
                    mapQuery = loc.location_link; 
                } else {
                    const addressParts = [loc.business_address, loc.city_municipality, loc.province].filter(p => p && p !== 'N/A');
                    if (addressParts.length > 0) {
                        address = addressParts.join(', ');
                        mapQuery = address;
                    }
                }
            }
            // Update Basic Text Elements
            document.getElementById('biz-name-main').innerText = name;
            document.getElementById('biz-industry').innerText = industry;
            document.getElementById('biz-tagline').innerText = tagline ? `"${tagline}"` : '';
            document.getElementById('biz-about-side').innerText = description;
            document.getElementById('biz-phone').innerText = phone;
            document.getElementById('biz-email').innerText = email;
            document.getElementById('biz-address').innerText = address;
            document.getElementById('biz-address-map').innerText = address;

            // Update Contact Buttons
            document.getElementById('biz-phone-btn').href = phone !== 'N/A' ? `tel:${phone}` : '#';
            document.getElementById('biz-email-btn').href = email !== 'N/A' ? `mailto:${email}` : '#';

            // 3. DYNAMIC PHOTO URL
            if (biz.photo_url && biz.photo_url !== 'N/A' && biz.photo_url !== 'null') {
                const activeOrigin = new URL(baseUrl).origin; 
                let finalPhotoUrl = biz.photo_url.replace('http://127.0.0.1:8000', activeOrigin).replace('http://localhost:8000', activeOrigin);
                
                document.getElementById('biz-avatar-container').innerHTML = `<img src="${finalPhotoUrl}" alt="${name}" class="w-100 h-100" style="object-fit: cover;">`;
            } else {
                let initials = name.substring(0, 2).toUpperCase();
                const words = name.split(' ');
                if(words.length > 1 && words[1].length > 0) {
                    initials = (words[0][0] + words[1][0]).toUpperCase();
                }
                document.getElementById('biz-initials').innerText = initials;
            }

            // Map Tags Array to Services UI
            const servicesContainer = document.getElementById('biz-services');
            servicesContainer.innerHTML = '';
            const tags = Array.isArray(biz.tags) && biz.tags.length > 0 ? biz.tags : ['General Services'];
            
            tags.forEach(tag => {
                servicesContainer.innerHTML += `
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="service-box bg-danger bg-opacity-10 border border-danger border-opacity-25 rounded-4 p-3 text-center text-sm-start">
                            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-start gap-2 mb-2">
                                <i class="bi bi-check-circle-fill text-danger flex-shrink-0"></i>
                                <h6 class="fw-bold mb-0 text-danger text-capitalize text-break w-100" style="font-family: 'Poppins', sans-serif;">${tag}</h6>
                            </div>
                            <p class="small mb-0" style="color: var(--text-muted);">Core offering provided by ${name}.</p>
                        </div>
                    </div>
                `;
            });

            // Map Business Hours
            const hoursContainer = document.getElementById('biz-hours-container');
            hoursContainer.innerHTML = '';
            if (biz.business_hours && Object.keys(biz.business_hours).length > 0) {
                for (const [day, time] of Object.entries(biz.business_hours)) {
                    hoursContainer.innerHTML += `
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center align-items-sm-start mb-3 mb-sm-2 text-center text-sm-start border-bottom border-sm-0 pb-2 pb-sm-0" style="border-color: var(--border-color) !important;">
                            <span class="text-capitalize mb-1 mb-sm-0 w-100 w-sm-auto" style="color: var(--text-main); font-weight: 500;">${day}</span>
                            <span class="fw-bold w-100 w-sm-auto" style="color: var(--text-main);">${time}</span>
                        </div>
                    `;
                }
            } else {
                hoursContainer.innerHTML = '<span style="color: var(--text-muted); text-align: center;">Business hours not provided.</span>';
            }

            // 4. FIX GOOGLE MAPS URL
            const encodedMapQuery = encodeURIComponent(mapQuery + ', Philippines');
            document.getElementById('biz-map-frame').src = `https://maps.google.com/maps?q=${encodedMapQuery}&t=m&z=15&output=embed`;

            // Reveal the UI
            document.getElementById('main-content').style.display = 'block';

        } catch (error) {
            console.error("Error fetching business details:", error);
            document.getElementById('loading-spinner').style.setProperty('display', 'none', 'important');
            document.getElementById('error-message').innerText = "Unable to connect to the server. Please check your connection.";
            document.getElementById('error-state').style.setProperty('display', 'flex', 'important');
        }
    });
</script>

@endsection