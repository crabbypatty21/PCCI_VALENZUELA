{{-- Responsive Footer --}}
<footer class="footer" style="background-color: #1a1a2e; padding: 4rem 0 2rem; color: #ffffff;">
    <div class="container px-4">
        <div class="row g-4 g-lg-5">
            {{-- Brand Column --}}
            <div class="col-12 col-lg-4 col-md-12 text-center text-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 mb-3">
                    <div class="d-flex align-items-center justify-content-center rounded" style="width: 45px; height: 45px; background-color: #A40033;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="white">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h4 class="fw-bold mb-0 text-white" style="font-family: 'Poppins', sans-serif;">PCCI Valenzuela</h4>
                </div>
                <p class="mb-4 mx-auto mx-md-0" style="font-family: 'DM Sans', sans-serif; opacity: 0.85; line-height: 1.7; font-size: 0.95rem; max-width: 400px;">
                    Empowering local businesses and fostering economic growth in Valenzuela City through collaboration, networking, and advocacy. Building the future of businesses in our community.
                </p>
                <div class="d-flex justify-content-center justify-content-md-start gap-2">
                    <a href="#" class="btn btn-light d-flex align-items-center justify-content-center footer-social-btn">
                        <i class="bi bi-facebook" style="font-size: 1.2rem; color: #A40033;"></i>
                    </a>
                    <a href="#" class="d-flex align-items-center justify-content-center rounded-circle footer-social-btn text-white">
                        <i class="bi bi-twitter-x" style="font-size: 1.1rem;"></i>
                    </a>
                    <a href="#" class="d-flex align-items-center justify-content-center rounded-circle footer-social-btn text-white">
                        <i class="bi bi-linkedin" style="font-size: 1.1rem;"></i>
                    </a>
                    <a href="#" class="d-flex align-items-center justify-content-center rounded-circle footer-social-btn text-white">
                        <i class="bi bi-instagram" style="font-size: 1.1rem;"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-6 col-lg-2 col-md-4">
                <h6 class="fw-bold mb-4 text-white text-uppercase" style="font-family: 'Poppins', sans-serif; letter-spacing: 1px;">Quick Links</h6>
                <ul class="list-unstyled" style="font-family: 'DM Sans', sans-serif;">
                    <li class="mb-3"><a href="{{ url('/') }}" class="text-white text-decoration-none footer-link">Home</a></li>
                    <li class="mb-3"><a href="{{ url('/about') }}" class="text-white text-decoration-none footer-link">About Us</a></li>
                    <li class="mb-3"><a href="{{ url('/membership') }}" class="text-white text-decoration-none footer-link">Membership</a></li>
                    <li class="mb-3"><a href="{{ url('/contact') }}" class="text-white text-decoration-none footer-link">Contact Us</a></li>
                </ul>
            </div>

            {{-- Contact Information --}}
            <div class="col-12 col-lg-6 col-md-8">
                <h6 class="fw-bold mb-4 text-white text-uppercase text-center text-md-start" style="font-family: 'Poppins', sans-serif; letter-spacing: 1px;">Contact Information</h6>
                <ul class="list-unstyled" style="font-family: 'DM Sans', sans-serif;">
                    <li class="mb-3 d-flex align-items-start gap-3 justify-content-center justify-content-md-start">
                        <i class="bi bi-geo-alt-fill mt-1 flex-shrink-0 text-danger" style="font-size: 1.2rem;"></i>
                        <span class="text-white text-center text-md-start" style="opacity: 0.85; max-width: 300px;">4th Floor, Legislative Bldg, Valenzuela City Hall, MacArthur Highway 1800 Philippines</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-3 justify-content-center justify-content-md-start">
                        <i class="bi bi-telephone-fill flex-shrink-0 text-danger" style="font-size: 1.2rem;"></i>
                        <span class="text-white" style="opacity: 0.85;">0982 265 8382</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-3 justify-content-center justify-content-md-start">
                        <i class="bi bi-envelope-fill flex-shrink-0 text-danger" style="font-size: 1.2rem;"></i>
                        <span class="text-white" style="opacity: 0.85;">support@nfcnexus.tech</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-3 justify-content-center justify-content-md-start">
                        <i class="bi bi-globe flex-shrink-0 text-danger" style="font-size: 1.2rem;"></i>
                        <span class="text-white" style="opacity: 0.85;">pcci-valenzuela.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom text-center mt-5 pt-4 border-top" style="border-color: rgba(255,255,255,0.1) !important; font-family: 'DM Sans', sans-serif; opacity: 0.6;">
            <p class="mb-1 small text-white">&copy; {{ date('Y') }} Philippine Chamber of Commerce and Industry - Valenzuela Chapter. All rights reserved.</p>
            <p class="mb-0 small text-white">Fostering economic growth and business excellence in Valenzuela City.</p>
        </div>
    </div>
</footer>

<style>
    /* Footer Interactive Styles */
    .footer-link {
        opacity: 0.85;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
    }
    
    .footer-link:hover {
        opacity: 1;
        color: #A40033 !important;
        transform: translateX(5px);
    }

    .footer-social-btn {
        width: 42px;
        height: 42px;
        background-color: rgba(255,255,255,0.05);
        transition: all 0.3s ease;
    }

    .footer-social-btn:hover {
        background-color: #A40033 !important;
        color: #ffffff !important;
        transform: translateY(-3px);
    }
</style>