@extends('layouts.app')
@include('partials.api-config')

@section('content')

{{-- HERO SECTION --}}
<div class="w-100 mb-0 d-flex flex-column align-items-center" style="min-height: clamp(350px, 60vh, 500px); margin-top: -1px; background-color: var(--bg-hero); padding-top: clamp(60px, 15vw, 130px); padding-bottom: clamp(30px, 8vw, 50px); transition: background-color 0.3s ease;">
    <div class="container d-flex flex-column align-items-center text-center px-2 px-sm-3">
        <span class="mb-2 mb-sm-3 d-block" style="color: #ffffff !important; font-family: 'DM Sans', sans-serif; font-weight: 900; font-size: clamp(0.9rem, 2.5vw, 1.5rem); text-transform: uppercase; letter-spacing: 0.05em;">JOIN PCCI - VALENZUELA</span>
        <h1 class="headline-text fw-bold mb-3 mb-sm-4 text-uppercase" style="color: #ffffff !important; font-family: 'DM Sans', sans-serif; font-size: clamp(1.75rem, 5vw, 4rem); line-height: 1.2;">
            Discover Local <span style="color: #EB3223;">Businesses</span>
        </h1>
        <p style="color: #ffffff !important; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: clamp(0.95rem, 2.5vw, 1.5rem); max-width: 1262px; margin-bottom: clamp(20px, 5vw, 30px); line-height: 1.5;">
            Connect with our diverse community of innovative businesses and entrepreneurs driving economic growth and excellence in Valenzuela City.
        </p>
        
        {{-- RESPONSIVE SEARCH BAR --}}
        <div class="w-100" style="max-width: 782px; padding: 0 clamp(0.5rem, 2vw, 1rem);">
            <div class="input-group shadow-sm rounded overflow-hidden border-0 align-items-center d-flex flex-column flex-sm-row" style="background-color: var(--bg-input); padding: clamp(4px, 2vw, 8px); gap: clamp(0.5rem, 1vw, 1rem);">
                <div class="d-flex w-100 align-items-center flex-grow-1">
                    <span class="input-group-text border-0 ps-2 ps-sm-3 bg-transparent"><i class="bi bi-search text-secondary"></i></span>
                    <input type="text" class="form-control border-0 shadow-none text-secondary bg-transparent py-2 py-sm-3" placeholder="Search businesses, services..." id="searchInput">
                </div>
                <button class="btn text-white fw-bold text-uppercase w-100 w-sm-auto" style="background-color: #D40032; border-radius: 6px; padding: clamp(8px 12px, 2vw, 12px 30px); font-size: clamp(0.85rem, 2vw, 1rem); min-height: 44px;" onclick="handleSearch()">Search</button>
            </div>
        </div>
    </div>
</div>

{{-- Filters & Listing Section --}}
<div class="py-4 py-sm-5" style="background-color: var(--bg-section); transition: background-color 0.3s ease;">
    <div class="w-100 mb-4 mb-sm-5" style="border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">
        <div class="container px-2 px-sm-3 px-lg-5">
            {{-- RESPONSIVE FILTERS --}}
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center gap-2 gap-sm-3 py-3 py-sm-4">
                
                <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 w-100 w-lg-auto justify-content-center justify-content-sm-start">
                    <select class="form-select form-select-sm border-0 shadow-sm flex-grow-1 flex-sm-grow-0" style="background-color: var(--bg-input); color: var(--text-main); padding: clamp(8px, 2vw, 12px); font-size: clamp(0.85rem, 2vw, 1rem); min-height: 40px;">
                        <option selected>All Categories</option>
                    </select>

                    <select class="form-select form-select-sm border-0 shadow-sm flex-grow-1 flex-sm-grow-0" style="background-color: var(--bg-input); color: var(--text-main); padding: clamp(8px, 2vw, 12px); font-size: clamp(0.85rem, 2vw, 1rem); min-height: 40px;">
                        <option selected>All Locations</option>
                    </select>

                    <select class="form-select form-select-sm border-0 shadow-sm flex-grow-1 flex-sm-grow-0" style="background-color: var(--bg-input); color: var(--text-main); padding: clamp(8px, 2vw, 12px); font-size: clamp(0.85rem, 2vw, 1rem); min-height: 40px;" id="sortSelect" onchange="handleSort()">
                        <option value="asc">Sort: A-Z</option>
                        <option value="desc">Sort: Z-A</option>
                    </select>
                </div>

                <div class="small fw-medium text-center text-lg-end w-100 w-lg-auto" style="color: var(--text-muted); font-family: 'DM Sans', sans-serif; font-size: clamp(0.8rem, 1.5vw, 0.9rem);" id="showingText">
                    Loading results...
                </div>
            </div>
        </div>
    </div>

    {{-- CARD GRID --}}
    <div class="container px-2 px-sm-3 px-lg-5">
        <div class="row g-2 g-sm-3 g-lg-4" id="businessGrid">
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-arrow-repeat" style="display:inline-block; animation: spin 1s linear infinite; font-size: 2rem;"></i>
                <p class="mt-2">Fetching local businesses...</p>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4 mt-sm-5 d-flex justify-content-center overflow-auto">
            <nav aria-label="Page navigation">
                <ul class="pagination flex-wrap justify-content-center gap-1" id="paginationContainer" style="font-size: clamp(0.85rem, 2vw, 1rem);"></ul>
            </nav>
        </div>
    </div>
</div>

{{-- ======== DYNAMIC FETCH LOGIC ======== --}}
<script>
    let allBusinesses = [];
    let masterBusinesses = []; 
    let currentPage = 1;
    const perPage = 12;

    document.addEventListener('DOMContentLoaded', function() {
        fetchBusinesses();
        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') handleSearch();
        });
    });

    async function fetchBusinesses() {
        try {
            const token = localStorage.getItem('token');
            const headers = { 'Accept': 'application/json' };
            if (token) headers['Authorization'] = `Bearer ${token}`;

            const response = await fetch(`${window.API_BASE_URL}/v1/business`, {
                method: 'GET',
                headers: headers
            });

            if (!response.ok) throw new Error("Failed to fetch");

            const result = await response.json();
            
            masterBusinesses = result.data || result || [];
            allBusinesses = [...masterBusinesses];

            sortData('asc');
            renderPage(1);

        } catch (error) {
            console.error('Error fetching businesses:', error);
            document.getElementById('businessGrid').innerHTML = `
                <div class="col-12 text-center py-5" style="color: #D40032;">
                    <h5><i class="bi bi-exclamation-triangle"></i> Failed to load businesses.</h5>
                    <p>Make sure your server is running and connected to the internet!</p>
                </div>
            `;
            document.getElementById('showingText').innerText = "0 results";
        }
    }

    function renderPage(page) {
        currentPage = page;
        const totalResults = allBusinesses.length;
        const totalPages = Math.ceil(totalResults / perPage);
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;

        const offset = (currentPage - 1) * perPage;
        const pagedData = allBusinesses.slice(offset, offset + perPage);

        const showingStart = totalResults === 0 ? 0 : offset + 1;
        const showingEnd = Math.min(offset + perPage, totalResults);
        document.getElementById('showingText').innerText = `Showing ${showingStart}-${showingEnd} of ${totalResults} results`;

        const grid = document.getElementById('businessGrid');
        grid.innerHTML = '';

        if (totalResults === 0) {
            grid.innerHTML = '<div class="col-12 text-center text-muted py-5">No businesses found.</div>';
            renderPagination(0);
            return;
        }

        pagedData.forEach((biz, index) => {
            const name = biz.registered_business_name || 'Unknown Business';
            const email = biz.email || 'N/A';
            const phone = biz.telephone_no || 'N/A';
            const industry = biz.industry || 'Business';
            const tagline = biz.business_tagline || '';
            const tags = (Array.isArray(biz.tags)) ? biz.tags : [];
            const absoluteIndex = (currentPage - 1) * perPage + index;
            const profileUrl = `/business/${absoluteIndex}`;

            let avatarHTML = '';
            if (biz.photo_url && !biz.photo_url.includes('N/A') && !biz.photo_url.includes('null')) {
                avatarHTML = `<img src="${biz.photo_url}" alt="${name}" style="width: 56px; height: 56px; object-fit: cover;" class="rounded-circle shadow-sm">`;
            } else {
                const words = name.split(' ');
                let initials = name.substring(0, 2).toUpperCase();
                if (words.length > 1) initials = (words[0][0] + words[1][0]).toUpperCase();
                const colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info', 'bg-danger'];
                const colorIndex = absoluteIndex % colors.length;
                avatarHTML = `<div class="rounded-circle ${colors[colorIndex]} d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 56px; height: 56px; font-size: 1.2rem;">${initials}</div>`;
            }

            const cardHTML = `
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm p-2 p-sm-3" style="border-radius: 12px; background-color: var(--bg-card);">
                        <div class="d-flex align-items-center gap-2 gap-sm-3 mb-2 mb-sm-3">
                            ${avatarHTML}
                            <div style="width: calc(100% - 70px);">
                                <span class="d-inline-block rounded px-2 py-1 mb-1 fw-bold text-uppercase text-truncate" style="font-size: clamp(0.6rem, 1.5vw, 0.75rem); background-color: #fdf2f2; color: #be1e38; max-width: 100%;">
                                    ${industry}
                                </span>
                                <h5 class="fw-bold mb-1 text-truncate" style="color: var(--text-main); font-size: clamp(0.95rem, 2vw, 1.25rem);" title="${name}">${name}</h5>
                                ${tagline ? `<small class="text-truncate d-block" style="color: #888; font-style: italic; font-size: clamp(0.75rem, 1.5vw, 0.9rem);" title="${tagline}">"${tagline}"</small>` : ''}
                            </div>
                        </div>
                        <div class="card-body p-0 d-flex flex-column flex-grow-1">
                            <div class="mb-2 mb-sm-3">
                                <div class="d-flex gap-1 gap-sm-2 small flex-wrap">
                                    ${tags.map(tag => `<span class="bg-body-secondary px-2 py-1 rounded text-capitalize" style="color: #1a1a2e !important; font-weight: 600; font-size: clamp(0.7rem, 1.5vw, 0.85rem);">${tag}</span>`).join('')}
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-start mt-auto pt-2 pt-sm-3 border-top gap-2 gap-sm-3" style="border-color: var(--border-color) !important;">
                                <div class="small text-truncate w-100" style="color: var(--text-muted); font-size: clamp(0.75rem, 1.5vw, 0.9rem);">
                                    <i class="bi bi-envelope"></i> <span title="${email}" class="d-inline-block text-truncate" style="max-width: 150px;">${email}</span><br>
                                    <i class="bi bi-telephone"></i> ${phone}
                                </div>
                                <a href="${profileUrl}" class="btn py-2 px-3 text-white fw-bold text-nowrap text-center" style="background-color: #D40032; border-radius: 6px; font-size: clamp(0.8rem, 1.5vw, 0.95rem); min-height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            grid.insertAdjacentHTML('beforeend', cardHTML);
        });

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        const pagContainer = document.getElementById('paginationContainer');
        pagContainer.innerHTML = '';
        if (totalPages <= 1) return;

        pagContainer.innerHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link border-0" style="background-color: transparent; color: var(--text-muted); cursor: pointer;" onclick="renderPage(${currentPage - 1})">Previous</a>
            </li>
        `;

        for (let p = 1; p <= totalPages; p++) {
            const isActive = currentPage === p;
            pagContainer.innerHTML += `
                <li class="page-item ${isActive ? 'active' : ''}">
                    <a class="page-link border-0 rounded mx-1 ${isActive ? 'bg-danger text-white shadow-sm' : ''}" 
                       style="${!isActive ? 'background-color: transparent; color: var(--text-muted); cursor: pointer;' : 'cursor: default;'}"
                       onclick="renderPage(${p})">
                        ${p}
                    </a>
                </li>
            `;
        }

        pagContainer.innerHTML += `
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link border-0" style="background-color: transparent; color: var(--text-muted); cursor: pointer;" onclick="renderPage(${currentPage + 1})">Next</a>
            </li>
        `;
    }

    function handleSort() {
        const order = document.getElementById('sortSelect').value;
        sortData(order);
        renderPage(1); 
    }

    function sortData(order) {
        allBusinesses.sort((a, b) => {
            const nameA = (a.registered_business_name || '').toLowerCase();
            const nameB = (b.registered_business_name || '').toLowerCase();
            if (order === 'asc') return nameA.localeCompare(nameB);
            return nameB.localeCompare(nameA);
        });
    }

    function handleSearch() {
        const term = document.getElementById('searchInput').value.trim().toLowerCase();

        if (!term) {
            allBusinesses = [...masterBusinesses];
        } else {
            allBusinesses = masterBusinesses.filter(biz => {
                const name = (biz.registered_business_name || '').toLowerCase();
                const industry = (biz.industry || '').toLowerCase();
                const tagline = (biz.business_tagline || '').toLowerCase();
                const email = (biz.email || '').toLowerCase();
                const tags = (Array.isArray(biz.tags) ? biz.tags.join(' ') : '').toLowerCase();
                return name.includes(term) || industry.includes(term) || tagline.includes(term) || email.includes(term) || tags.includes(term);
            });
        }
        const order = document.getElementById('sortSelect').value;
        sortData(order);
        renderPage(1);
    }
</script>

<style>
    .text-truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    @keyframes spin { 100% { transform: rotate(360deg); } }
    
    /* ========================================
       RESPONSIVE ENHANCEMENTS
       ======================================== */
    
    /* Mobile optimizations */
    @media (max-width: 576px) {
        .pagination .page-link {
            padding: 0.375rem 0.5rem !important;
        }
        .form-select {
            font-size: 0.9rem !important;
        }
    }
    
    /* Touch-friendly elements */
    @media (max-width: 768px) {
        .btn, .form-select, .form-control {
            min-height: 44px;
        }
    }
    
    /* Tablet adjustments */
    @media (min-width: 576px) and (max-width: 768px) {
        .w-sm-auto { width: auto !important; }
    }
    
    /* Card text responsiveness */
    @media (max-width: 480px) {
        .card-body .small {
            font-size: 0.75rem !important;
        }
    }
</style>

@endsection