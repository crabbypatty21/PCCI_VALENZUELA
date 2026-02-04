{{-- resources/views/partials/footer.blade.php --}}
<footer class="py-5 text-white" style="background-color: #AC1D32;">
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
                    <h5 class="fw-bold mb-0" style="font-family: 'Poppins', sans-serif;">PCCI Valenzuela</h5>
                </div>
                <p class="mb-4" style="font-family: 'DM Sans', sans-serif; opacity: 0.9; line-height: 1.7; font-size: 0.95rem;">
                    Empowering local businesses and fostering economic growth in Marikina City through collaboration, networking, and advocacy. Building the future of businesses in our community.
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light btn-sm d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 8px;">
                        <i class="bi bi-facebook" style="font-size: 1.1rem; color: #AC1D32;"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <h6 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">Quick Links</h6>
                <ul class="list-unstyled" style="font-family: 'DM Sans', sans-serif;">
                    <li class="mb-2"><a href="{{ url('/') }}" class="text-white text-decoration-none" style="opacity: 0.9;">Home</a></li>
                    <li class="mb-2"><a href="{{ url('/about') }}" class="text-white text-decoration-none" style="opacity: 0.9;">About Us</a></li>
                    <li class="mb-2"><a href="{{ url('/membership') }}" class="text-white text-decoration-none" style="opacity: 0.9;">Membership</a></li>
                    <li class="mb-2"><a href="{{ url('/contact') }}" class="text-white text-decoration-none" style="opacity: 0.9;">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-6 col-md-8">
                <h6 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">Contact Information</h6>
                <ul class="list-unstyled" style="font-family: 'DM Sans', sans-serif;">
                    <li class="mb-3 d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill mt-1 flex-shrink-0" style="font-size: 1.1rem;"></i>
                        <span style="opacity: 0.9;">4th Floor, Legislative Bldg, Valenzuela City Hall, MacArthur Highway 1800 Philippines</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill flex-shrink-0" style="font-size: 1.1rem;"></i>
                        <span style="opacity: 0.9;">09822658382</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill flex-shrink-0" style="font-size: 1.1rem;"></i>
                        <span style="opacity: 0.9;">support@nfcnexus.tech</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-globe flex-shrink-0" style="font-size: 1.1rem;"></i>
                        <span style="opacity: 0.9;">pcci-valenzuela.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4" style="opacity: 0.2;">
        
        <div class="text-center" style="font-family: 'DM Sans', sans-serif; opacity: 0.7;">
            <p class="mb-0 small">&copy; {{ date('Y') }} Valenzuela. All rights reserved. | Philippine Chamber of Commerce and Industry - Valenzuela Chapter <br>
                                            Fostering economic growth and business excellence in Valenzuela City since YYYY</p>
        </div>
    </div>
</footer>