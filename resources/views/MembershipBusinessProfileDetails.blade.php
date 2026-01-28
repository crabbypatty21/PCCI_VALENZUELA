@extends('layouts.app')

@section('content')

<div class="w-100" style="
    padding-top: 180px; 
    padding-bottom: 5rem; 
    margin-top: -1px;
    background: linear-gradient(rgba(164, 13, 15, 0.85), rgba(164, 13, 15, 0.85)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
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
        <p class="text-white mb-0" style="max-width: 600px; line-height: 1.7; font-size: 1.1rem; opacity: 0.9;">
            Connect with our diverse community of innovative businesses and entrepreneurs driving economic growth and excellence in Valenzuela City.
        </p>
    </div>
</div>

<div class="container my-5"> <div class="card border-0 shadow-lg p-4 mb-5 bg-white" style="border-radius: 16px;">
        <div class="d-flex flex-column flex-md-row align-items-start gap-4">
            <div class="rounded bg-primary d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width: 100px; height: 100px; font-size: 2rem;">
                TC
            </div>
            
            <div class="flex-grow-1 w-100">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">Tech Corp Inc.</h2>
                        <span class="badge bg-light text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill fw-medium">Technology & Software</span>
                    </div>
                    <div class="d-flex gap-2 mt-3 mt-md-0">
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.342 1.248zm11.064 8.212v-3.992c0-1.947-1.036-2.843-2.426-2.843-1.121 0-1.634.621-1.918 1.156h-.027V6.169h-2.304c.03.654 0 7.225 0 7.225h2.304V9.846c0-.197.014-.396.073-.537.158-.395.517-.804 1.121-.804.79 0 1.106.6 1.106 1.481v4.412h2.311z"/></svg>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="row g-3 text-secondary">
                    <div class="col-md-6 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0 text-primary" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>123 Innovation Drive, Valenzuela City, Metro Manila</span>
                    </div>
                    <div class="col-md-6 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0 text-primary" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:contact@techcorp.ph" class="text-decoration-none text-secondary">contact@techcorp.ph</a>
                    </div>
                    <div class="col-md-6 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0 text-primary" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>+63 912 345 6789</span>
                    </div>
                    <div class="col-md-6 d-flex align-items-center gap-2">
                        <svg class="flex-shrink-0 text-primary" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        <a href="https://techcorp.ph" target="_blank" class="text-decoration-none text-secondary">www.techcorp.ph</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5">
        
        <div class="col-lg-8">
            <div class="mb-5">
                <h4 class="fw-bold text-dark mb-4">About the Business</h4>
                <p class="text-secondary mb-4" style="line-height: 1.7;">
                    Tech Corp Inc. is a leading provider of innovative software solutions dedicated to helping local businesses in Valenzuela City thrive in the digital age. Founded in 2015, we specialize in custom web application development, mobile app creation, and enterprise resource planning (ERP) systems tailored to the unique needs of Filipino SMEs.
                </p>
                <p class="text-secondary mb-4" style="line-height: 1.7;">
                    Our mission is to bridge the technological gap for local enterprises by providing scalable, secure, and user-friendly software that drives efficiency and growth. We believe in the power of technology to transform businesses and uplift communities.
                </p>
                <p class="text-secondary" style="line-height: 1.7;">
                    We are proud active members of the PCCI Valenzuela chapter, contributing to the city's vibrant economic landscape through technological empowerment and job creation for local IT talents.
                </p>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm p-4 bg-white rounded-4 mb-4">
                <h5 class="fw-bold text-dark mb-4">Business Details</h5>
                <div class="d-flex flex-column gap-3">
                    <div>
                        <small class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">Member Since</small>
                        <div class="fw-medium text-dark">January 2018</div>
                    </div>
                    <div>
                        <small class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">Business Type</small>
                        <div class="fw-medium text-dark">Corporation</div>
                    </div>
                    <div>
                        <small class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">Employees</small>
                        <div class="fw-medium text-dark">50 - 100</div>
                    </div>
                </div>
            </div>

             <div class="card border-0 shadow-sm p-4 bg-primary-subtle rounded-4">
                 <div class="d-flex align-items-center gap-3">
                     <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center">
                         <svg class="text-white" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"></path></svg>
                     </div>
                     <div>
                        <h6 class="fw-bold text-primary mb-0">Verified PCCI Member</h6>
                        <small class="text-primary-emphasis">Active and in good standing.</small>
                     </div>
                 </div>
            </div>

        </div>
    </div>
</div>
@endsection