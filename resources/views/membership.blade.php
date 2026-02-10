@extends('layouts.app')

@section('content')

@php
    // 1. DATA ARRAY (Your full list)
    $businesses = [
        ['id' => 1, 'name' => 'Tech Corp Inc.', 'category' => 'Manufacturing', 'industry' => 'Technology & Software', 'email' => 'contact@techcorp.ph', 'phone' => '+63 912 345', 'color' => 'bg-primary', 'initials' => 'TC', 'tags' => ['Hardware', 'Software']],
        ['id' => 2, 'name' => 'Green Fields', 'category' => 'Distributor', 'industry' => 'Agriculture & Supply', 'email' => 'sales@greenfields.com', 'phone' => '(02) 8123', 'color' => 'bg-success', 'initials' => 'GF', 'tags' => ['Organic', 'Wholesale']],
        ['id' => 3, 'name' => 'BuildLink', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 4, 'name' => 'BuildLink 4', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 5, 'name' => 'BuildLink 5', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 6, 'name' => 'BuildLink 6', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 7, 'name' => 'BuildLink 7', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 8, 'name' => 'BuildLink 8', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 9, 'name' => 'BuildLink 9', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 10, 'name' => 'BuildLink 10', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 11, 'name' => 'BuildLink 11', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 12, 'name' => 'BuildLink 12', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-warning', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
        ['id' => 13, 'name' => 'BuildLink 13 (Page 2)', 'category' => 'Services', 'industry' => 'Construction', 'email' => 'inquire@buildlink.ph', 'phone' => '(02) 8987', 'color' => 'bg-info', 'initials' => 'BL', 'tags' => ['Civil', 'Materials']],
    ];

    // 2. PAGINATION LOGIC
    $perPage = 12;
    $totalResults = count($businesses);
    $totalPages = ceil($totalResults / $perPage);
    $currentPage = (int) request()->get('page', 1);
    
    // Ensure current page is within valid range
    if ($currentPage < 1) $currentPage = 1;
    if ($currentPage > $totalPages) $currentPage = $totalPages;

    // Slice the array to show only 12 items for the current page
    $offset = ($currentPage - 1) * $perPage;
    $pagedData = array_slice($businesses, $offset, $perPage);

    // Calculate "Showing X-Y of Z"
    $showingStart = $offset + 1;
    $showingEnd = min($offset + $perPage, $totalResults);
@endphp

{{-- HERO SECTION --}}
<div class="w-100 mb-0 d-flex flex-column align-items-center" style="height: 623px; margin-top: -1px; background-color: #252631; padding-top: 130px;">
    <div class="container d-flex flex-column align-items-center text-center">
        <span class="text-white mb-3 d-block" style="font-family: 'DM Sans', sans-serif; font-weight: 900; font-size: 24px; text-transform: uppercase;">JOIN PCCI - VALENZUELA</span>
        <h1 class="headline-text fw-bold mb-4 text-uppercase text-white" style="font-family: 'DM Sans', sans-serif; font-size: 63px;">
            Discover Local <span style="color: #EB3223;">Businesses</span>
        </h1>
        <p class="text-white" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 24px; max-width: 1262px; margin-bottom: 21px;">
            Connect with our diverse community of innovative businesses and entrepreneurs driving economic growth and excellence in Valenzuela City.
        </p>
        <div style="width: 782px; max-width: 90%;">
            <div class="input-group shadow-sm bg-white rounded overflow-hidden border-0 align-items-center" style="height: 62px;">
                <span class="input-group-text bg-white border-0 ps-4"><i class="bi bi-search text-secondary"></i></span>
                <input type="text" class="form-control border-0 shadow-none text-secondary" placeholder="Search businesses, services...">
                <button class="btn text-white px-5 fw-bold text-uppercase" style="background-color: #D40032; margin-right: 13px; height: 40px; border-radius: 6px;">Search</button>
            </div>
        </div>
    </div>
</div>

        {{-- Filters & Listing Section --}}
        <div class="py-5" style="background-color: #e9ecef;">
            <div class="w-100 mb-5" style="border-top: 1px solid gray; border-bottom: 1px solid gray;">
                <div class="container px-4 px-lg-5">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 py-3">
                        
                        <div class="d-flex flex-wrap gap-2">
                            {{-- Categories --}}
                            <select class="form-select form-select-sm bg-white border-0 shadow-sm" style="width: auto;">
                                <option selected>All Categories</option>
                            </select>

                            {{-- Locations --}}
                            <select class="form-select form-select-sm bg-white border-0 shadow-sm" style="width: auto;">
                                <option selected>All Locations</option>
                            </select>

                            {{-- Sort Order Dropdown --}}
                            <select class="form-select form-select-sm bg-white border-0 shadow-sm" 
                                    style="width: auto;" 
                                    onchange="window.location.href='?sort=' + this.value">
                                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Sort: Ascending</option>
                                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Sort: Descending</option>
                            </select>
                        </div>

                        {{-- DYNAMIC SHOWING TEXT --}}
                        <div class="text-secondary small fw-medium" style="font-family: 'DM Sans', sans-serif;">
                            Showing {{ $showingStart }}-{{ $showingEnd }} of {{ $totalResults }} results
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- CARD GRID --}}
    <div class="container px-4 px-lg-5">
        <div class="row g-4">
            @foreach ($pagedData as $business)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow p-3" style="border-radius: 12px; background: #fff;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle {{ $business['color'] }} d-flex align-items-center justify-content-center {{ $business['color'] == 'bg-warning' ? 'text-dark' : 'text-white' }} fw-bold" style="width: 56px; height: 56px; font-size: 1.2rem;">
                                {{ $business['initials'] }}
                            </div>
                            <div>
                                <span class="d-inline-block rounded px-2 py-1 mb-1 fw-bold text-uppercase" style="font-size: 0.65rem; background-color: #e7f1ff; color: #0d6efd;">
                                    {{ $business['category'] }}
                                </span>
                                <h5 class="fw-bold mb-0 text-dark">{{ $business['name'] }}</h5>
                                <small class="text-muted">{{ $business['industry'] }}</small>
                            </div>
                        </div>
                        <div class="card-body p-0 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                <div class="d-flex gap-2 small text-secondary">
                                    @foreach ($business['tags'] as $tag)
                                        <span class="bg-body-secondary px-2 py-1 rounded">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div class="small text-muted">
                                    <i class="bi bi-envelope"></i> {{ $business['email'] }}<br>
                                    <i class="bi bi-telephone"></i> {{ $business['phone'] }}
                                </div>
                                <a href="{{ route('business.show', $business['id']) }}"
                                class="btn py-1 px-3 text-white fw-bold"
                                style="background-color: #D40032; border-radius: 6px; font-size: 0.8rem;">
                                    View Details
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- DYNAMIC PAGINATION SECTION --}}
        <div class="mt-5 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- Previous Button --}}
                    <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                        <a class="page-link border-0 text-secondary" href="?page={{ $currentPage - 1 }}">Previous</a>
                    </li>

                    {{-- Page Numbers --}}
                    @for ($p = 1; $p <= $totalPages; $p++)
                        <li class="page-item {{ $currentPage == $p ? 'active' : '' }}">
                            <a class="page-link border-0 {{ $currentPage == $p ? 'bg-danger text-white shadow-sm' : 'text-secondary' }} rounded mx-1" href="?page={{ $p }}">
                                {{ $p }}
                            </a>
                        </li>
                    @endfor

                    {{-- Next Button --}}
                    <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                        <a class="page-link border-0 text-secondary" href="?page={{ $currentPage + 1 }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection 