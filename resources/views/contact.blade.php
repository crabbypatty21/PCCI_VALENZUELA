@extends('layouts.app')

@section('content')

{{-- 
    CONTACT HERO 
    - Standardized padding-top: 140px
    - Standardized Gradient & Font Styles
--}}
<div class="w-100 mb-0 d-flex flex-column align-items-center" style="
    height: 623px;
    margin-top: -1px; 
    background-color: #252631;
    background-size: cover;
    background-position: center;
    padding-top: 130px;
">
    <div class="container d-flex flex-column align-items-center text-center">
        
        {{-- Subtitle --}}
        <span class="text-white mb-3 d-block" 
            style="font-family: 'DM Sans', sans-serif; font-weight: 900; font-size: 24px; line-height: 100%; letter-spacing: 0; text-transform: uppercase; width: 100%; max-width: 1522px; text-align: center;">
            PCCI - VALENZUELA
        </span>

        {{-- Main Headline --}}
        <h1 class="headline-text fw-bold mb-4 text-uppercase text-white" 
            style="font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">
            Contact <span style="color: #EB3223; font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">Us</span>
        </h1>

        {{-- Paragraph --}}
        <p class="text-white" 
        style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 24px; line-height: 100%; letter-spacing: 0; text-align: center; width: 100%; max-width: 1262px; height: auto; margin: 0 auto 21px auto;">
            Get in touch with PCCI Valenzuela for membership inquiries, business partnerships, or any questions about our services.
        </p>
    </div>
</div>

{{-- MAIN CONTACT CONTENT --}}
<div class="py-5" style="background-color: #e9ecef;">
    <div class="container">
        <div class="row g-4">
            
            {{-- Left Column: Contact Info --}}
            <div class="col-lg-5">
                {{-- Info Card --}}
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background: #fff;">
                    <h3 class="fw-bold mb-4 text-dark" style="font-family: 'Poppins', sans-serif;">Get in Touch</h3>
                    
                    {{-- Address --}}
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #fff1f3; border-radius: 10px;">
                                <i class="bi bi-geo-alt-fill" style="font-size: 1.3rem; color: #D40032;"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark" style="font-family: 'Poppins', sans-serif;">Office Address</h6>
                            <p class="text-secondary mb-0 small" style="font-family: 'DM Sans', sans-serif; line-height: 1.6;">
                                Valenzuela City, Metro Manila NCR<br>Philippines
                            </p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #fff1f3; border-radius: 10px;">
                                <i class="bi bi-telephone-fill" style="font-size: 1.3rem; color: #D40032;"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark" style="font-family: 'Poppins', sans-serif;">Phone Number</h6>
                            <p class="text-secondary mb-0 small" style="font-family: 'DM Sans', sans-serif;">
                                +63 982 265 8382
                            </p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #fff1f3; border-radius: 10px;">
                                <i class="bi bi-envelope-fill" style="font-size: 1.3rem; color: #D40032;"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark" style="font-family: 'Poppins', sans-serif;">Email Address</h6>
                            <p class="text-secondary mb-0 small" style="font-family: 'DM Sans', sans-serif;">
                                pccivalenzuelacity@gmail.com
                            </p>
                        </div>
                    </div>

                    {{-- Office Hours --}}
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #fff1f3; border-radius: 10px;">
                                <i class="bi bi-clock-fill" style="font-size: 1.3rem; color: #D40032;"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark" style="font-family: 'Poppins', sans-serif;">Office Hours</h6>
                            <div class="text-secondary small" style="font-family: 'DM Sans', sans-serif; line-height: 1.6;">
                                <div class="d-flex justify-content-between gap-3"><span>Mon - Fri:</span> <span>8:00 AM - 5:00 PM</span></div>
                                <div class="d-flex justify-content-between gap-3"><span>Saturday:</span> <span>8:00 AM - 12:00 PM</span></div>
                                <div class="d-flex justify-content-between gap-3"><span>Sunday:</span> <span>Closed</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Board Link Card --}}
                <div class="card border-0 shadow-sm mt-4 p-4" style="border-radius: 12px; background: #fff;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #e9ecef; border-radius: 10px;">
                            <i class="bi bi-people-fill" style="font-size: 1.2rem; color: #212529;"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Poppins', sans-serif;">Board of Trustees</h5>
                    </div>
                    <p class="text-secondary mb-4 small" style="font-family: 'DM Sans', sans-serif; line-height: 1.6;">
                        Meet our dedicated board members who guide PCCI Valenzuela's strategic direction and initiatives.
                    </p>
                    <a href="{{ route('leadership') }}" class="btn w-100 fw-bold text-uppercase" 
                       style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; border: 2px solid #D40032; color: #D40032; border-radius: 6px; letter-spacing: 0.05em;">
                        View Board Members
                    </a>
                </div>
            </div>

            {{-- Right Column: Map --}}
            <div class="col-lg-7">
                <div class="card h-100 border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.600688755609!2d120.96328967590483!3d14.678457675168015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b41113061fb7%3A0x6273410766324dc8!2sValenzuela%20City%20Hall!5e0!3m2!1sen!2sph!4v1709612345678!5m2!1sen!2sph"
                        width="100%" 
                        height="100%" 
                        style="border:0; min-height: 500px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FAQ SECTION (Red Background Style) --}}
<div class="py-5" style="background-color: #D40032;">
    <div class="container py-4">
        <div class="text-center text-white mb-5">
            <span class="fw-bold text-uppercase mb-2 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.1em; opacity: 0.9;">
                Common Questions
            </span>
            <h2 class="fw-bold mb-3 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem);">
                Frequently Asked Questions
            </h2>
            <p class="mx-auto" style="font-family: 'DM Sans', sans-serif; max-width: 800px; font-size: 1.1rem; opacity: 0.9;">
                Everything you need to know about membership and services.
            </p>
        </div>

        <div class="row g-4">
            @foreach([
                ['q' => 'How do I become a member?', 'a' => 'You can apply for membership by completing our online application form or visiting our office. Membership is open to all legitimate businesses.'],
                ['q' => 'What are the benefits?', 'a' => 'Members enjoy networking opportunities, business development programs, advocacy representation, and access to exclusive events.'],
                ['q' => 'Do you organize seminars?', 'a' => 'Yes, we regularly organize networking events, business seminars, workshops, and advocacy forums.'],
                ['q' => 'What industries do you serve?', 'a' => 'We welcome businesses from all industries including manufacturing, retail, services, technology, and more.'],
            ] as $faq)
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background-color: white;">
                    <div class="d-flex align-items-start gap-3">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fff1f3; border-radius: 8px;">
                                <i class="bi bi-question-lg" style="font-size: 1.2rem; color: #D40032;"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2 text-dark" style="font-family: 'Poppins', sans-serif;">{{ $faq['q'] }}</h6>
                            <p class="text-secondary mb-0 small" style="font-family: 'DM Sans', sans-serif; line-height: 1.6;">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- FINAL CTA (White Background Style) --}}
<div class="py-5 bg-white">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-3 text-uppercase" style="font-family: 'Poppins', sans-serif; font-size: clamp(1.75rem, 4vw, 2.5rem); color: #212529;">
            Ready to Join Our Community?
        </h2>
        <p class="text-secondary mx-auto mb-5" style="font-family: 'DM Sans', sans-serif; max-width: 700px; font-size: 1.1rem; line-height: 1.7;">
            Take the first step towards growing your business with PCCI Valenzuela. Join hundreds of successful businesses today.
        </p>
        
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ url('/membership') }}" class="btn text-white fw-bold px-5 py-3 text-uppercase shadow-sm" 
               style="font-family: 'DM Sans', sans-serif; background-color: #D40032; border-radius: 6px; letter-spacing: 0.05em;">
                Apply for Membership
            </a>
            <a href="{{ url('/about') }}" class="btn btn-outline-dark fw-bold px-5 py-3 text-uppercase" 
               style="font-family: 'DM Sans', sans-serif; border-radius: 6px; letter-spacing: 0.05em;">
                Learn More About Us
            </a>
        </div>
    </div>
</div>

@endsection