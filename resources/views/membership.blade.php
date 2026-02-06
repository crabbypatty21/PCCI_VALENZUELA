@extends('layouts.app')

@section('content')

{{-- 
    REVISION NOTES:
    1. Hero: Height 623px, BG #252631, Top Padding 130px.
    2. Search Button: Floating style. 
       - Margins: 11px top/bottom, 13px right.
       - Height: 40px.
--}}
<div class="w-100 mb-0 d-flex flex-column align-items-center" style="
    height: 623px;
    margin-top: -1px; 
    background-color: #252631;
    opacity: 1;
    padding-top: 130px;
">
    <div class="container d-flex flex-column align-items-center text-center">
        
        {{-- Subtitle --}}
        <span class="text-white mb-3 d-block" 
            style="font-family: 'DM Sans', sans-serif; font-weight: 900; font-size: 24px; line-height: 100%; letter-spacing: 0; text-transform: uppercase; width: 1522px; height: 31px; text-align: center;">
            JOIN PCCI - VALENZUELA
        </span>

        {{-- Main Headline --}}
        <h1 class="headline-text fw-bold mb-4 text-uppercase text-white" 
            style="font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">
            Discover Local <span style="color: #EB3223; font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 63px; line-height: 100%; letter-spacing: 0;">Businesses</span>
        </h1>

        {{-- Paragraph --}}
        <p class="text-white" 
        style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 24px; line-height: 100%; letter-spacing: 0; text-align: center; width: 1262px; height: 72px; margin: 0 auto 21px auto;">
            Connect with our diverse community of innovative businesses and entrepreneurs driving economic growth and excellence in Valenzuela City.
        </p>

        {{-- Search Bar Container --}}
        <div style="width: 782px; max-width: 90%;">
            
            {{-- Input Group (Height 62px) --}}
            <div class="input-group shadow-sm bg-white rounded overflow-hidden border-0 align-items-center" style="height: 62px;">
                
                {{-- Search Icon --}}
                <span class="input-group-text bg-white border-0 ps-4">
                    <i class="bi bi-search text-secondary" style="font-size: 1.2rem;"></i>
                </span>
                
                {{-- Input Field --}}
                <input type="text" class="form-control border-0 shadow-none text-secondary h-100" 
                       style="font-family: 'DM Sans', sans-serif; font-size: 1rem;"
                       placeholder="Search businesses, services..." aria-label="Search">
                
                {{-- Search Button --}}
                {{-- 
                    Calculation: Container 62px - 11px Top - 11px Bottom = 40px Button Height.
                    Added border-radius since it now has margin and isn't flush to the edge.
                --}}
                <button class="btn text-white px-5 fw-bold text-uppercase" type="button" 
                        style="
                            font-family: 'DM Sans', sans-serif; 
                            letter-spacing: 0.05em; 
                            background-color: #D40032; 
                            border-color: #D40032;
                            margin-top: 11px;
                            margin-bottom: 11px;
                            margin-right: 13px;
                            height: 40px;
                            display: flex;
                            align-items: center;
                            border-radius: 6px; 
                        ">
                    Search
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Filters & Listing Section (Unchanged) --}}
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
                                    <i class="bi bi-envelope"></i>
                                    contact@techcorp.ph
                                </div>
                                <div class="d-flex align-items-center gap-2">
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
                                    <i class="bi bi-envelope"></i>
                                    sales@greenfields.com
                                </div>
                                <div class="d-flex align-items-center gap-2">
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
                                    <i class="bi bi-envelope"></i>
                                    inquire@buildlink.ph
                                </div>
                                <div class="d-flex align-items-center gap-2">
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