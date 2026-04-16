@extends('layouts.app')

@section('title', 'Events - PCCI Valenzuela')

@section('content')
@include('partials.api-config')

{{-- HERO SECTION --}}
<div class="w-100 mb-0 d-flex flex-column align-items-center" style="
    min-height: 500px;
    margin-top: -1px;
    background-color: var(--bg-hero);
    background-size: cover;
    background-position: center;
    padding-top: 130px;
    padding-bottom: 50px;
    transition: background-color 0.3s ease;
">
    <div class="container d-flex flex-column align-items-center text-center px-3">

        <span class="mb-3 d-block"
            style="color: #ffffff !important; font-family: 'DM Sans', sans-serif; font-weight: 900; font-size: clamp(1rem, 3vw, 1.5rem); line-height: 100%; letter-spacing: 0; text-transform: uppercase; width: 100%; text-align: center;">
            PCCI - VALENZUELA
        </span>

        <h1 class="headline-text fw-bold mb-4 text-uppercase"
            style="color: #ffffff !important; font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: clamp(3rem, 8vw, 4rem); line-height: 100%; letter-spacing: 0;">
            Events
        </h1>

        <p style="color: #ffffff !important; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: clamp(1rem, 3vw, 1.5rem); line-height: 1.5; text-align: center; width: 100%; max-width: 1000px; margin: 0 auto;">
            Join our community events designed to foster networking, learning, and business growth opportunities for all chamber members.
        </p>
    </div>
</div>

<div class="py-5" style="background-color: var(--bg-section); transition: background-color 0.3s ease;">
    <div class="container mb-5 px-3 px-lg-4">

        {{-- RESPONSIVE FILTERS & SEARCH --}}
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center mb-5 gap-3">
            <div class="w-100 w-lg-50" style="max-width: 500px;">
                <div class="input-group shadow-sm rounded overflow-hidden border-0" style="background-color: var(--bg-input);">
                    <span class="input-group-text border-0 ps-3 bg-transparent">
                        <i class="bi bi-search text-secondary" style="font-size: 1.1rem;"></i>
                    </span>
                    <input type="text" id="eventSearchInput" class="form-control border-0 py-3 shadow-none text-secondary bg-transparent"
                           style="font-family: 'DM Sans', sans-serif;"
                           placeholder="Search events by title or location..." aria-label="Search"
                           oninput="filterEvents()">
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 w-100 w-lg-auto justify-content-center justify-content-lg-end" style="font-family: 'DM Sans', sans-serif;">
                <select id="eventCategoryFilter" class="form-select border-0 shadow-sm flex-grow-1 flex-sm-grow-0" onchange="filterEvents()" style="padding: 12px 30px 12px 15px; background-color: var(--bg-input); color: var(--text-main);">
                    <option value="" selected>All Categories</option>
                </select>

                <select id="eventStatusFilter" class="form-select border-0 shadow-sm flex-grow-1 flex-sm-grow-0" onchange="filterEvents()" style="padding: 12px 30px 12px 15px; background-color: var(--bg-input); color: var(--text-main);">
                    <option value="" selected>All Status</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <div id="eventsGrid" class="row g-4">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2" style="color: var(--text-muted); font-family: 'DM Sans', sans-serif;">Loading events...</p>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 gap-3">
            <div id="eventsShowingText" class="small fw-medium text-center text-md-start w-100 w-md-auto" style="color: var(--text-muted); font-family: 'DM Sans', sans-serif;"></div>
            <nav class="overflow-auto w-100 w-md-auto d-flex justify-content-center justify-content-md-end">
                <ul class="pagination mb-0 flex-wrap justify-content-center gap-1" id="eventsPagination"></ul>
            </nav>
        </div>

    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; background-color: var(--bg-card);">
            <div class="modal-header border-0 pb-0 pt-4 px-4 align-items-start">
                <div>
                    <span id="modalCategory" class="d-inline-block rounded px-2 py-1 mb-2 fw-bold text-uppercase"
                          style="font-family: 'DM Sans', sans-serif; font-size: 0.65rem; background-color: #fff1f3; color: #D40032; letter-spacing: 0.05em;">
                    </span>
                    <h4 id="modalTitle" class="modal-title fw-bold" style="font-family: 'Poppins', sans-serif; color: var(--text-main); font-size: clamp(1.25rem, 4vw, 1.5rem);"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-5">
                        <img id="modalImage" src=""
                             class="w-100 object-fit-cover shadow-sm rounded"
                             style="height: 250px;" alt="Event Detail">
                        <div id="modalImagePlaceholder" class="w-100 shadow-sm rounded d-flex align-items-center justify-content-center"
                             style="height: 250px; background: linear-gradient(135deg,#c0392b,#7d1a1a); display: none;">
                            <i class="bi bi-calendar-event text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                        </div>
                        <div class="mt-3 p-3 rounded" style="font-family: 'DM Sans', sans-serif; background-color: var(--bg-section);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-calendar-check text-danger me-3 fs-5"></i>
                                <div><small class="d-block" style="font-size: 0.75rem; color: var(--text-muted);">Date</small><strong id="modalDate" style="font-size: 0.9rem; color: var(--text-main);"></strong></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-clock text-danger me-3 fs-5"></i>
                                <div><small class="d-block" style="font-size: 0.75rem; color: var(--text-muted);">Time</small><strong id="modalTime" style="font-size: 0.9rem; color: var(--text-main);"></strong></div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt text-danger me-3 fs-5"></i>
                                <div style="width: calc(100% - 40px);"><small class="d-block" style="font-size: 0.75rem; color: var(--text-muted);">Location</small><strong id="modalLocation" class="d-block text-truncate" style="font-size: 0.9rem; color: var(--text-main);"></strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 d-flex flex-column">
                        <div id="modalDescription" style="font-family: 'DM Sans', sans-serif; font-size: 0.95rem; line-height: 1.7; max-height: 300px; overflow-y: auto; padding-right: 10px; color: var(--text-main);">
                        </div>
                        <div class="mt-4 mt-md-auto pt-3">
                            <button class="btn text-white w-100 fw-bold text-uppercase py-3"
                                    style="font-family: 'DM Sans', sans-serif; background-color: #D40032; border-radius: 6px; letter-spacing: 0.05em;">
                                Register for this Event
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let allEvents = [];
let allCategories = [];
let filteredEvents = [];
let eventsCurrentPage = 1;
const eventsPerPage = 9; 

document.addEventListener('DOMContentLoaded', function() {
    fetchLandingEvents();
    fetchLandingCategories();
});

async function fetchLandingEvents() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/v1/events`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await response.json();
        if (response.ok) {
            allEvents = data.data ? data.data : (Array.isArray(data) ? data : []);
            filterEvents();
        } else {
            document.getElementById('eventsGrid').innerHTML =
                '<div class="col-12 text-center py-5"><p class="text-danger">Failed to load events.</p></div>';
        }
    } catch (err) {
        console.error('Error fetching events:', err);
        document.getElementById('eventsGrid').innerHTML =
            '<div class="col-12 text-center py-5"><p class="text-danger">Network error loading events.</p></div>';
    }
}

async function fetchLandingCategories() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/v1/categories`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await response.json();
        if (response.ok) {
            allCategories = data.data ? data.data : (Array.isArray(data) ? data : []);
            const select = document.getElementById('eventCategoryFilter');
            allCategories.forEach(cat => {
                const name = cat.name || cat.category_name || cat.title || 'Unknown';
                const opt = document.createElement('option');
                opt.value = String(cat.id);
                opt.textContent = name;
                select.appendChild(opt);
            });
        }
    } catch (err) {
        console.error('Error fetching categories:', err);
    }
}

function getEventImageSrc(ev) {
    const rawImg = ev.imagel || ev.image || null;
    if (!rawImg) return null;
    if (rawImg.startsWith('http') || rawImg.startsWith('data:')) return rawImg;
    const apiOrigin = window.API_BASE_URL.replace(/\/api\/?$/, '');
    return apiOrigin + '/storage/' + rawImg;
}

function getEventCategory(ev) {
    if (ev.category && typeof ev.category === 'object') return ev.category.name || 'General';
    if (typeof ev.category === 'string') return ev.category;
    return 'General';
}

function getStatusBadgeClass(status) {
    switch ((status || '').toLowerCase()) {
        case 'upcoming': return 'bg-success';
        case 'ongoing': return 'bg-primary';
        case 'completed': return 'bg-secondary';
        case 'cancelled': return 'bg-danger';
        default: return 'bg-secondary';
    }
}

function filterEvents() {
    const search = (document.getElementById('eventSearchInput').value || '').toLowerCase();
    const catFilter = document.getElementById('eventCategoryFilter').value;
    const statusFilter = document.getElementById('eventStatusFilter').value;

    filteredEvents = allEvents.filter(ev => {
        const title = (ev.title || '').toLowerCase();
        const desc = (ev.description || '').toLowerCase();
        const loc = (ev.location || '').toLowerCase();
        const matchSearch = !search || title.includes(search) || desc.includes(search) || loc.includes(search);
        const evCatId = ev.category_id || (ev.category && ev.category.id) || '';
        const matchCat = !catFilter || String(evCatId) === catFilter;
        const matchStatus = !statusFilter || (ev.status || '').toLowerCase() === statusFilter;

        return matchSearch && matchCat && matchStatus;
    });

    eventsCurrentPage = 1;
    renderEventsPage();
}

function renderEventsPage() {
    const total = filteredEvents.length;
    const totalPages = Math.ceil(total / eventsPerPage);

    if (eventsCurrentPage < 1) eventsCurrentPage = 1;
    if (eventsCurrentPage > totalPages) eventsCurrentPage = totalPages || 1;

    const start = (eventsCurrentPage - 1) * eventsPerPage;
    const pageEvents = filteredEvents.slice(start, start + eventsPerPage);

    renderEvents(pageEvents);

    const showingEl = document.getElementById('eventsShowingText');
    if (total === 0) {
        showingEl.textContent = '0 results';
    } else {
        showingEl.textContent = `Showing ${start + 1}-${Math.min(start + eventsPerPage, total)} of ${total} events`;
    }

    renderEventsPagination(totalPages);
}

function renderEventsPagination(totalPages) {
    const container = document.getElementById('eventsPagination');
    container.innerHTML = '';
    if (totalPages <= 1) return;

    container.innerHTML += `
        <li class="page-item ${eventsCurrentPage === 1 ? 'disabled' : ''}">
            <a class="page-link border-0 shadow-sm" style="cursor:pointer;color:var(--text-muted);background:var(--bg-input,#fff);" onclick="goToEventsPage(${eventsCurrentPage - 1})">Previous</a>
        </li>`;

    for (let p = 1; p <= totalPages; p++) {
        const isActive = eventsCurrentPage === p;
        container.innerHTML += `
            <li class="page-item ${isActive ? 'active' : ''}">
                <a class="page-link border-0 rounded mx-1 ${isActive ? 'text-white shadow-sm' : ''}"
                   style="${isActive ? 'background-color:#D40032;cursor:default;' : 'background:var(--bg-input,#fff);color:var(--text-muted);cursor:pointer;'}"
                   onclick="goToEventsPage(${p})">${p}</a>
            </li>`;
    }

    container.innerHTML += `
        <li class="page-item ${eventsCurrentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link border-0 shadow-sm" style="cursor:pointer;color:var(--text-muted);background:var(--bg-input,#fff);" onclick="goToEventsPage(${eventsCurrentPage + 1})">Next</a>
        </li>`;
}

function goToEventsPage(page) {
    const totalPages = Math.ceil(filteredEvents.length / eventsPerPage);
    if (page < 1 || page > totalPages) return;
    eventsCurrentPage = page;
    renderEventsPage();
    document.getElementById('eventsGrid').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function renderEvents(events) {
    const grid = document.getElementById('eventsGrid');

    if (!events.length) {
        grid.innerHTML = '<div class="col-12 text-center py-5"><p style="color: var(--text-muted); font-family: \'DM Sans\', sans-serif;">No events found.</p></div>';
        return;
    }

    grid.innerHTML = events.map(ev => {
        const category = getEventCategory(ev);
        const status = ev.status || 'Upcoming';
        const badgeClass = getStatusBadgeClass(status);
        const title = ev.title || 'Untitled Event';
        const date = ev.date || 'TBA';
        const time = ev.time || 'TBA';
        const location = ev.location || 'TBA';
        const evId = ev.id;

        return `
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background-color: var(--bg-card);">
                <div class="position-relative mb-3 overflow-hidden rounded event-img-wrap" data-event-id="${evId}" style="height: 200px;">
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                         style="background: linear-gradient(135deg,#c0392b,#7d1a1a);">
                        <i class="bi bi-calendar-event text-white" style="font-size: 2.5rem; opacity: 0.7;"></i>
                    </div>
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge ${badgeClass} shadow-sm text-uppercase"
                              style="font-family: 'DM Sans', sans-serif; font-size: 0.7rem; letter-spacing: 0.05em;">
                            ${status}
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column flex-grow-1">
                    <span class="d-inline-block rounded px-2 py-1 mb-2 fw-bold text-uppercase align-self-start"
                          style="font-family: 'DM Sans', sans-serif; font-size: 0.65rem; background-color: #fff1f3; color: #D40032; letter-spacing: 0.05em;">
                        ${category}
                    </span>
                    <h5 class="fw-bold mb-2 text-truncate w-100" style="font-family: 'Poppins', sans-serif; font-size: 1.15rem; line-height: 1.4; color: var(--text-main);" title="${title}">
                        ${title}
                    </h5>
                    <div class="d-flex flex-column gap-2 small mb-3" style="font-family: 'DM Sans', sans-serif; color: var(--text-muted);">
                        <div class="d-flex align-items-center gap-2"><i class="bi bi-calendar3 text-danger"></i><span>${date}</span></div>
                        <div class="d-flex align-items-center gap-2"><i class="bi bi-clock text-danger"></i><span>${time}</span></div>
                        <div class="d-flex align-items-center gap-2 w-100"><i class="bi bi-geo-alt text-danger"></i><span class="text-truncate">${location}</span></div>
                    </div>
                    <div class="mt-auto pt-3 d-flex justify-content-end" style="border-top: 1px solid var(--border-color);">
                        <button type="button" class="btn py-2 px-3 text-white fw-bold d-flex align-items-center justify-content-center gap-2 w-100 w-sm-auto"
                                onclick="openEventModal(${evId})"
                                style="font-family: 'DM Sans', sans-serif; font-size: 0.85rem; background-color: #D40032; border-radius: 6px; letter-spacing: 0.05em;">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>`;
    }).join('');

    events.forEach(ev => {
        const imgSrc = getEventImageSrc(ev);
        if (!imgSrc) return;
        const wrap = grid.querySelector(`.event-img-wrap[data-event-id="${ev.id}"]`);
        if (!wrap) return;
        const placeholder = wrap.querySelector('div');
        const img = document.createElement('img');
        img.className = 'w-100 h-100 object-fit-cover position-absolute top-0 start-0';
        img.alt = ev.title || 'Event';
        img.style.zIndex = '1';
        img.onload = function() { placeholder.style.display = 'none'; };
        img.onerror = function() { this.style.display = 'none'; };
        img.src = imgSrc;
        wrap.insertBefore(img, wrap.firstChild);
    });
}

function openEventModal(id) {
    const ev = allEvents.find(e => e.id === id);
    if (!ev) return;

    document.getElementById('modalTitle').textContent = ev.title || 'Untitled Event';
    document.getElementById('modalCategory').textContent = getEventCategory(ev);
    document.getElementById('modalDate').textContent = ev.date || 'TBA';
    document.getElementById('modalTime').textContent = ev.time || 'TBA';
    document.getElementById('modalLocation').textContent = ev.location || 'TBA';

    const desc = ev.description || ev.desc || 'No description provided.';
    document.getElementById('modalDescription').innerHTML = desc.split('\n').map(p => `<p>${p}</p>`).join('');

    const imgSrc = getEventImageSrc(ev);
    const modalImg = document.getElementById('modalImage');
    const modalPlaceholder = document.getElementById('modalImagePlaceholder');
    if (imgSrc) {
        modalImg.src = imgSrc;
        modalImg.style.display = 'block';
        modalPlaceholder.style.display = 'none';
        modalImg.onerror = function() {
            this.style.display = 'none';
            modalPlaceholder.style.display = 'flex';
        };
    } else {
        modalImg.style.display = 'none';
        modalPlaceholder.style.display = 'flex';
    }

    const modal = new bootstrap.Modal(document.getElementById('eventModal'));
    modal.show();
}
</script>

<style>
    .w-lg-50 { width: 50% !important; }
    @media (max-width: 991.98px) { .w-lg-50 { width: 100% !important; } }
    @media (min-width: 576px) { .w-sm-auto { width: auto !important; } }
</style>

@endsection