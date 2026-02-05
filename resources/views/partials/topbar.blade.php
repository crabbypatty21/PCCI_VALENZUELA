{{-- Responsive Navigation Bar --}}
<nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
    <div class="container">
        {{-- Logo/Brand --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <div class="d-flex align-items-center justify-content-center rounded" style="width: 40px; height: 40px; background-color: #A40033;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <span class="fw-bold">PCCI Valenzuela</span>
        </a>
        
        {{-- Mobile Toggle Button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        {{-- Navigation Links --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('membership') ? 'active' : '' }}" href="{{ route('membership') }}">Members</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('event') ? 'active' : '' }}" href="{{ route('event') }}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn px-4 py-2 fw-semibold" href="{{ route('login') }}" style="background-color: #A40033; color: white; border-radius: 6px;">
                        Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Additional Topbar Responsive Styles */
    .navbar .nav-link.active {
        color: #A40033 !important;
        font-weight: 600;
    }
    
    @media (max-width: 991.98px) {
        .navbar {
            background-color: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
        
        .navbar .navbar-brand {
            color: #1a1a2e !important;
        }
        
        .navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2826, 26, 46, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }
    }
    
    @media (max-width: 575.98px) {
        .navbar-brand span {
            font-size: 1.1rem;
        }
        
        .navbar-collapse .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>