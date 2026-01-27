@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<div class="position-relative w-100 overflow-hidden" style="background: linear-gradient(135deg, rgba(245, 48, 3, 0.9), rgba(200, 35, 0, 0.9)), url('https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2069') center/cover; min-height: 400px;">
    <div class="container text-white text-center py-5" style="position: relative; z-index: 2;">
        <p class="text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.1em; opacity: 0.95;">
            JOIN PCCI - VALENZUELA
        </p>
        <h1 class="display-4 fw-bold mb-4" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1.2;">
            Contact Us
        </h1>
        <p class="mx-auto" style="max-width: 800px; font-size: 1.1rem; line-height: 1.7; opacity: 0.95;">
            Get in touch with PCCI - New Marikina for membership inquiries, business partnerships, or any questions about our services.
        </p>
    </div>
</div>

{{-- Main Contact Section --}}
<div class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            {{-- Get in Touch Section --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4" style="color: #1f1f1f;">Get in Touch</h3>
                        
                        <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #FEE2E2; border-radius: 10px;">
                                    <svg class="text-danger" width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Office Address</h6>
                                <p class="text-secondary mb-0 small">Valenzuela City, Metro Manila NCR<br>Philippines</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #FEE2E2; border-radius: 10px;">
                                    <svg class="text-danger" width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Phone Number</h6>
                                <p class="text-secondary mb-0 small">09822658382</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #FEE2E2; border-radius: 10px;">
                                    <svg class="text-danger" width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email Address</h6>
                                <p class="text-secondary mb-0 small">pccivalenzuelacity@gmail.com</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #FEE2E2; border-radius: 10px;">
                                    <svg class="text-danger" width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Website</h6>
                                <p class="text-secondary mb-0 small">https://www.pccivalenzuelacity.com/</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #FEE2E2; border-radius: 10px;">
                                    <svg class="text-danger" width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Office Hours</h6>
                                <p class="text-secondary mb-1 small">Monday - Friday: 8:00 AM - 5:00 PM</p>
                                <p class="text-secondary mb-1 small">Saturday: 8:00 AM - 12:00 PM</p>
                                <p class="text-secondary mb-0 small">Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Board of Trustees Section --}}
                <div class="card border-0 shadow-sm mt-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #FEE2E2; border-radius: 10px;">
                                <svg class="text-danger" width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h5 class="fw-bold mb-0">Board of Trustees</h5>
                        </div>
                        <p class="text-secondary mb-4 small">
                            Meet our dedicated board members who guide PCCI New Valenzuela's strategic direction and initiatives.
                        </p>
                        <a href="#leadership" class="btn btn-outline-danger fw-semibold w-100" style="border-radius: 8px;">
                            View Board Members
                        </a>
                    </div>
                </div>
            </div>

            {{-- Map Section --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header bg-white border-0 p-4">
                        <h3 class="fw-bold mb-0" style="color: #1f1f1f;">Our Location</h3>
                    </div>
                    <div class="card-body p-0">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.186270753392!2d120.98304931483584!3d14.698867089735304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b13b8cc4f3c9%3A0x3b9a6f0c5b1f8a3a!2sValenzuela%20City%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1234567890123!5m2!1sen!2sph"
                            width="100%" 
                            height="600" 
                            style="border:0;" 
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
<div class="py-5" style="background-color: #B91C1C;">
    <div class="container text-white">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">Frequently Asked Questions</h2>
            <p style="opacity: 0.95; font-size: 1.05rem;">Common questions about PCCI Valenzuela membership and services</p>
        </div>

        <div class="row g-4">
            @foreach([
                [
                    'question' => 'How do I become a member of PCCI Valenzuela?',
                    'answer' => 'You can apply for membership by completing our application form or visit our office during business hours. Membership is open to all legitimate businesses operating in the area.'
                ],
                [
                    'question' => 'What are the membership benefits?',
                    'answer' => 'Members enjoy networking opportunities, business development programs, advocacy representation, access to exclusive events, and promotional support for their businesses.'
                ],
                [
                    'question' => 'Do you organize business events and seminars?',
                    'answer' => 'Yes, we regularly organize networking events, business seminars, workshops, and advocacy forums to help our members grow their businesses and stay informed about industry trends.'
                ],
                [
                    'question' => 'How can PCCI Valenzuela help my business?',
                    'answer' => 'Members enjoy networking opportunities, business development programs, advocacy representation, access to exclusive events, and promotional support for their businesses.'
                ],
                [
                    'question' => 'What industries does PCCI Valenzuela serve?',
                    'answer' => 'We welcome businesses from all industries including manufacturing, retail, services, technology, healthcare, hospitality, and more. Our diverse membership reflects Valenzuela\'s vibrant business landscape.'
                ],
                [
                    'question' => 'How can I stay updated on PCCI activities?',
                    'answer' => 'Members enjoy networking opportunities, business development programs, advocacy representation, access to exclusive events, and promotional support for their businesses.'
                ],
            ] as $index => $faq)
            <div class="col-md-6">
                <div class="card border-0 h-100" style="border-radius: 12px; background-color: white;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="flex-shrink-0">
                                <div class="d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: #FEE2E2; border-radius: 8px;">
                                    <svg class="text-danger" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-2" style="color: #1f1f1f;">{{ $faq['question'] }}</h6>
                                <p class="text-secondary mb-0 small" style="line-height: 1.6;">{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Final CTA Section --}}
<div class="py-5" style="background-color: #B91C1C;">
    <div class="container">
        <div class="card border-0 shadow-lg" style="border-radius: 16px; background-color: rgba(139, 0, 0, 0.8);">
            <div class="card-body text-center text-white py-5 px-4">
                <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">
                    Ready to Join Our Business Community?
                </h2>
                <p class="mx-auto mb-4" style="max-width: 700px; font-size: 1.05rem; opacity: 0.95; line-height: 1.7;">
                    Take the first step towards growing your business with PCCI New Marikina. Join hundreds of successful businesses that are part of our thriving community.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ url('/membership') }}" class="btn btn-light fw-bold px-5 py-3" style="border-radius: 8px; color: #B91C1C;">
                        Apply for Membership
                    </a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-light fw-bold px-5 py-3" style="border-radius: 8px; border-width: 2px;">
                        Learn More About Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="py-5 text-white" style="background-color: #7F1D1D;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: white; border-radius: 10px;">
                        <svg class="text-danger" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">PCCI - Valenzuela</h5>
                        <small style="opacity: 0.9;">Philippine Chamber of Commerce</small>
                    </div>
                </div>
                <p class="mb-4" style="opacity: 0.9; line-height: 1.7; font-size: 0.95rem;">
                    Empowering local businesses and fostering economic growth in Marikina City through collaboration, networking, and advocacy. Building the future of businesses in our community.
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light btn-sm" style="width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <h6 class="fw-bold mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url('/') }}" class="text-white text-decoration-none" style="opacity: 0.9;">Home</a></li>
                    <li class="mb-2"><a href="{{ url('/about') }}" class="text-white text-decoration-none" style="opacity: 0.9;">About Us</a></li>
                    <li class="mb-2"><a href="{{ url('/membership') }}" class="text-white text-decoration-none" style="opacity: 0.9;">Membership</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none" style="opacity: 0.9;">Business Directory</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none" style="opacity: 0.9;">Chamber Events</a></li>
                    <li class="mb-2"><a href="{{ url('/contact') }}" class="text-white text-decoration-none" style="opacity: 0.9;">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-6 col-md-8">
                <h6 class="fw-bold mb-3">Contact Information</h6>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start gap-2">
                        <svg class="mt-1 flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span style="opacity: 0.9;">4th Floor, Legislative Bldg. Valenzuela City Hall, MacArthur Highway 1600 Philippines</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span style="opacity: 0.9;">09505085085505095</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span style="opacity: 0.9;">support@tfcresua.tech</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span style="opacity: 0.9;">pcci-valenzuela.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4" style="opacity: 0.3;">

        <div class="text-center" style="opacity: 0.8; font-size: 0.9rem;">
            <p class="mb-0">© YYYY - 2026 PCCI - Valenzuela. All rights reserved. | Philippine Chamber of Commerce and Industry - Valenzuela Chapter</p>
            <p class="mb-0 mt-2">Fostering economic growth and business excellence in Valenzuela City since YYYY</p>
        </div>
    </div>
</footer>
@endsection