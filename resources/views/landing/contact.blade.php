@extends('layouts.app')

@section('content')

{{-- Add this line to the top of EVERY file! --}}
@include('partials.api-config')

{{-- Page-Specific Styles for Dark Mode Components --}}


<style>
    /* Default (Light Mode) Icon Box */
    .icon-box {
        width: 50px; 
        height: 50px; 
        background-color: #fff1f3; 
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }
    
    .icon-box i {
        font-size: 1.5rem; 
        color: #D40032;
        transition: color 0.3s ease;
    }

    /* Dark Mode Overrides */
    body.dark-mode .icon-box {
        background-color: rgba(212, 0, 50, 0.15); /* Subtle dark red background */
    }
    
    body.dark-mode .icon-box i {
        color: #ff6b81; /* Lighter red for better contrast on dark */
    }

    /* Map Card Overlay in Dark Mode (Optional: dims the map slightly) */
    body.dark-mode iframe {
        filter: brightness(0.85) contrast(1.1);
    }
    
    /* Ensure links in dark mode are visible */
    body.dark-mode a.text-decoration-none.text-secondary {
        color: var(--text-secondary) !important;
    }
    
    body.dark-mode a.text-decoration-none.text-secondary:hover {
        color: var(--pcci-red) !important;
    }
</style>

{{-- Hero Section --}}
{{-- Changed bg-color to var(--bg-hero) to adapt to dark mode --}}
<div class="w-100 mb-0 d-flex flex-column align-items-center" style="
    height: 623px;
    margin-top: -1px; 
    background-color: var(--bg-hero); 
    padding-top: 130px;
    transition: background-color 0.3s ease;
">
    <div class="container d-flex flex-column align-items-center text-center">
        
        {{-- Subtitle --}}
        <span class="text-white mb-3 d-block" 
            style="font-family: 'DM Sans', sans-serif; font-weight: 900; font-size: 24px; line-height: 100%; letter-spacing: 0; text-transform: uppercase; width: 100%; text-align: center;">
            GET IN TOUCH
        </span>

        {{-- Main Headline --}}
        <h1 class="headline-text fw-bold mb-4 text-uppercase text-white" 
            style="font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">
            Contact <span style="color: #EB3223; font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">Us.</span>
        </h1>

        {{-- Paragraph --}}
        <p class="text-white" 
        style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; line-height: 120%; letter-spacing: 0; text-align: center; width: 100%; max-width: 800px; margin: 0 auto;">
            We are here to help. Reach out to PCCI Valenzuela for membership inquiries, partnerships, or any questions about our services.
        </p>
    </div>
</div>

{{-- Main Contact Content --}}
{{-- Applied var(--bg-section-gray) --}}
<div class="py-5" style="background-color: var(--bg-section-gray); transition: background-color 0.3s ease;">
    <div class="container py-4">
        <div class="row g-4">
            {{-- Left Column: Contact Info & Trustees --}}
            <div class="col-lg-5">
                
                {{-- Contact Info Card --}}
                {{-- Applied var(--bg-card) --}}
                <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 12px; background-color: var(--bg-card);">
                    <h3 class="fw-bold mb-4" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Get in Touch</h3>

                    {{-- Address --}}
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                        <div class="flex-shrink-0">
                            <div class="icon-box">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Office Address</h6>
                            <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; color: var(--text-secondary);">
                                Valenzuela City, Metro Manila NCR<br>Philippines
                            </p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                        <div class="flex-shrink-0">
                            <div class="icon-box">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Phone Number</h6>
                            <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; color: var(--text-secondary);">
                                09822658382
                            </p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                        <div class="flex-shrink-0">
                            <div class="icon-box">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Email Address</h6>
                            <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; color: var(--text-secondary);">
                                pccivalenzuelacity@gmail.com
                            </p>
                        </div>
                    </div>

                    {{-- Website --}}
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                        <div class="flex-shrink-0">
                            <div class="icon-box">
                                <i class="bi bi-globe"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Website</h6>
                            <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; color: var(--text-secondary);">
                                <a href="https://www.pccivalenzuelacity.com/" target="_blank" class="text-decoration-none text-secondary">www.pccivalenzuelacity.com</a>
                            </p>
                        </div>
                    </div>

                    {{-- Office Hours --}}
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <div class="icon-box">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Office Hours</h6>
                            <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; color: var(--text-secondary);">
                                Mon - Fri: 8:00 AM - 5:00 PM<br>
                                Sat: 8:00 AM - 12:00 PM<br>
                                Sun: Closed
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Board of Trustees Section --}}
                <div class="card border-0 shadow-sm p-4" style="border-radius: 12px; background-color: var(--bg-card);">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-box">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Board of Trustees</h5>
                    </div>
                    <p class="mb-4" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                        Meet our dedicated board members who guide PCCI Valenzuela's strategic direction and initiatives.
                    </p>
                    <a href="{{ route('leadership') }}" class="btn btn-outline-danger fw-bold w-100 text-uppercase" 
                       style="font-family: 'DM Sans', sans-serif; border-radius: 8px; padding: 10px; border: 2px solid #D40032; color: #D40032;">
                        View Board Members
                    </a>
                </div>

            </div>

            {{-- Right Column: Map --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; background-color: var(--bg-card);">
                    <div class="card-header border-0 p-4" style="background-color: var(--bg-card);">
                        <h3 class="fw-bold mb-0" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">Our Location</h3>
                    </div>
                    <div class="card-body p-0 h-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.948286280466!2d120.9634673!3d14.6838385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b4742e616c31%3A0xc39c82c617937748!2sValenzuela%20City%20Hall!5e0!3m2!1sen!2sph!4v1707747891234!5m2!1sen!2sph"
                            width="100%" 
                            height="100%" 
                            style="border:0; min-height: 600px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FAQ Section --}}
{{-- Background stays Red (#D40032) in both modes, but cards inside will adapt --}}
<div class="py-5" style="background-color: #D40032;">
    <div class="container text-white py-4">
        <div class="text-center mb-5">
            <span class="text-white fw-bold text-uppercase mb-2 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; opacity: 0.9;">
                FAQ
            </span>
            <h2 class="fw-bold mb-3 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); letter-spacing: -0.01em;">
                Frequently Asked Questions
            </h2>
            <p class="mx-auto mb-0" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.1rem; line-height: 1.7; opacity: 0.9;">
                Common questions about PCCI Valenzuela membership and services.
            </p>
        </div>

        <div class="row g-4">
            @foreach([
                [
                    'question' => 'How do I become a member?',
                    'answer' => 'You can apply for membership by completing our application form online or visiting our office during business hours. Membership is open to all legitimate businesses operating in the area.'
                ],
                [
                    'question' => 'What are the membership benefits?',
                    'answer' => 'Members enjoy networking opportunities, business development programs, advocacy representation, access to exclusive events, and promotional support for their businesses.'
                ],
                [
                    'question' => 'Do you organize business events?',
                    'answer' => 'Yes, we regularly organize networking events, business seminars, workshops, and advocacy forums to help our members grow their businesses and stay informed about industry trends.'
                ],
                [
                    'question' => 'What industries do you serve?',
                    'answer' => 'We welcome businesses from all industries including manufacturing, retail, services, technology, healthcare, hospitality, and more. Our diverse membership reflects Valenzuela\'s vibrant business landscape.'
                ]
            ] as $faq)
            <div class="col-md-6">
                {{-- FAQ Cards: var(--bg-card) --}}
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: var(--bg-card);">
                    <div class="d-flex align-items-start gap-3">
                        <div class="flex-shrink-0">
                            <div class="icon-box" style="width: 40px; height: 40px;">
                                <i class="bi bi-question-lg" style="font-size: 1.25rem;"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2" style="font-family: 'Poppins', sans-serif; color: var(--text-main);">{{ $faq['question'] }}</h6>
                            <p class="mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.6; color: var(--text-secondary);">
                                {{ $faq['answer'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Final CTA Section --}}
{{-- Changed bg-white to var(--bg-body) --}}
<section class="py-5 border-top" style="background-color: var(--bg-body); border-color: var(--border-color) !important;">
    <div class="container text-center py-5">
        <span class="fw-bold text-uppercase mb-3 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.15em; color: #D40032;">
            Join the Community
        </span>
        <h2 class="fw-bold mb-4 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 5vw, 2.75rem); color: var(--text-main); line-height: 1.2;">
            Ready to Grow Your Business?
        </h2>
        
        <p class="mx-auto mb-5" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.15rem; line-height: 1.8; color: var(--text-secondary);">
            Take the first step towards success with PCCI Valenzuela. Join hundreds of successful businesses that are part of our thriving ecosystem.
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ url('/membership') }}" class="btn text-white fw-bold px-5 py-3 text-uppercase d-inline-flex align-items-center gap-3 shadow-sm" 
               style="font-family: 'DM Sans', sans-serif; background-color: #D40032; border: none; border-radius: 6px; font-size: 1rem; letter-spacing: 0.05em;">
                Apply for Membership
                <i class="bi bi-arrow-right" style="font-size: 1.2rem;"></i>
            </a>

            <a href="{{ route('about') }}" class="btn btn-outline-danger fw-bold px-5 py-3 text-uppercase" 
               style="font-family: 'DM Sans', sans-serif; border-radius: 6px; font-size: 1rem; letter-spacing: 0.05em; border: 2px solid #D40032; color: #D40032;">
                Learn More About Us
            </a>
        </div>
    </div>
</section>

@endsection