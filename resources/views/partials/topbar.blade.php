<nav class="navbar navbar-expand-lg fixed-top transition-all" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/PCCI-Logo.svg') }}" alt="PCCI Valenzuela" height="45" class="d-inline-block align-text-top me-2">
            <span class="fw-bold d-none d-sm-block" style="font-family: 'Poppins', sans-serif; color: var(--primary-red); letter-spacing: -0.5px;">
                PCCI <span class="text-dark">VALENZUELA</span>
            </span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3 active" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('membership') }}">Membership</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link px-3" href="{{ route('event') }}">Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a href="{{ route('membership') }}" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background-color: var(--primary-red); border: none;">
                        Join Now
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>