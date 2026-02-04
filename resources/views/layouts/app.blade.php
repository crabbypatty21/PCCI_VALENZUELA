<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PCCI Valenzuela</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&family=dm-sans:400,500,600,700" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #FDFDFC;
                color: #1b1b18;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                margin: 0;
            }

            /* --- DM Sans for Titles and Buttons --- */
            h1, h2, h3, h4, h5, h6,
            .headline-text,
            .brand-title,
            .btn-primary-custom,
            .btn-outline-custom,
            .btn-ghost-custom {
                font-family: 'DM Sans', sans-serif;
            }

            /* --- Custom Header Styles --- */
            .header-custom {
                backdrop-filter: blur(4px);
                z-index: 1000;
                transition: all 0.3s ease;
            }

            /* --- Logo & Title Styles --- */
            .logo-box {
                width: 40px;
                height: 40px;
                background-color: #ffffff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            }

            .brand-text {
                line-height: 1.1;
            }
            .brand-title {
                font-weight: 600;
                font-size: 1.1rem;
                letter-spacing: -0.02em;
                color: #1b1b18;
            }
            .brand-subtitle {
                font-size: 0.75rem;
                color: #6c757d;
                font-weight: 500;
                white-space: nowrap;
            }

            /* --- Navigation Links --- */
            .btn-ghost-custom {
                color: #4a4a4a;
                padding: 0.5rem 0.85rem;
                font-size: 0.875rem;
                font-weight: 500;
                text-decoration: none;
                border-radius: 6px;
                transition: all 0.2s ease;
                white-space: nowrap;
            }
            .btn-ghost-custom:hover {
                color: #000;
                background-color: rgba(0,0,0,0.04);
            }

            /* --- Buttons --- */
            .btn-outline-custom {
                color: #1b1b18;
                border: 1px solid rgba(0, 0, 0, 0.15);
                padding: 0.5rem 1.25rem;
                font-size: 0.9rem;
                font-weight: 500;
                text-decoration: none;
                border-radius: 6px;
                transition: all 0.2s;
                white-space: nowrap;
            }
            .btn-outline-custom:hover {
                border-color: #000;
                background-color: #fff;
            }

            .btn-primary-custom {
                background-color: #A40033;
                border: 1px solid #A40033;
                color: white;
                padding: 0.5rem 1.25rem;
                font-size: 0.9rem;
                font-weight: 500;
                text-decoration: none;
                border-radius: 6px;
                transition: all 0.2s;
                white-space: nowrap;
            }
            .btn-primary-custom:hover {
                background-color: #8a002b;
            }

            /* --- Dark Mode Styles --- */
            @media (prefers-color-scheme: dark) {
                body {
                    background-color: #0a0a0a;
                    color: #EDEDEC;
                }
                .header-custom {
                    border-color: #3E3E3A !important;
                }
                .logo-box {
                    background-color: #161615;
                    border-color: #3E3E3A;
                }
                .brand-title { color: #EDEDEC; }
                .brand-subtitle { color: #A1A09A; }
                
                .btn-ghost-custom { color: #A1A09A; }
                .btn-ghost-custom:hover { color: #EDEDEC; background-color: rgba(255,255,255,0.05); }

                .btn-outline-custom {
                    color: #EDEDEC;
                    border-color: #3E3E3A;
                }
                .btn-outline-custom:hover {
                    border-color: #62605b;
                    background-color: transparent;
                }
            }

            /* --- Layout --- */
            .text-accent { color: #A40033; }
            @media (prefers-color-scheme: dark) { .text-accent { color: #A40033; } }
            
            /* Responsive Font Sizes */
            .headline-text {
                font-size: 2rem;
                line-height: 1.2;
            }
            @media (min-width: 768px) {
                .headline-text {
                    font-size: 2.75rem;
                }
            }

            .content-spacer { 
                margin-top: 0; 
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            /* --- Impact Cards --- */
            .impact-card {
                background-color: #A40033;
                border-radius: 8px;
                padding: 8px;
            }

            .impact-card-inner {
                background-color: #C4909D;
                border-radius: 4px;
                padding: 2rem;
                text-align: center;
            }

            .impact-number {
                font-family: 'DM Sans', sans-serif;
                font-size: 3rem;
                font-weight: 700;
                color: #D4E157;
                margin-bottom: 0;
                line-height: 1;
            }

            .impact-label {
                font-family: 'DM Sans', sans-serif;
                font-size: 1.1rem;
                font-weight: 600;
                color: #D4E157;
                margin-bottom: 0.75rem;
            }

            .impact-desc {
                font-family: 'Poppins', sans-serif;
                color: #4a3a3f;
                font-size: 0.95rem;
                margin-bottom: 0;
            }

            /* ============================================== */
            /* COMMUNITY CAROUSEL STYLES - START */
            /* ============================================== */
            
            .community-carousel-section {
                background-color: #fdf2f4;
                padding: 60px 0;
            }

            .community-carousel-wrapper {
                position: relative;
                max-width: 1000px;
                margin: 0 auto;
                padding: 0 60px;
            }

            /* The slides container */
            .carousel-inner {
                overflow: visible !important;
            }

            /* Each slide */
            .community-slide {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px;
                padding: 20px 0;
            }

            /* Individual image cards */
            .slide-image-wrapper {
                position: relative;
                transition: all 0.5s ease;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            }

            .slide-image-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            /* Center image - larger */
            .slide-image-wrapper.center {
                width: 420px;
                height: 300px;
                z-index: 10;
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            }

            /* Side images - smaller and faded */
            .slide-image-wrapper.side {
                width: 200px;
                height: 250px;
                opacity: 0.6;
                filter: brightness(0.85);
            }

            /* Navigation Arrows */
            .carousel-control-prev,
            .carousel-control-next {
                width: 50px;
                height: 50px;
                background: white;
                border-radius: 50%;
                top: 50%;
                transform: translateY(-50%);
                opacity: 1;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .carousel-control-prev {
                left: 0;
            }

            .carousel-control-next {
                right: 0;
            }

            .carousel-control-prev:hover,
            .carousel-control-next:hover {
                background: #A40033;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                width: 20px;
                height: 20px;
                filter: invert(1) grayscale(100) brightness(0);
            }

            .carousel-control-prev:hover .carousel-control-prev-icon,
            .carousel-control-next:hover .carousel-control-next-icon {
                filter: invert(1) grayscale(100) brightness(100);
            }

            /* Pagination Dots */
            .carousel-indicators {
                bottom: -40px;
            }

            .carousel-indicators [data-bs-target] {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: #ccc;
                border: none;
                opacity: 1;
                margin: 0 5px;
                transition: all 0.3s ease;
            }

            .carousel-indicators .active {
                background-color: #333;
                transform: scale(1.2);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .community-carousel-wrapper {
                    padding: 0 40px;
                }
                
                .slide-image-wrapper.center {
                    width: 280px;
                    height: 200px;
                }
                
                .slide-image-wrapper.side {
                    width: 120px;
                    height: 160px;
                }
            }

            @media (max-width: 576px) {
                .community-carousel-wrapper {
                    padding: 0 30px;
                }
                
                .slide-image-wrapper.side {
                    display: none;
                }
                
                .slide-image-wrapper.center {
                    width: 100%;
                    max-width: 320px;
                    height: 220px;
                }
            }

            /* ============================================== */
            /* COMMUNITY CAROUSEL STYLES - END */
            /* ============================================== */
        </style>
    </head>
    <body>

        @include('partials.topbar')

        <div class="content-spacer w-100 mb-5">
            @yield('content')
        </div>

        {{-- Add this line here --}}
        @include('partials.footer')
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

    </body>
</html>
