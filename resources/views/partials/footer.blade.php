{{-- resources/views/partials/footer.blade.php --}}
<footer class="py-5 text-white" style="background-color: #1f1f1f;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="logo-box flex-shrink-0 rounded-circle">
                        <img 
                            src="{{ asset('images/PCCI-Logo.svg') }}" 
                            alt="PCCI Logo"
                            width="50"
                            height="50"
                            style="object-fit: contain; display: block;"
                        >
                    </div>
                    <h5 class="fw-bold mb-0">PCCI Valenzuela</h5>
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
                        <span style="opacity: 0.9;">4th Floor, Legislative Bldg, Valenzuela City Hall, MacArthur Highway 1800 Philippines</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span style="opacity: 0.9;">09822658382</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span style="opacity: 0.9;">support@nfcnexus.tech</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                        <span style="opacity: 0.9;">pcci-valenzuela.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4" style="opacity: 0.2;">
        
        <div class="text-center" style="opacity: 0.7;">
            <p class="mb-0 small">&copy; © -  {{ date('Y') }} Valenzuela. All rights reserved. | Philippine Chamber of Commerce and Industry - Valenzuela Chapter <br>
                                        Fostering economic growth and business excellence in Valenzuela City since YYYY</p>
        </div>
    </div>
</footer>