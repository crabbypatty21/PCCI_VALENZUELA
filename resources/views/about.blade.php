@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<div class="position-relative w-100 overflow-hidden" style="background: linear-gradient(135deg, rgba(245, 48, 3, 0.9), rgba(200, 35, 0, 0.9)), url('https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2069') center/cover; min-height: 500px;">
    <div class="container text-white text-center py-5" style="position: relative; z-index: 2;">
        <p class="text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.1em; opacity: 0.95;">
            JOIN PCCI - VALENZUELA
        </p>
        <h1 class="display-4 fw-bold mb-4" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1.2;">
            Empowering Valenzuela's Future, Together.
        </h1>
        <p class="mx-auto mb-5" style="max-width: 800px; font-size: 1.1rem; line-height: 1.7; opacity: 0.95;">
            PCCI New Marikina is the vibrant heart of our city's business ecosystem. We are passionately committed to fostering economic growth, driving innovation, and building a resilient community where every enterprise can flourish.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#membership" class="btn btn-light fw-bold px-4 py-2" style="border-radius: 6px; text-decoration: none; color: #F53003;">
                Become a Member
            </a>
            <a href="#impact" class="btn btn-outline-light fw-bold px-4 py-2" style="border-radius: 6px; text-decoration: none;">
                Discover our Impact
            </a>
        </div>
    </div>
</div>

{{-- Our Purpose Section --}}
<div class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h6 class="text-accent fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.05em;">OUR PURPOSE</h6>
                <h2 class="fw-bold mb-4" style="font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.3;">
                    Guiding Principles for a Thriving Valenzuela.
                </h2>
                
                <div class="mb-4">
                    <h5 class="text-accent fw-bold mb-3">Our Mission</h5>
                    <p style="line-height: 1.8; color: #4a4a4a;">
                        To champion the growth and success of Marikina businesses through robust advocacy, impactful networking, comprehensive development programs, and dedicated community engagement.
                    </p>
                </div>

                <div class="mb-5">
                    <h5 class="text-accent fw-bold mb-3">Our Vision</h5>
                    <p style="line-height: 1.8; color: #4a4a4a;">
                        To be the leading catalyst for a vibrant, innovative, and sustainable business environment in Marikina City, recognized for driving economic prosperity and community well-being.
                    </p>
                </div>

                <div class="p-4 mb-4" style="background-color: #ffe5e0; border-radius: 8px; border-left: 4px solid #F53003;">
                    <p class="fst-italic mb-3" style="line-height: 1.8; color: #2c2c2c; font-size: 1.05rem;">
                        "Together, we are forging a resilient and dynamic future for Valenzuela. Our Chamber is committed to empowering every member to reach their full potential and contribute to our city's collective success."
                    </p>
                    <p class="text-accent fw-bold mb-0">– Mr. Jundio Salvador, President</p>
                </div>

                <a href="#leadership" class="btn btn-danger fw-bold px-4 py-2 d-inline-flex align-items-center gap-2" style="background-color: #F53003; border: none; border-radius: 6px;">
                    Meet Our Leadership
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1000" 
                         alt="President" 
                         class="img-fluid rounded shadow-lg"
                         style="border-radius: 12px !important; border: 8px solid white;">
                    <div class="position-absolute bottom-0 start-0 p-4 text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); width: 100%; border-radius: 0 0 12px 12px;">
                        <h5 class="fw-bold mb-0">Mr. Jundio Salvador</h5>
                        <p class="mb-0" style="opacity: 0.9;">President, PCCI Valenzuela</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- The PCCI Advantage Section --}}
<div class="py-5" style="background-color: #B91C1C;">
    <div class="container text-white">
        <div class="text-center mb-5">
            <p class="text-uppercase fw-bold mb-2" style="font-size: 0.9rem; letter-spacing: 0.1em; opacity: 0.9;">The PCCI Advantage</p>
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">Your Partner Growth & Success</h2>
            <p class="mx-auto" style="max-width: 800px; font-size: 1.05rem; opacity: 0.95;">
                Joining PCCI New Marikina unlocks a wealth of opportunities and resources tailored to elevate your business.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @foreach([
                [
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                    'title' => 'Connect & Collaborate',
                    'desc' => 'Unlock unparalleled networking opportunities. We foster a dynamic ecosystem where businesses connect, share insights, and forge powerful collaborations that drive mutual growth.'
                ],
                [
                    'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
                    'title' => 'Advocate and Represent',
                    'desc' => 'Your voice, amplified. We champion the interests of Marikina\'s businesses, ensuring your concerns are heard and addressed at key policy-making levels.'
                ],
                [
                    'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                    'title' => 'Develop and Innovate',
                    'desc' => 'Stay ahead of the curve. Gain access to cutting-edge training, workshops, and resources designed to enhance your operations, embrace innovation, and achieve new heights.'
                ],
                [
                    'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                    'title' => 'Strengthen our Community',
                    'desc' => 'More than just business. We actively invest in Marikina\'s future through community-focused programs and initiatives that promote social responsibility and shared prosperity.'
                ],
            ] as $advantage)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 text-center p-4" style="border-radius: 12px; background-color: white;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #FEE2E2; border-radius: 12px;">
                        <svg class="text-danger" width="30" height="30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $advantage['icon'] }}"></path>
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: #1f1f1f;">{{ $advantage['title'] }}</h5>
                    <p class="text-secondary mb-0 small" style="line-height: 1.6;">{{ $advantage['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="#events" class="btn btn-light fw-bold px-4 py-2 d-inline-flex align-items-center gap-2" style="border-radius: 6px; color: #1f1f1f;">
                Explore our Events
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

{{-- Our Values Section --}}
<div class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-accent fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.05em;">Our Values</h6>
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">The Foundation of Our Commitment.</h2>
            <p class="text-secondary mx-auto" style="max-width: 800px;">
                These principles are woven into every action we take and every service we provide.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                [
                    'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                    'title' => 'Discipline',
                    'desc' => 'Unlock unparalleled networking opportunities. We foster a dynamic ecosystem where businesses connect, share insights, and forge powerful collaborations that drive mutual growth.'
                ],
                [
                    'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'title' => 'Good Taste',
                    'desc' => 'Fostering a community that values quality, aesthetics, and thoughtful execution.'
                ],
                [
                    'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                    'title' => 'Excellence',
                    'desc' => 'Striving for the highest standards in all our endeavors and initiatives.'
                ],
            ] as $value)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 text-center text-white p-4" style="border-radius: 16px; background-color: #B91C1C;">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(255,255,255,0.2); border-radius: 12px;">
                        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $value['icon'] }}"></path>
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-3">{{ $value['title'] }}</h5>
                    <p class="mb-0 small" style="line-height: 1.6; opacity: 0.95;">{{ $value['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Our Impact Section --}}
<div class="py-5" style="background-color: #B91C1C;" id="impact">
    <div class="container text-white">
        <div class="text-center mb-5">
            <h6 class="text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.1em; opacity: 0.9;">Our Impact</h6>
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">Building a Stronger Valenzuela, One Business at a Time.</h2>
            <p class="mx-auto" style="max-width: 800px; font-size: 1.05rem; opacity: 0.95;">
                We measure our success by the tangible growth and prosperity of our members and the broader Marikina community.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @foreach([
                ['number' => '100+', 'label' => 'Active Members', 'desc' => 'A growing network of diverse businesses', 'highlight' => true],
                ['number' => '32+', 'label' => 'Years of Service', 'desc' => 'Dedicated to Marikina\'s economic progress', 'highlight' => false],
                ['number' => '200+', 'label' => 'Events Hosted', 'desc' => 'Fostering connections and knowledge sharing', 'highlight' => false],
                ['number' => '₱500M+', 'label' => 'Business Facilitated', 'desc' => 'Fueling member collaborations and growth', 'highlight' => false],
            ] as $stat)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 text-center p-4" style="border-radius: 12px; background-color: {{ $stat['highlight'] ? '#FCA5A5' : 'white' }};">
                    <h2 class="fw-bold mb-2" style="font-size: 2.5rem; color: {{ $stat['highlight'] ? '#7F1D1D' : '#1f1f1f' }};">{{ $stat['number'] }}</h2>
                    <h6 class="fw-bold mb-2" style="color: {{ $stat['highlight'] ? '#7F1D1D' : '#1f1f1f' }};">{{ $stat['label'] }}</h6>
                    <p class="mb-0 small" style="color: {{ $stat['highlight'] ? '#7F1D1D' : '#6b7280' }};">{{ $stat['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Community Gallery Section --}}
<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem);">Glimpses of our Community in Action</h2>
        </div>

        <div class="row g-4 mb-4">
            @for($i = 1; $i <= 6; $i++)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=800&h=600&fit=crop" 
                         alt="Community Event {{ $i }}" 
                         class="img-fluid"
                         style="height: 300px; object-fit: cover;">
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

{{-- Final CTA Section --}}
<div class="py-5 bg-white">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 2.5rem); color: #1f1f1f;">
            Be Part of our Valenzuela's Business Renaissance.
        </h2>
        <p class="text-secondary mx-auto mb-5" style="max-width: 800px; font-size: 1.05rem; line-height: 1.7;">
            PCCI Valenzuela is more than a chamber; it's a community dedicated to fostering a vibrant, sustainable, and inclusive business environment. Invest in your future and the future of Valenzuela.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ url('/membership') }}" class="btn fw-bold px-5 py-3 d-inline-flex align-items-center gap-2" style="background-color: #B91C1C; color: white; border: none; border-radius: 6px;">
                Become a Member Today
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <a href="#" class="btn btn-outline-dark fw-bold px-5 py-3" style="border-radius: 6px; border-width: 2px;">
                Get in Touch
            </a>
        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="py-5 text-white" style="background-color: #B91C1C;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: white; border-radius: 10px;">
                        <svg class="text-danger" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">PCCI - Valenzuela</h5>
                        <small style="opacity: 0.9;">Philippine Chamber of Commerce</small>
                    </div>
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
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none" style="opacity: 0.9;">Business Directory</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none" style="opacity: 0.9;">Chamber Events</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none" style="opacity: 0.9;">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-lg-6 col-md-8">
                <h6 class="fw-bold mb-3">Contact Information</h6>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start gap-2">
                        <svg class="mt-1" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span style="opacity: 0.9;">4th Floor, Legislative Bldg. Valenzuela City Hall,<br>MacArthur Highway, Valenzuela City, Philippines</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span style="opacity: 0.9;">09505085085505095</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span style="opacity: 0.9;">support@tfcresua.tech</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span style="opacity: 0.9;">pcci-valenzuela.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4" style="opacity: 0.3;">

        <div class="text-center" style="opacity: 0.8; font-size: 0.9rem;">
            <p class="mb-0">© YYYY - 2026 PCCI - Valenzuela. All rights reserved. | Philippine Chamber of Commerce and Industry - Valenzuela Chapter</p>
            <p class="mb-0 mt-2">Fostering economic growth and business excellence in Valenzuela City since YYYY</p>
        </div>
    </div>
</footer>
@endsection