<header class="header-custom w-100 px-4 py-3 {{ (Request::is('membership') || Request::is('business/*')) ? 'fixed-top' : 'sticky-top' }}" 
        style="background-color: {{ (Request::is('membership') || Request::is('business/*')) ? 'transparent' : '#A40D0F99' }}; transition: background-color 0.3s ease;">
    <nav class="navbar navbar-expand-xl w-100 p-0">
        
            <a href="{{ url('/') }}" class="d-flex align-items-center gap-3 text-decoration-none text-reset me-auto">
                <div class="logo-box flex-shrink-0 rounded-circle">
                    <img 
                        src="{{ asset('images/PCCI-Logo.svg') }}" 
                        alt="PCCI Logo"
                        width="50"
                        height="50"
                        style="object-fit: contain; display: block;"
                    >
                </div>

            <div class="d-flex flex-column brand-text">
                <span class="brand-title"
                    style="color: {{ (Request::is('membership') || Request::is('business/*')) ? '#fff' : '#1b1b18' }};">
                    PCCI - Valenzuela
                </span>

                <span class="brand-subtitle d-none d-sm-block"
                    style="color: {{ (Request::is('membership') || Request::is('business/*')) ? 'rgba(255,255,255,0.8)' : '#6c757d' }};">
                    Philippine Chambers of Commerce and Industry
                </span>
            </div>
        </a>


        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <div class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center ms-auto gap-2 gap-xl-1 mt-3 mt-xl-0">
                <a href="{{ url('/') }}" class="btn-ghost-custom w-100 w-xl-auto 
                    {{ Request::is('/') ? 'fw-bold text-dark' : '' }} 
                    {{ (Request::is('membership') || Request::is('business/*')) ? 'text-white' : '' }}">
                    Home
                </a>
                <a href="{{ route('about') }}" class="btn-ghost-custom w-100 w-xl-auto 
                    {{ (Request::is('membership') || Request::is('business/*')) ? 'text-white' : '' }}">
                    About Us
                </a>
                <a href="{{ url('/membership') }}" class="btn-ghost-custom w-100 w-xl-auto 
                    {{ Request::is('membership') ? 'fw-bold text-white' : '' }} 
                    {{ Request::is('business/*') ? 'text-white' : '' }}">
                    Membership
                </a>
                <a href="#" class="btn-ghost-custom w-100 w-xl-auto 
                    {{ (Request::is('membership') || Request::is('business/*')) ? 'text-white' : '' }}">
                    Business Directory
                </a>
                <a href="{{ url('/contact') }}" class="btn-ghost-custom w-100 w-xl-auto 
                    {{ Request::is('contact') ? 'fw-bold text-dark' : '' }} 
                    {{ (Request::is('membership') || Request::is('business/*')) ? 'text-white' : '' }}">
                    Contact Us
                </a>
            </div>

            <div class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center gap-2 ms-xl-2 mt-2 mt-xl-0">
                
                <a href="{{ url('/membership') }}" class="btn-primary-custom w-100 w-xl-auto text-center text-nowrap">Join PCCI</a>

                @if (Route::has('login'))
                    <div class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center gap-2 border-start-xl ps-xl-3 ms-xl-1 w-100 w-xl-auto" style="border-color: rgba(0,0,0,0.1) !important;">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-outline-custom w-100 w-xl-auto text-center text-nowrap {{ (Request::is('membership') || Request::is('business/*')) ? 'text-white border-white' : '' }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-ghost-custom w-100 w-xl-auto text-center text-nowrap {{ (Request::is('membership') || Request::is('business/*')) ? 'text-white' : '' }}">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-outline-custom w-100 w-xl-auto text-center text-nowrap {{ (Request::is('membership') || Request::is('business/*')) ? 'text-white border-white' : '' }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

        </div>
    </nav>
</header>
