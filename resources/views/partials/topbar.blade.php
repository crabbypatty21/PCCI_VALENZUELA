<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

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
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            
            <div class="d-flex flex-column flex-xl-row align-items-xl-center mx-auto gap-3 mt-3 mt-xl-0" style="font-family: 'DM Sans', sans-serif;">
                
                <a href="{{ url('/') }}" class="text-decoration-none px-2 {{ Request::is('/') ? 'fw-bold text-dark' : 'text-white' }}">
                    Home
                </a>
                
                <a href="{{ route('about') }}" class="text-decoration-none px-2 {{ Request::is('about') ? 'fw-bold text-dark' : 'text-white' }}">
                    About Us
                </a>
                
                {{-- UPDATED: Link remains 'text-dark' (Black) on business profile pages --}}
                <a href="{{ url('/membership') }}" class="text-decoration-none px-2 {{ (Request::is('membership') || Request::is('business/*')) ? 'fw-bold text-dark' : 'text-white' }}">
                    Membership
                </a>
                
                <a href="{{ route('event') }}" class="text-decoration-none px-2 {{ Request::is('event') ? 'fw-bold text-dark' : 'text-white' }}">
                    Events
                </a>
                
                <a href="{{ url('/contact') }}" class="text-decoration-none px-2 {{ Request::is('contact') ? 'fw-bold text-dark' : 'text-white' }}">
                    Contact Us
                </a>
            </div>

            <div class="d-flex flex-column flex-xl-row align-items-xl-center gap-2 mt-3 mt-xl-0" style="font-family: 'DM Sans', sans-serif;">
                
                <a href="{{ url('/membership') }}" 
                   id="join-pcci-btn"
                   class="btn btn-danger text-nowrap rounded-2 px-4"
                   style="background-color: #A40D0F; border-color: #A40D0F; transition: all 0.3s ease;">
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

        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) {
                // --- SCROLLED STATE ---
                // Navbar: Red with 0.9 Opacity
                topbar.style.backgroundColor = "rgba(164, 13, 15, 0.9)";
                topbar.classList.add("shadow-sm");

                // Button: White BG, Red Text
                if (joinBtn) {
                    joinBtn.style.backgroundColor = "#ffffff";
                    joinBtn.style.borderColor = "#ffffff";
                    joinBtn.style.color = "#A40D0F"; 
                }

            } else {
                // --- TOP STATE (DEFAULT) ---
                // Navbar: Transparent
                topbar.style.backgroundColor = "transparent";
                topbar.classList.remove("shadow-sm");

                // Button: Red BG, White Text
                if (joinBtn) {
                    joinBtn.style.backgroundColor = "#A40D0F";
                    joinBtn.style.borderColor = "#A40D0F";
                    joinBtn.style.color = "#ffffff";
                }
            }
        });
    });
</script>