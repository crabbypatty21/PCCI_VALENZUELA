@extends('layouts.app')

@section('content')

@php
$businesses = [
    1 => [
        'name' => 'Tech Corp Inc.',
        'about' => 'Tech Corp Inc. is a leading provider of innovative software solutions dedicated to helping local businesses in Valenzuela City thrive in the digital age.',
        'services' => ['Software Development', 'Mobile Apps', 'ERP Systems'],
        'phone' => '+639624407449',
        'email' => 'contact@techcorp.ph',
        'address' => 'No. 04 Fatima Lane, Marikina Heights 1810',
        'hours' => [
            'Monday - Friday' => '8:00 AM - 6:00 PM',
            'Saturday' => '9:00 AM - 5:00 PM',
            'Sunday' => 'Closed',
        ],
        'map' => 'No.+04+fatima+lane+Milagrosa+Village,+Marikina+heights+1810',
    ],

    2 => [
        'name' => 'Green Fields',
        'about' => 'Green Fields is a trusted agricultural distributor supplying organic produce and farming materials to local partners across Metro Manila.',
        'services' => ['Organic Produce', 'Wholesale Supply', 'Farm Logistics'],
        'phone' => '+639111111111',
        'email' => 'sales@greenfields.com',
        'address' => 'Valenzuela City',
        'hours' => [
            'Monday - Friday' => '8:00 AM - 6:00 PM',
            'Saturday' => '9:00 AM - 5:00 PM',
            'Sunday' => 'Closed',
        ],
        'map' => 'Valenzuela+City',
    ],

    3 => [
        'name' => 'Build Links',
        'about' => 'Build Links is a trusted agricultural distributor supplying organic produce and farming materials to local partners across Metro Manila.',
        'services' => ['Organic Produce', 'Wholesale Supply', 'Farm Logistics'],
        'phone' => '+639111111111',
        'email' => 'sales@buildlinks.com',
        'address' => 'Valenzuela City',
        'hours' => [
            'Monday - Friday' => '8:00 AM - 6:00 PM',
            'Saturday' => '9:00 AM - 5:00 PM',
            'Sunday' => 'Closed',
        ],
        'map' => 'Valenzuela+City',
    ],
];

$business = $businesses[$id] ?? abort(404);
@endphp


{{-- HERO (UPDATED STYLE) --}}
<div class="w-100" style="
    background:#1f2330;
    min-height: 420px;
">
    <div class="container">
        <div class="row align-items-center g-4"
             style="padding-top:120px; padding-bottom:80px;">

            {{-- LOGO --}}
            <div class="col-auto">
                <div class="rounded-4 bg-light d-flex align-items-center justify-content-center"
                     style="width:120px;height:120px;">
                    <span class="fw-bold fs-2 text-danger">
                        {{ strtoupper(substr($business['name'], 0, 3)) }}
                    </span>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="col">

                <h1 class="fw-bold text-white mb-2">
                    {{ $business['name'] }}
                </h1>
                <span class="badge rounded-pill mb-2"
                      style="background:#2e5aac;">
                    Manufacturing
                </span>

                <p class="text-light mb-4" style="max-width:720px; opacity:.9;">
                    {{ $business['about'] }}
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="tel:{{ $business['phone'] }}"
                       class="btn btn-danger px-4 fw-bold">
                        CONTACT US
                    </a>

                    <a href="mailto:{{ $business['email'] }}"
                       class="btn btn-outline-light px-4 fw-bold">
                        CALL NOW
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="container mt-5">
<div class="row g-5">

{{-- LEFT CONTENT --}}
<div class="col-lg-8">

{{-- ABOUT --}}
<div class="card border border-danger shadow-sm p-4 rounded-4 mb-4">
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-buildings text-danger fs-3"></i>
        <h4 class="fw-bold text-danger mb-0">About Our Company</h4>
    </div>

    {{-- Removed 'text-dark' so it inherits theme color (Black in Light, White in Dark) --}}
    <p>{{ $business['about'] }}</p>
</div>


{{-- SERVICES --}}
<div class="card border border-danger shadow-sm p-4 rounded-4 mb-4">
    <h4 class="fw-bold text-danger mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-briefcase"></i>
        <span>Products & Services</span>
    </h4>

    <div class="row g-3">
        @foreach ($business['services'] as $service)
            <div class="col-md-6 col-lg-4">
                <div class="service-box bg-danger bg-opacity-50 border rounded-4 p-3 h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-briefcase text-danger"></i>
                        <h6 class="fw-bold mb-0 text-danger">
                            {{ $service }}
                        </h6>
                    </div>

                    {{-- Removed 'text-dark' so it inherits theme color --}}
                    <p class="small mb-0">
                        This service provides reliable and professional solutions
                        tailored to meet customer needs and business goals.
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>


    {{-- MAP --}}
    <div class="card border border-danger shadow-sm p-4 rounded-4 mb-5">
        <h4 class="fw-bold text-danger mb-3">Our Location</h4>

        {{-- Removed 'text-secondary' so address is Black in Light Mode / White in Dark Mode --}}
        <p class="mb-3">
            <i class="bi bi-geo-alt-fill text-danger me-2"></i>
            {{ $business['address'] }}
        </p>

        <iframe
            src="https://maps.google.com/maps?q={{ $business['map'] }}&t=m&z=15&output=embed"
            width="100%"
            height="350"
            style="border:0;"
            loading="lazy">
        </iframe>
    </div>

</div>

{{-- RIGHT SIDEBAR --}}
<div class="col-lg-4">

    {{-- CONTACT --}}
    <div class="card border border-danger shadow-sm p-4 rounded-4 mb-4">
        <h5 class="fw-bold text-danger mb-4">Contact Information</h5>

        <div class="d-flex flex-column gap-4">

            <div class="d-flex align-items-center gap-3">
                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                     style="width:42px;height:42px;">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <div>
                    {{-- Removed 'text-muted' from label so it's readable in dark mode --}}
                    <small class="fw-bold text-uppercase">Phone</small><br>
                    <span>{{ $business['phone'] }}</span>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                     style="width:42px;height:42px;">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <div>
                    {{-- Removed 'text-muted' from label --}}
                    <small class="fw-bold text-uppercase">Email</small><br>
                    <span>{{ $business['email'] }}</span>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                     style="width:42px;height:42px;">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div>
                    {{-- Removed 'text-muted' from label --}}
                    <small class="fw-bold text-uppercase">Address</small><br>
                    <span>{{ $business['address'] }}</span>
                </div>
            </div>

        </div>
    </div>

{{-- HOURS --}}
<div class="card border border-danger shadow-sm p-4 rounded-4 mb-4">
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-building text-danger fs-4"></i>
        <h5 class="fw-bold text-danger mb-0">Business Hours</h5>
    </div>

    @foreach ($business['hours'] as $day => $time)
        <div class="d-flex justify-content-between">
            {{-- Removed 'text-dark' so it inherits theme color --}}
            <span>{{ $day }}</span>
            <span class="fw-bold">{{ $time }}</span>
        </div>
    @endforeach
</div>


{{-- ACTIONS --}}
<div class="card border border-danger shadow-sm p-4 rounded-4">
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-gear text-danger fs-4"></i>
        <h5 class="fw-bold text-danger mb-0">Quick Actions</h5>
    </div>

    <div class="d-grid gap-2">
        <button class="btn btn-outline-danger fw-bold">Request Quote</button>
        <button class="btn btn-outline-danger fw-bold">Schedule Call</button>
        <a href="{{ url('/membership') }}" class="btn btn-outline-danger fw-bold">
            Browse Other Members
        </a>
    </div>
</div>

</div>
</div>
</div>

@endsection