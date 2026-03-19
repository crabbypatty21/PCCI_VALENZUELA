@extends('layouts.app')

@section('content')
@include('partials.api-config')

<style>
    /* =========================================
       DARK MODE ADAPTATIONS
       ========================================= */
    
    /* Hero Background */
    .leadership-hero {
        background-color: var(--bg-hero); /* Uses CSS Variable */
        transition: background-color 0.3s ease;
    }

    /* Officer Card */
    .officer-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(245, 48, 3, 0.2);
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        background-color: var(--bg-card); /* Dark Mode Card */
    }
    
    .officer-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(245, 48, 3, 0.5) !important;
    }

    .officer-card img {
        transition: transform 0.5s ease;
        width: 100%;
        object-fit: cover;
    }

    .officer-card:hover img {
        transform: scale(1.05);
    }

    /* Gradient Overlay */
    .officer-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 1.5rem;
        background: linear-gradient(to top, rgba(185, 28, 28, 0.95), rgba(185, 28, 28, 0));
        color: white;
    }

    /* Adaptive Sections */
    .bg-adaptive {
        background-color: #ffffff;
        transition: background-color 0.3s ease;
    }

    body.dark-mode .bg-adaptive {
        background-color: var(--bg-section-gray);
    }
    
    /* Alternating Section Background */
    .bg-adaptive-alt {
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
    }

    body.dark-mode .bg-adaptive-alt {
        background-color: var(--bg-body);
    }

    /* Text Colors */
    .text-adaptive { color: #212529; }
    body.dark-mode .text-adaptive { color: var(--text-main); }

    .text-muted-adaptive { color: #6c757d; }
    body.dark-mode .text-muted-adaptive { color: var(--text-secondary); }
    
    .card-bg-adaptive {
        background-color: #ffffff;
    }
    body.dark-mode .card-bg-adaptive {
        background-color: var(--bg-card);
    }
</style>

{{-- 
    HERO SECTION 
    - Updated to match About/Contact Page Structure (623px height)
--}}
<div class="w-100 mb-0 d-flex flex-column align-items-center leadership-hero" style="
    height: 623px;
    margin-top: -1px; 
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
            Meet Our <span style="color: #EB3223; font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">Leadership</span>
        </h1>

        {{-- Paragraph --}}
        <p class="text-white" 
        style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 24px; line-height: 120%; letter-spacing: 0; text-align: center; width: 100%; max-width: 1262px; margin: 0 auto;">
            The dedicated visionaries and industry leaders driving economic growth and innovation in Valenzuela City.
        </p>
    </div>
</div>

{{-- President Spotlight Section --}}
<div class="py-5 bg-adaptive">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 order-lg-2">
                <div class="position-relative">
                    {{-- Image --}}
                    <img id="president-img" src=""
                         alt=""
                         class="img-fluid shadow-lg"
                         style="border-radius: 12px; border: 8px solid #F53003;">

                    {{-- Name Tag --}}
                    <div class="position-absolute bottom-0 start-0 p-4 shadow-sm card-bg-adaptive" style="border-radius: 0 12px 0 12px; max-width: 80%;">
                        <h5 id="president-name" class="fw-bold mb-0 text-danger" style="font-family: 'Poppins', sans-serif;"></h5>
                        <small id="president-position" class="fw-bold text-uppercase text-muted-adaptive" style="letter-spacing: 0.05em; font-family: 'DM Sans', sans-serif;"></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 order-lg-1">
                <span class="text-danger fw-bold mb-3 d-block text-uppercase" style="font-family: 'DM Sans', sans-serif; font-size: 0.9rem; letter-spacing: 0.05em;">
                    Message from the President
                </span>
                <h2 id="president-headline" class="fw-bold mb-4 text-adaptive" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.3;">
                    Steering Valenzuela Towards a Resilient Future.
                </h2>
                <p id="president-message" class="text-muted-adaptive mb-4" style="font-family: 'DM Sans', sans-serif; line-height: 1.8; font-size: 1.05rem;">
                </p>
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 60px; height: 4px; background-color: #F53003;"></div>
                    <span id="president-attribution" class="fst-italic fw-bold text-adaptive" style="font-family: 'DM Sans', sans-serif;"></span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Executive Officers Section --}}
<div class="py-5 bg-adaptive">
    <div class="container py-4">
        {{-- Section Header --}}
        <div class="text-center mb-5">
            <span class="text-danger fw-bold mb-2 d-block text-uppercase" style="font-family: 'DM Sans', sans-serif; letter-spacing: 0.1em; font-size: 0.9rem;">
                Board of Trustees
            </span>
            <h2 class="fw-bold mb-3 text-adaptive" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem);">
                Meet Our Trustees
            </h2>
        </div>

        {{-- Empty container where JS will inject the cards --}}
        <div id="trustees-list" class="row g-4">
            <div class="col-12 text-center text-muted">
                <p><i class="fa fa-spinner fa-spin text-danger me-2"></i> Loading trustees...</p>
            </div>
        </div>
        
    </div>
</div>

{{-- Call to Action --}}
<div class="py-5 text-white" style="background-color: #D40032;">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-4 text-uppercase" style="font-family: 'Poppins', sans-serif;">Want to Join our Leadership?</h2>
        <p class="mb-4 opacity-90 mx-auto" style="font-family: 'DM Sans', sans-serif; max-width: 600px; font-size: 1.1rem;">
            We are always looking for passionate business leaders to join our committees and help shape the future of Valenzuela.
        </p>
        <a href="{{ url('/contact') }}" class="btn btn-light fw-bold px-5 py-3 text-uppercase shadow-sm" 
           style="color: #D40032; border-radius: 6px; font-family: 'DM Sans', sans-serif; letter-spacing: 0.05em;">
            Contact the Secretariat
        </a>
    </div>
</div>

{{-- Dynamic API Fetch Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    fetchTrustees();

    async function fetchTrustees() {
        const container = document.getElementById('trustees-list');

        try {
            const response = await fetch(`${window.API_BASE_URL}/v1/trustees`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error("Failed to fetch trustees");

            const data = await response.json();
            const trustees = data.data && data.data.length > 0 ? data.data : [];

            // Sort by position ID (President first, Vice President second, etc.)
            trustees.sort((a, b) => {
                const aId = a.board_position_id || (a.position && a.position.id) || 999;
                const bId = b.board_position_id || (b.position && b.position.id) || 999;
                return Number(aId) - Number(bId);
            });

            // Populate President Spotlight from API data
            populatePresident(trustees);

            // Clear the "Loading..." spinner
            container.innerHTML = "";

            if (trustees.length > 0) {
                trustees.forEach(trustee => {
                    const firstName = trustee.firstname || '';
                    const middleName = trustee.middlename ? ` ${trustee.middlename} ` : ' ';
                    const lastName = trustee.lastname || '';

                    const position = trustee.position && trustee.position.position
                                     ? trustee.position.position
                                     : 'Trustee';

                    const fallbackImage = `https://ui-avatars.com/api/?name=${encodeURIComponent(firstName + ' ' + lastName)}&background=f3f4f6&color=b61b2a&bold=true&size=400`;
                    const imageUrl = trustee.image_url || fallbackImage;

                    const card = document.createElement('div');
                    card.className = "col-md-6 col-lg-3";

                    card.innerHTML = `
                        <div class="officer-card">
                            <img src="${imageUrl}"
                                 alt="${firstName} ${lastName}"
                                 style="height: 400px; width: 100%; object-fit: cover;">

                            <div class="officer-overlay">
                                <h5 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif; text-transform: capitalize;">
                                    ${firstName}${middleName}${lastName}
                                </h5>
                                <p class="mb-0 small text-uppercase" style="opacity: 0.9; letter-spacing: 0.05em; font-size: 0.75rem; font-family: 'DM Sans', sans-serif;">
                                    ${position}
                                </p>
                            </div>
                        </div>
                    `;
                    container.appendChild(card);
                });
            } else {
                container.innerHTML = `<div class="col-12 text-center text-muted"><p>No leadership data available at the moment.</p></div>`;
            }

        } catch (err) {
            console.error("Error loading trustees:", err);
            container.innerHTML = `
                <div class="col-12 text-center text-danger">
                    <i class="fa fa-exclamation-circle mb-2" style="font-size: 2rem;"></i>
                    <p>Error connecting to the server. Please try again later.</p>
                </div>`;
        }
    }

    function populatePresident(trustees) {
        // Find the president (exact match, not "vice president")
        const president = trustees.find(t => {
            const pos = t.position && t.position.position ? t.position.position : '';
            return pos.toLowerCase().trim() === 'president';
        }) || trustees[0]; // Fallback to first trustee

        if (!president) return;

        const firstName = president.firstname || '';
        const middleName = president.middlename ? ` ${president.middlename} ` : ' ';
        const lastName = president.lastname || '';
        const fullName = (firstName + middleName + lastName).trim();

        const position = president.position && president.position.position
                         ? president.position.position
                         : 'President';

        const fallbackImage = `https://ui-avatars.com/api/?name=${encodeURIComponent(firstName + ' ' + lastName)}&background=f3f4f6&color=b61b2a&bold=true&size=400`;
        const imageUrl = president.image_url || fallbackImage;

        const message = president.message || president.quote ||
            '"Our leadership team is committed to more than just business growth; we are dedicated to building a legacy of excellence. Every decision we make is guided by our desire to see every enterprise in Valenzuela flourish, creating a ripple effect of prosperity across our entire community."';

        // Populate the President Spotlight section
        const imgEl = document.getElementById('president-img');
        imgEl.src = imageUrl;
        imgEl.alt = fullName;

        document.getElementById('president-name').textContent = fullName;
        document.getElementById('president-position').textContent = position;
        document.getElementById('president-message').textContent = message;
        document.getElementById('president-attribution').textContent = fullName + ', PCCI Valenzuela';
    }
});
</script>
@endsection