<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    /* ============================================== */
    /* JOIN PCCI BUTTON ANIMATION (Solid Fill Slide)  */
    /* ============================================== */
    
    .btn-pcci-slide {
        position: relative;
        background-color: #A40D0F !important; 
        color: #ffffff;
        border: 2px solid #A40D0F;
        overflow: hidden; 
        z-index: 1;
        font-weight: 800 !important;

        /* Sliding White Fill */
        background-image: linear-gradient(to right, #ffffff, #ffffff);
        background-position: left center;
        background-size: 0% 100%; 
        background-repeat: no-repeat;
        
        transition: background-size 0.5s ease, color 0.5s ease, border-color 0.5s ease;
    }

    /* HOVER STATE */
    .btn-pcci-slide:hover {
        background-size: 100% 100%; 
        color: #A40D0F !important;   
        border-color: #ffffff;       
    }

    /* SCROLLED STATE */
    .btn-pcci-slide.scrolled-mode {
        background-color: #ffffff !important;
        color: #A40D0F !important;
        border-color: #ffffff !important;
        background-image: none; 
    }

    .btn-pcci-slide.scrolled-mode:hover {
        background-color: #f2f2f2 !important; 
    }

    .btn-pcci-slide:focus, .btn-pcci-slide:active {
        box-shadow: none !important;
        outline: none !important;
    }

    /* ============================================== */
    /* NAVIGATION LINKS STYLING                       */
    /* ============================================== */
    
    .nav-link-custom {
        font-weight: 600 !important;
        transition: opacity 0.3s ease;
    }
    
    /* Hover effect for inactive links */
    .nav-link-custom:hover {
        opacity: 0.8; 
    }

    /* ACTIVE STATE: White Underline (No Black Color) */
    .active-nav-underline {
        text-decoration: underline !important;
        text-decoration-color: #ffffff !important;
        text-decoration-thickness: 3px !important; /* Thicker line */
        text-underline-offset: 8px !important;     /* Push it down */
        opacity: 1 !important;
    }
</style>

<header id="main-topbar" 
        class="fixed-top w-100 px-4 py-3" 
        style="background-color: transparent; transition: background-color 0.3s ease;">
    
    <nav class="navbar navbar-expand-xl w-100 p-0">
        
        <a href="{{ url('/') }}" class="d-flex align-items-center gap-3 text-decoration-none text-reset">
            <div class="rounded-circle overflow-hidden" style="width: 50px; height: 50px;">
                <img src="{{ asset('images/PCCI-Logo.svg') }}" alt="PCCI Logo" class="w-100 h-100 object-fit-contain">
            </div>

            <div class="d-flex flex-column">
                <span class="fw-bold text-white" style="font-family: 'Poppins', sans-serif;">
                    PCCI - Valenzuela
                </span>
                <span class="d-none d-sm-block small text-white-50" style="font-family: 'DM Sans', sans-serif;">
                    Philippine Chambers of Commerce and Industry
                </span>
            </div>
            <span class="fw-bold d-xl-none text-white">PCCI Valenzuela</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            
            <div class="d-flex flex-column flex-xl-row align-items-xl-center mx-auto gap-3 mt-3 mt-xl-0" style="font-family: 'DM Sans', sans-serif;">
                
                {{-- 
                    UPDATED LINKS: 
                    1. Removed 'text-dark'.
                    2. Added 'text-white' to ALL links.
                    3. Condition adds 'active-nav-underline' class instead.
                --}}
                
                <a href="{{ url('/') }}" class="text-decoration-none px-2 nav-link-custom text-white {{ Request::is('/') ? 'active-nav-underline' : '' }}">
                    Home
                </a>
                
                <a href="{{ route('about') }}" class="text-decoration-none px-2 nav-link-custom text-white {{ Request::is('about') ? 'active-nav-underline' : '' }}">
                    About Us
                </a>
                
                <a href="{{ url('/membership') }}" class="text-decoration-none px-2 nav-link-custom text-white {{ (Request::is('membership') || Request::is('business/*')) ? 'active-nav-underline' : '' }}">
                    Membership
                </a>
                
                <a href="{{ route('event') }}" class="text-decoration-none px-2 nav-link-custom text-white {{ Request::is('event') ? 'active-nav-underline' : '' }}">
                    Events
                </a>
                
                <a href="{{ url('/contact') }}" class="text-decoration-none px-2 nav-link-custom text-white {{ Request::is('contact') ? 'active-nav-underline' : '' }}">
                    Contact Us
                </a>
            </div>

            <div class="d-flex flex-column flex-xl-row align-items-xl-center gap-2 mt-3 mt-xl-0" style="font-family: 'DM Sans', sans-serif;">
                
                <a href="{{ url('/membership') }}" 
                   id="join-pcci-btn"
                   class="btn btn-pcci-slide text-nowrap rounded-2 px-4">
                    Join PCCI
                </a>

                @if (Route::has('login'))
                    <div class="d-flex gap-2 ps-xl-3 border-start-xl" style="border-color: rgba(255,255,255,0.3) !important;">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="btn btn-outline-light rounded-pill px-4">
                                Dashboard
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="btn btn-outline-light rounded-pill px-4 text-nowrap">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

        </div>
    </nav>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const topbar = document.getElementById("main-topbar");
        const joinBtn = document.getElementById("join-pcci-btn");

        function handleScroll() {
            if (window.scrollY > 50) {
                topbar.style.backgroundColor = "rgba(164, 13, 15, 0.9)";
                topbar.classList.add("shadow-sm");
                if (joinBtn) joinBtn.classList.add("scrolled-mode");
            } else {
                topbar.style.backgroundColor = "transparent";
                topbar.classList.remove("shadow-sm");
                if (joinBtn) joinBtn.classList.remove("scrolled-mode");
            }
        }

        window.addEventListener("scroll", handleScroll);
        handleScroll(); 
    });
</script>