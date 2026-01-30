@extends('layouts.app')

@section('content')

<div class="w-100" style="
    height: 500px;
    padding-top: 180px; 
    padding-bottom: 5rem; 
    margin-top: -1px;
    background: linear-gradient(rgba(164, 13, 15, 0.6), rgba(164, 13, 15, 0.6)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
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

    <div class="container"> 

<div class="row g-5 mt-2">

    <div class="col-lg-8">
        
        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-4">
            <h4 class="fw-bold text-dark mb-4">About Our Company</h4>
            <p class="text-secondary mb-4" style="line-height: 1.7;">
                Tech Corp Inc. is a leading provider of innovative software solutions dedicated to helping local businesses in Valenzuela City thrive in the digital age. Founded in 2015, we specialize in custom web application development, mobile app creation, and enterprise resource planning (ERP) systems tailored to the unique needs of Filipino SMEs.
            </p>
        </div>

        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-4">
            <h4 class="fw-bold text-dark mb-4">Products & Services</h4>
            <div class="d-flex gap-3 flex-wrap">
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
        <h4 class="fw-bold text-danger mb-4">Our Location</h4>
        
        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
                <h5 class="fw-bold text-dark mb-0">Address</h5>
            </div>
            <p class="text-secondary ms-4 mb-0" style="font-size: 1.05rem;">
                No. 04 fatima lane Milagrosa Village, Marikina heights 1810
            </p>
        </div>

        <div class="position-relative rounded-3 overflow-hidden border shadow-sm">
            
            <div class="position-absolute top-0 start-0 m-3 z-3">
                <div class="bg-white rounded shadow-sm d-flex overflow-hidden">
                    <button id="btn-map" onclick="setMapType('map')" 
                            class="btn btn-sm text-dark fw-bold px-3 py-2 border-end rounded-0 hover-bg-light transition-all">
                        Map
                    </button>
                    <button id="btn-sat" onclick="setMapType('satellite')" 
                            class="btn btn-sm text-secondary fw-medium px-3 py-2 rounded-0 hover-bg-light transition-all">
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
            // 1. Get references to the elements
            const iframe = document.getElementById('map-frame');
            const btnMap = document.getElementById('btn-map');
            const btnSat = document.getElementById('btn-sat');
            
            // Base URL for the address (Marikina Heights)
            const baseUrl = "https://maps.google.com/maps?q=No.+04+fatima+lane+Milagrosa+Village,+Marikina+heights+1810&z=15&output=embed&iwloc=near";

            if (type === 'map') {
                // Set iframe to Map Mode (t=m)
                iframe.src = baseUrl + "&t=m";
                
                // Update Button Styles (Map Active)
                btnMap.className = "btn btn-sm text-dark fw-bold px-3 py-2 border-end rounded-0 hover-bg-light transition-all";
                btnSat.className = "btn btn-sm text-secondary fw-medium px-3 py-2 rounded-0 hover-bg-light transition-all";
            } else {
                // Set iframe to Satellite Mode (t=k)
                iframe.src = baseUrl + "&t=k";
                
                // Update Button Styles (Satellite Active)
                btnMap.className = "btn btn-sm text-secondary fw-medium px-3 py-2 border-end rounded-0 hover-bg-light transition-all";
                btnSat.className = "btn btn-sm text-dark fw-bold px-3 py-2 rounded-0 hover-bg-light transition-all";
            }
        }
    </script>

    </div>

    <div class="col-lg-4">
        
        <div class="card border border-danger shadow-sm p-4 bg-white rounded-4 mb-4">
            <h5 class="fw-bold text-dark mb-4">Contact Information</h5>
            <div class="d-flex flex-column gap-3">
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
            <h5 class="fw-bold text-danger mb-4">Business Hours</h5>
            <div class="d-flex flex-column gap-2">
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
            <h5 class="fw-bold text-danger mb-4">Quick Actions</h5>
            <div class="d-flex flex-column gap-3">
                <button class="btn border-danger text-danger fw-bold py-2 w-100" style="background-color: #ffecec;">
                    Request Quote
                </button>
                <button class="btn border-danger text-danger fw-bold py-2 w-100" style="background-color: #ffecec;">
                    Schedule Call
                </button>
                <button class="btn border-danger text-danger fw-bold py-2 w-100" style="background-color: #ffecec;">
                    Browse Other Members
                </button>
            </div>
        </div>

    </div>

</div>
    
</div>
</div>
@endsection