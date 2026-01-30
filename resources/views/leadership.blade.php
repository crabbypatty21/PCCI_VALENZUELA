@extends('layouts.app')

@section('content')
{{-- Hero Section --}}

<style>
    /* Card Container Animation */
    .officer-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgb(255, 0, 0); /* Subtle default shadow */
    }
    
    .officer-card:hover {
        transform: translateY(-10px); /* Lifts up */
        /* STRONG BACK SHADOW ON HOVER */
        box-shadow: 0 25px 50px -12px rgb(255, 0, 0) !important; 
    }

    /* Image Zoom Animation */
    .officer-card img {
        transition: transform 0.5s ease;
    }

    .officer-card:hover img {
        transform: scale(1.05); /* Slight zoom */
    }
</style>
<div class="position-relative w-100 overflow-hidden" style="background: linear-gradient(135deg, rgba(185, 28, 28, 0.95), rgba(245, 48, 3, 0.8)), url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2000') center/cover; min-height: 500px;">
    <div class="container text-white text-center py-5" style="position: relative; z-index: 2;">
        <p class="text-uppercase fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.1em; opacity: 0.95;">
            PCCI - VALENZUELA
        </p>
        <h1 class="display-4 fw-bold mb-4" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1.2;">
            Meet Our Leadership
        </h1>
        <p class="mx-auto" style="max-width: 800px; font-size: 1.1rem; line-height: 1.7; opacity: 0.95;">
            The dedicated visionaries and industry leaders driving economic growth and innovation in Valenzuela City.
        </p>
    </div>
</div>

{{-- President Spotlight Section --}}
<div class="bg-white py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 order-lg-2">
                <div class="position-relative">
                    {{-- Image consistent with About Page style --}}
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1000" 
                         alt="Mr. Jundio Salvador" 
                         class="img-fluid shadow-lg"
                         style="border-radius: 12px; border: 8px solid #F53003;">
                    <div class="position-absolute bottom-0 start-0 bg-white p-4 shadow-sm" style="border-radius: 0 12px 0 12px; max-width: 80%;">
                        <h5 class="fw-bold mb-0 text-danger">Mr. Jundio Salvador</h5>
                        <small class="text-secondary fw-bold text-uppercase" style="letter-spacing: 0.05em;">President</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 order-lg-1">
                <h6 class="text-danger fw-bold mb-3" style="font-size: 0.9rem; letter-spacing: 0.05em;">MESSAGE FROM THE PRESIDENT</h6>
                <h2 class="fw-bold mb-4 text-dark" style="font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.3;">
                    Steering Valenzuela Towards a Resilient Future.
                </h2>
                <p class="text-secondary text-dark mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                    "Our leadership team is committed to more than just business growth; we are dedicated to building a legacy of excellence. Every decision we make is guided by our desire to see every enterprise in Valenzuela flourish, creating a ripple effect of prosperity across our entire community."
                </p>
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 60px; height: 4px; background-color: #F53003;"></div>
                    <span class="fst-italic text-secondary fw-bold text-dark">Jundio Salvador, PCCI Valenzuela</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Executive Officers Section --}}
<div class="py-5 bg-white">
    <div class="container">
        {{-- Section Header --}}
        <div class="text-center mb-5">
            <h6 class="text-danger fw-bold mb-2" style="letter-spacing: 0.1em; font-size: 0.9rem;">EXECUTIVE COMMITTEE</h6>
            <h2 class="fw-bold mb-3 text-dark " style="font-size: clamp(1.75rem, 4vw, 2.5rem);">Meet Our Officers</h2>
            <p class="text-secondary mx-auto" style="max-width: 700px;">
                The driving force behind our strategic initiatives and daily operations.
            </p>
        </div>

      {{-- Officers Grid --}}
        <div class="row g-4">
            @foreach([
                ['name' => 'Maria Santos', 'role' => 'VP for Internal Affairs', 'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=800'],
                ['name' => 'Robert Tan', 'role' => 'VP for External Affairs', 'img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=800'],
                ['name' => 'Elena Cruz', 'role' => 'Corporate Secretary', 'img' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=800'],
                ['name' => 'David Lim', 'role' => 'Treasurer', 'img' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=800'],
            ] as $officer)
            <div class="col-md-6 col-lg-3">
                {{-- Added 'officer-card' class, removed 'shadow-sm' and inline transition --}}
                <div class="position-relative officer-card" 
                     style="border-radius: 12px; overflow: hidden;">
                    
                    {{-- Officer Image --}}
                    <img src="{{ $officer['img'] }}" 
                         alt="{{ $officer['name'] }}" 
                         class="img-fluid w-100"
                         style="height: 350px; object-fit: cover;">
                    
                    {{-- Gradient Overlay --}}
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white" 
                         style="background: linear-gradient(to top, rgba(185, 28, 28, 0.95), rgba(185, 28, 28, 0)); pt-5;">
                        <h5 class="fw-bold mb-1">{{ $officer['name'] }}</h5>
                        <p class="mb-0 small text-uppercase" style="opacity: 0.9; letter-spacing: 0.05em; font-size: 0.75rem;">
                            {{ $officer['role'] }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>



{{-- Call to Action --}}
<div class="py-5 text-white" style="background-color: #B91C1C;">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Want to Join our Leadership?</h2>
        <p class="mb-4 opacity-75 mx-auto" style="max-width: 600px;">
            We are always looking for passionate business leaders to join our committees and help shape the future of Valenzuela.
        </p>
        <a href="{{ url('/contact') }}" class="btn btn-light fw-bold px-5 py-3" style="color: #B91C1C; border-radius: 6px;">
            Contact the Secretariat
        </a>
    </div>
</div>
@endsection