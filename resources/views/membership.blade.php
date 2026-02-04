@extends('layouts.app')

@section('content')

{{-- 
    FIX NOTES: 
    1. Replaced raw SVG icons with Bootstrap Icons (bi-*)
    2. Maintained previous layout and "Red" overlay
    3. Applied Font Styles: Poppins for Headings, DM Sans for Body/Buttons
--}}
<div class="w-100 mb-0" style="
    padding-top: 140px; 
    padding-bottom: 3rem;
    margin-top: -1px; 
    background: linear-gradient(rgba(164, 13, 15, 0.43), rgba(164, 13, 15, 0.43)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
    background-size: cover;
    background-position: center top;
">
    <div class="container d-flex flex-column align-items-center text-center">
        <span class="text-white fw-bold text-uppercase mb-3 d-block" style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; letter-spacing: 0.05em; opacity: 0.9;">
            PCCI - Valenzuela
        </span>
        <h1 class="headline-text fw-bold mb-4 text-uppercase text-white" style="font-family: 'Poppins', sans-serif; letter-spacing: -0.02em;">
            Discover Local Businesses
        </h1>
        <p class="text-white mb-4" style="font-family: 'DM Sans', sans-serif; max-width: 600px; line-height: 1.7; font-size: 1.1rem; opacity: 0.9;">
            Connect with our diverse community of innovative businesses and entrepreneurs driving economic growth and excellence in Valenzuela City.
        </p>

        <div class="w-100 mt-2" style="max-width: 600px;">
            <div class="input-group shadow-sm bg-white rounded overflow-hidden border-0">
                <span class="input-group-text bg-white border-0 ps-3">
                    {{-- Updated: Bootstrap Search Icon --}}
                    <i class="bi bi-search text-secondary" style="font-size: 1.1rem;"></i>
                </span>
                <input type="text" class="form-control border-0 py-3 shadow-none text-secondary" 
                       style="font-family: 'DM Sans', sans-serif;"
                       placeholder="Search businesses, services..." aria-label="Search">
                <button class="btn text-white px-4 fw-bold text-uppercase" type="button" 
                        style="font-family: 'DM Sans', sans-serif; letter-spacing: 0.05em; background-color: #D40032; border-color: #D40032;">
                    Search
                </button>
            </div>
        </div>
    </div>
</div>

<div class="py-5" style="background-color: #e9ecef;">
    <div class="container mb-5">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start" style="font-family: 'DM Sans', sans-serif;">
                <select class="form-select form-select-sm bg-white border-0 shadow-sm" style="width: auto; cursor: pointer; font-weight: 500;">
                    <option selected>All Categories</option>
                    <option value="tech">Technology</option>
                    <option value="agri">Agriculture</option>
                    <option value="const">Construction</option>
                </select>

                <select class="form-select form-select-sm bg-white border-0 shadow-sm" style="width: auto; cursor: pointer; font-weight: 500;">
                    <option selected>All Locations</option>
                    <option value="val">Valenzuela</option>
                    <option value="mey">Meycauayan</option>
                    <option value="bul">Bulacan</option>
                </select>

                <select class="form-select form-select-sm bg-white border-0 shadow-sm" style="width: auto; cursor: pointer; font-weight: 500;">
                    <option selected>Alphabetical (A-Z)</option>
                    <option value="z-a">Alphabetical (Z-A)</option>
                    <option value="newest">Newest First</option>
                </select>
            </div>

            <div class="text-secondary small fw-medium" style="font-family: 'DM Sans', sans-serif;">
                Showing 3 of 3 results
            </div>
        </div>

        <div class="row g-4">
            
            {{-- Tech Corp --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="font-family: 'Poppins', sans-serif; width: 56px; height: 56px; font-size: 1.2rem;">
                            TC
                        </div>
                        <div>
                            {{-- Business Type Tag (Blue) --}}
                            <span class="d-inline-block rounded px-2 py-1 mb-1 fw-bold text-uppercase" 
                                  style="font-family: 'DM Sans', sans-serif; font-size: 0.65rem; background-color: #e7f1ff; color: #0d6efd; letter-spacing: 0.05em;">
                                Manufacturing
                            </span>
                            <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Poppins', sans-serif;">Tech Corp Inc.</h5>
                            <small class="text-muted" style="font-family: 'DM Sans', sans-serif;">Technology & Software</small>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 d-flex flex-column flex-grow-1">
                        <div class="mb-3">
                            <div class="d-flex gap-2 small text-secondary overflow-hidden text-nowrap" style="font-family: 'DM Sans', sans-serif;">
                                <span class="bg-body-secondary px-2 py-1 rounded">Metal Fabrication</span>
                                <span class="bg-body-secondary px-2 py-1 rounded">Industrial Manufacturing</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <div class="d-flex flex-column gap-2 small text-muted" style="font-family: 'DM Sans', sans-serif;">
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Updated: Bootstrap Envelope Icon --}}
                                    <i class="bi bi-envelope"></i>
                                    contact@techcorp.ph
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Updated: Bootstrap Phone Icon --}}
                                    <i class="bi bi-telephone"></i>
                                    +63 912 345 6789
                                </div>
                            </div>
                            <a href="{{ route('business.show') }}" class="btn py-1 px-3 text-center ms-2 text-white fw-bold" 
                               style="font-family: 'DM Sans', sans-serif; font-size: 0.8rem; white-space: nowrap; background-color: #D40032; border-radius: 6px;">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Green Fields --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white fw-bold" style="font-family: 'Poppins', sans-serif; width: 56px; height: 56px; font-size: 1.2rem;">
                            GF
                        </div>
                        <div>
                            {{-- Business Type Tag (Green) --}}
                            <span class="d-inline-block rounded px-2 py-1 mb-1 fw-bold text-uppercase" 
                                  style="font-family: 'DM Sans', sans-serif; font-size: 0.65rem; background-color: #d1e7dd; color: #146c43; letter-spacing: 0.05em;">
                                Distributor
                            </span>
                            <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Poppins', sans-serif;">Green Fields</h5>
                            <small class="text-muted" style="font-family: 'DM Sans', sans-serif;">Agriculture & Supply</small>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 d-flex flex-column flex-grow-1">
                        <div class="mb-3">
                            <div class="d-flex gap-2 small text-secondary overflow-hidden text-nowrap" style="font-family: 'DM Sans', sans-serif;">
                                <span class="bg-body-secondary px-2 py-1 rounded">Organic Fertilizer</span>
                                <span class="bg-body-secondary px-2 py-1 rounded">Agricultural Tools</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <div class="d-flex flex-column gap-2 small text-muted" style="font-family: 'DM Sans', sans-serif;">
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Updated: Bootstrap Envelope Icon --}}
                                    <i class="bi bi-envelope"></i>
                                    sales@greenfields.com
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Updated: Bootstrap Phone Icon --}}
                                    <i class="bi bi-telephone"></i>
                                    (02) 8123 4567
                                </div>
                            </div>
                            <a href="{{ route('business.show') }}" class="btn py-1 px-3 text-center ms-2 text-white fw-bold" 
                               style="font-family: 'DM Sans', sans-serif; font-size: 0.8rem; white-space: nowrap; background-color: #D40032; border-radius: 6px;">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BuildLink --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center text-dark fw-bold" style="font-family: 'Poppins', sans-serif; width: 56px; height: 56px; font-size: 1.2rem;">
                            BL
                        </div>
                        <div>
                            {{-- Business Type Tag (Yellow/Orange) --}}
                            <span class="d-inline-block rounded px-2 py-1 mb-1 fw-bold text-uppercase" 
                                  style="font-family: 'DM Sans', sans-serif; font-size: 0.65rem; background-color: #fff3cd; color: #664d03; letter-spacing: 0.05em;">
                                Services
                            </span>
                            <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Poppins', sans-serif;">BuildLink</h5>
                            <small class="text-muted" style="font-family: 'DM Sans', sans-serif;">Construction</small>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 d-flex flex-column flex-grow-1">
                        <div class="mb-3">
                            <div class="d-flex gap-2 small text-secondary overflow-hidden text-nowrap" style="font-family: 'DM Sans', sans-serif;">
                                <span class="bg-body-secondary px-2 py-1 rounded">General Construction</span>
                                <span class="bg-body-secondary px-2 py-1 rounded">Architectural Planning</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <div class="d-flex flex-column gap-2 small text-muted" style="font-family: 'DM Sans', sans-serif;">
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Updated: Bootstrap Envelope Icon --}}
                                    <i class="bi bi-envelope"></i>
                                    inquire@buildlink.ph
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Updated: Bootstrap Phone Icon --}}
                                    <i class="bi bi-telephone"></i>
                                    (02) 8987 6543
                                </div>
                            </div>
                            <a href="{{ route('business.show') }}" class="btn py-1 px-3 text-center ms-2 text-white fw-bold" 
                               style="font-family: 'DM Sans', sans-serif; font-size: 0.8rem; white-space: nowrap; background-color: #D40032; border-radius: 6px;">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection