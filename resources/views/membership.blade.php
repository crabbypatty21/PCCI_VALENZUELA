@extends('layouts.app')

@section('content')

<div class="w-100 mb-0" style="
    padding-top: 140px; 
    padding-bottom: 3rem;
    margin-top: -1px; 
    background: linear-gradient(rgba(164, 13, 15, 0.43), rgba(164, 13, 15, 0.43)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
    background-size: cover;
    background-position: center top;
">
    <div class="container d-flex flex-column align-items-center text-center">
        <span class="text-white fw-bold text-uppercase mb-3 d-block" style="font-size: 0.85rem; letter-spacing: 0.05em; opacity: 0.9;">
            PCCI - Valenzuela
        </span>
        <h1 class="headline-text fw-bold mb-4 text-uppercase text-white" style="letter-spacing: -0.02em;">
            Discover Local Businesses
        </h1>
        <p class="text-white mb-4" style="max-width: 600px; line-height: 1.7; font-size: 1.1rem; opacity: 0.9;">
            Connect with our diverse community of innovative businesses and entrepreneurs driving economic growth and excellence in Valenzuela City.
        </p>

        <div class="w-100 mt-2" style="max-width: 600px;">
            <div class="input-group shadow-sm bg-white rounded overflow-hidden border-0">
                <span class="input-group-text bg-white border-0 ps-3">
                    <svg width="20" height="20" fill="none" stroke="#6c757d" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" class="form-control border-0 py-3 shadow-none text-secondary" placeholder="Search businesses, services..." aria-label="Search">
                <button class="btn btn-primary px-4 fw-bold text-uppercase" type="button" style="letter-spacing: 0.05em;">Search</button>
            </div>
        </div>
    </div>
</div>

<div class="py-5" style="background-color: #e9ecef;">
    <div class="container mb-5">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
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

            <div class="text-secondary small fw-medium">
                Showing 3 of 3 results
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="width: 56px; height: 56px; font-size: 1.2rem;">
                            TC
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Tech Corp Inc.</h5>
                            <small class="text-muted">Technology & Software</small>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 d-flex flex-column flex-grow-1">
                        <div class="mb-3">
                            <div class="d-flex gap-2 small text-secondary overflow-hidden text-nowrap">
                                <span class="bg-body-secondary px-2 py-1 rounded">Metal Fabrication</span>
                                <span class="bg-body-secondary px-2 py-1 rounded">Industrial Manufacturing</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <div class="d-flex flex-column gap-2 small text-muted">
                                <div class="d-flex align-items-center gap-2">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    contact@techcorp.ph
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    +63 912 345 6789
                                </div>
                            </div>
                            <a href="{{ route('business.show') }}" class="btn-outline-custom py-1 px-3 text-center ms-2" style="font-size: 0.8rem; white-space: nowrap;">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white fw-bold" style="width: 56px; height: 56px; font-size: 1.2rem;">
                            GF
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Green Fields</h5>
                            <small class="text-muted">Agriculture & Supply</small>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 d-flex flex-column flex-grow-1">
                        <div class="mb-3">
                            <div class="d-flex gap-2 small text-secondary overflow-hidden text-nowrap">
                                <span class="bg-body-secondary px-2 py-1 rounded">Organic Fertilizer</span>
                                <span class="bg-body-secondary px-2 py-1 rounded">Agricultural Tools</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <div class="d-flex flex-column gap-2 small text-muted">
                                <div class="d-flex align-items-center gap-2">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    sales@greenfields.com
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    (02) 8123 4567
                                </div>
                            </div>
                            <a href="#" class="btn-outline-custom py-1 px-3 text-center ms-2" style="font-size: 0.8rem; white-space: nowrap;">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center text-dark fw-bold" style="width: 56px; height: 56px; font-size: 1.2rem;">
                            BL
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">BuildLink</h5>
                            <small class="text-muted">Construction</small>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 d-flex flex-column flex-grow-1">
                        <div class="mb-3">
                            <div class="d-flex gap-2 small text-secondary overflow-hidden text-nowrap">
                                <span class="bg-body-secondary px-2 py-1 rounded">General Construction</span>
                                <span class="bg-body-secondary px-2 py-1 rounded">Architectural Planning</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <div class="d-flex flex-column gap-2 small text-muted">
                                <div class="d-flex align-items-center gap-2">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    inquire@buildlink.ph
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    (02) 8987 6543
                                </div>
                            </div>
                            <a href="#" class="btn-outline-custom py-1 px-3 text-center ms-2" style="font-size: 0.8rem; white-space: nowrap;">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection