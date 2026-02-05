@extends('layouts.app')

@section('content')

<div class="w-100" style="
    height: 500px;
    padding-top: 180px; 
    padding-bottom: 3rem; 
    margin-top: -1px;
    background: linear-gradient(rgba(164, 13, 15, 0.6), rgba(164, 13, 15, 0.6)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
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
        
        <p class="text-white mb-0" style="font-family: 'DM Sans', sans-serif; max-width: 600px; line-height: 1.7; font-size: 1.1rem; opacity: 0.9;">
            Connect with our diverse community of innovative businesses and entrepreneurs driving economic growth and excellence in Valenzuela City.
        </p>

        <div class="w-100 d-flex justify-content-end gap-3 mt-5">
            <a href="mailto:pcci@gmail.com" class="btn fw-bold px-4 py-2 rounded-pill shadow" 
               style="font-family: 'DM Sans', sans-serif; background-color: #ffffff; color: #a40d0f; border: 2px solid white;">
               Contact Us
            </a>
            
            <a href="tel:+639624407449" class="btn fw-bold px-4 py-2 rounded-pill shadow text-white" 
               style="font-family: 'DM Sans', sans-serif; background-color: #a40d0f; border: 2px solid white;">
               <i class="bi bi-telephone-fill me-2"></i>Call Now
            </a>
        </div>

    </div>
</div>

<div class="container"> 
    <div class="row g-5 mt-2">

    <div class="col-lg-8">
        
        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-4">
            <h4 class="fw-bold text-dark mb-4" style="font-family: 'Poppins', sans-serif;">About Our Company</h4>
            <p class="text-secondary mb-4" style="font-family: 'DM Sans', sans-serif; line-height: 1.7;">
                Tech Corp Inc. is a leading provider of innovative software solutions dedicated to helping local businesses in Valenzuela City thrive in the digital age. Founded in 2015, we specialize in custom web application development, mobile app creation, and enterprise resource planning (ERP) systems tailored to the unique needs of Filipino SMEs.
            </p>
        </div>

        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-4">
            <h4 class="fw-bold text-dark mb-4" style="font-family: 'Poppins', sans-serif;">Products & Services</h4>
            <div class="d-flex gap-3 flex-wrap" style="font-family: 'DM Sans', sans-serif;">
                <div class="border border-secondary rounded px-4 py-2 text-secondary fw-bold">
                    Metal Fabrication
                </div>
                <div class="border border-secondary rounded px-4 py-2 text-secondary fw-bold">
                    Industrial Manufacturing
                </div>
                <div class="border border-secondary rounded px-4 py-2 text-secondary fw-bold">
                    Custom Metal Work
                </div>
            </div>
        </div>

        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-5">
            <h4 class="fw-bold text-danger mb-4" style="font-family: 'Poppins', sans-serif;">Our Location</h4>
            
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-geo-alt-fill text-danger" style="font-size: 1.25rem;"></i>
                    <h5 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">Address</h5>
                </div>
                <p class="text-secondary ms-4 mb-0" style="font-family: 'DM Sans', sans-serif; font-size: 1.05rem;">
                    No. 04 fatima lane Milagrosa Village, Marikina heights 1810
                </p>
            </div>

            <div class="position-relative rounded-3 overflow-hidden border shadow-sm">
                
                <div class="position-absolute top-0 start-0 m-3 z-3">
                    <div class="bg-white rounded shadow-sm d-flex overflow-hidden">
                        <button id="btn-map" onclick="setMapType('map')" 
                                class="btn btn-sm text-dark fw-bold px-3 py-2 border-end rounded-0 hover-bg-light transition-all"
                                style="font-family: 'DM Sans', sans-serif;">
                            Map
                        </button>
                        <button id="btn-sat" onclick="setMapType('satellite')" 
                                class="btn btn-sm text-secondary fw-medium px-3 py-2 rounded-0 hover-bg-light transition-all"
                                style="font-family: 'DM Sans', sans-serif;">
                            Satellite
                        </button>
                    </div>
                </div>

                <iframe 
                    id="map-frame"
                    src="https://maps.google.com/maps?q=No.+04+fatima+lane+Milagrosa+Village,+Marikina+heights+1810&t=m&z=15&output=embed&iwloc=near" 
                    width="100%" 
                    height="350" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <script>
            function setMapType(type) {
                const iframe = document.getElementById('map-frame');
                const btnMap = document.getElementById('btn-map');
                const btnSat = document.getElementById('btn-sat');
                const baseUrl = "https://maps.google.com/maps?q=No.+04+fatima+lane+Milagrosa+Village,+Marikina+heights+1810&z=15&output=embed&iwloc=near";

                if (type === 'map') {
                    iframe.src = baseUrl + "&t=m";
                    btnMap.className = "btn btn-sm text-dark fw-bold px-3 py-2 border-end rounded-0 hover-bg-light transition-all";
                    btnSat.className = "btn btn-sm text-secondary fw-medium px-3 py-2 rounded-0 hover-bg-light transition-all";
                } else {
                    iframe.src = baseUrl + "&t=k";
                    btnMap.className = "btn btn-sm text-secondary fw-medium px-3 py-2 border-end rounded-0 hover-bg-light transition-all";
                    btnSat.className = "btn btn-sm text-dark fw-bold px-3 py-2 rounded-0 hover-bg-light transition-all";
                }
            }
        </script>

    </div>

    <div class="col-lg-4">
        
        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-4">
            <h5 class="fw-bold text-dark mb-4" style="font-family: 'Poppins', sans-serif;">Contact Information</h5>
            <div class="d-flex flex-column gap-3" style="font-family: 'DM Sans', sans-serif;">
                <div>
                    <small class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">Phone</small>
                    <div class="fw-medium text-dark">
                        <p class="mb-0">+639624407449</p>
                    </div>
                </div>
                <div>
                    <small class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">Email</small>
                    <div class="fw-medium text-dark">
                        <p class="mb-0">pcci@gmail.com</p>
                    </div>
                </div>
                <div>
                    <small class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">Address</small>
                    <div class="fw-medium text-dark">No.04 fatima lane La Milagrosa Village, Marikina Heights 1810</div>
                </div>
            </div>
        </div>

        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-4">
            <h5 class="fw-bold text-danger mb-4" style="font-family: 'Poppins', sans-serif;">Business Hours</h5>
            <div class="d-flex flex-column gap-2" style="font-family: 'DM Sans', sans-serif;">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary">Monday - Friday</span>
                    <span class="fw-bold text-dark">8:00 AM - 6:00 PM</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary">Saturday</span>
                    <span class="fw-bold text-dark">9:00 AM - 5:00 PM</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary">Sunday</span>
                    <span class="fw-bold text-dark">Closed</span>
                </div>
            </div>
        </div>

        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-4">
            <h5 class="fw-bold text-danger mb-4" style="font-family: 'Poppins', sans-serif;">Quick Actions</h5>
            <div class="d-flex flex-column gap-3">
                <button class="btn border-danger text-danger fw-bold py-2 w-100" style="font-family: 'DM Sans', sans-serif; background-color: #ffecec;">
                    Request Quote
                </button>
                <button class="btn border-danger text-danger fw-bold py-2 w-100" style="font-family: 'DM Sans', sans-serif; background-color: #ffecec;">
                    Schedule Call
                </button>
                <button class="btn border-danger text-danger fw-bold py-2 w-100" style="font-family: 'DM Sans', sans-serif; background-color: #ffecec;">
                    Browse Other Members
                </button>
            </div>
        </div>

    </div>

</div> </div> @endsection