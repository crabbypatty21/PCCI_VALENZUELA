<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PCCI Valenzuela</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&family=dm-sans:400,500,600,700" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                /* Background is handled inline or via utility now for transparency */
                backdrop-filter: blur(4px); /* Reduced blur for clearer image visibility */
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

            /* --- Navigation Links (Updated) --- */
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

            /* --- Buttons (Updated) --- */
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
                /* Removed margin-top to allow content to sit behind fixed header */
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
        </style>
    </head>
    <body>

        @include('partials.topbar')

        <div class="content-spacer w-100 mb-5">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>