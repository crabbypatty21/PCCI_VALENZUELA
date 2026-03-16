@extends('layouts.admin')

@section('title', 'Applicants - PCCI')

@section('content')
@include('partials.api-config')

<style>
    /* ============================================== */
    /* APPLICANTS LISTING PAGE                        */
    /* ============================================== */

    /* --- Standard Header Banner --- */
    .applicant-header-banner {
        background-color: var(--pcci-red, #be1e38);
        color: #fff;
        padding: 24px 30px; 
        border-radius: 8px;
        font-size: 1.6rem; 
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 24px; 
        letter-spacing: 1px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    /* --- Grid Layout (Natural Page Scrolling) --- */
    .applicant-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); 
        gap: 16px; 
        /* Removed the max-height lock so the whole page scrolls normally */
    }

    /* --- Individual Card --- */
    .applicant-card {
        border: 1.5px solid #eee;
        border-top: 3px solid var(--pcci-red, #be1e38);
        border-radius: 8px;
        padding: 20px 16px; 
        background: #fff;
        text-align: center;
        text-decoration: none;
        color: inherit;
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .applicant-card:hover {
        border-color: var(--pcci-red, #be1e38);
        box-shadow: 0 6px 16px rgba(190, 30, 56, 0.12);
        transform: translateY(-3px);
        color: inherit;
    }

    /* Text wraps naturally now instead of hiding */
    .applicant-card-name {
        font-size: 1.05rem; 
        font-weight: 800;
        color: #111;
        text-transform: uppercase;
        margin-bottom: 6px;
        width: 100%;
        word-wrap: break-word; /* Allows long text to go to the next line */
        line-height: 1.3;
    }

    /* Text wraps naturally now instead of hiding */
    .applicant-card-industry {
        font-size: 0.85rem; 
        color: #666;
        margin-bottom: 12px;
        width: 100%;
        word-wrap: break-word; /* Allows long text to go to the next line */
        line-height: 1.4;
    }

    .applicant-card-id {
        font-size: 0.75rem;
        color: #888;
        font-family: monospace;
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 6px;
        margin-bottom: 12px;
    }

    /* --- Status Badge --- */
    .applicant-status {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 50rem;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: auto; /* Pushes the badge to the bottom of the card */
    }

    .status-pending { background-color: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; }
    .status-approved { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .status-rejected { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    /* Messages */
    .grid-message {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        color: #666;
        font-size: 1.1rem;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px dashed #ccc;
    }

    @media (max-width: 576px) {
        .applicant-header-banner { padding: 20px 24px; font-size: 1.4rem; }
    }
</style>

{{-- ======== RED HEADER BANNER ======== --}}
<div class="applicant-header-banner">
    Applicants
</div>

{{-- ======== APPLICANT CARD GRID ======== --}}
<div class="applicant-grid" id="applicantGrid">
    <div class="grid-message"><i class="fa fa-spinner fa-spin me-2"></i> Loading applicants...</div>
</div>

{{-- ======== DYNAMIC FETCH LOGIC ======== --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('token');
        
        if (!token) {
            window.location.href = '/login';
            return;
        }
        
        fetchApplicantsList(token);
    });

    async function fetchApplicantsList(token) {
        const grid = document.getElementById('applicantGrid');

        try {
            const response = await fetch(`${window.API_BASE_URL}/v1/applicants`, {
                headers: { 
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (response.status === 401) {
                localStorage.removeItem('token');
                window.location.href = '/login';
                return;
            }

            const result = await response.json();

            if (response.ok && result.data) {
                renderApplicantCards(result.data);
            } else {
                grid.innerHTML = `<div class="grid-message" style="color: #b91c1c;">Failed to load applicants: ${result.message || 'Unknown error'}</div>`;
            }
        } catch (error) {
            console.error('Error fetching applicants:', error);
            grid.innerHTML = '<div class="grid-message" style="color: #b91c1c;">Network error. Please try again later.</div>';
        }
    }

    function renderApplicantCards(applicants) {
        const grid = document.getElementById('applicantGrid');
        grid.innerHTML = ''; // Clear loading message

        if (applicants.length === 0) {
            grid.innerHTML = '<div class="grid-message">No applicants found.</div>';
            return;
        }

        applicants.forEach(app => {
            const safe = (val) => val || 'N/A';
            const profile = app.basic_profile || {};
            const org = app.organization_membership || {};

            const companyName = safe(profile.registered_business_name);
            const industry = safe(org.type_of_company);
            const statusRaw = safe(app.status).toLowerCase();
            const idString = `ID-${String(app.id).padStart(4, '0')}`;

            let statusClass = 'status-pending';
            let iconClass = 'bi-clock';
            
            if (statusRaw === 'approved') {
                statusClass = 'status-approved';
                iconClass = 'bi-check-circle';
            } else if (statusRaw === 'rejected' || statusRaw === 'declined') {
                statusClass = 'status-rejected';
                iconClass = 'bi-x-circle';
            }

            const displayStatus = statusRaw.charAt(0).toUpperCase() + statusRaw.slice(1);
            const profileUrl = `/applicant/${app.id}`;

            const cardHtml = `
                <a href="${profileUrl}" class="applicant-card">
                    <div class="applicant-card-name">${companyName}</div>
                    <div class="applicant-card-industry">${industry}</div>
                    <div class="applicant-card-id">${idString}</div>
                    <span class="applicant-status ${statusClass}">
                        <i class="bi ${iconClass}"></i> ${displayStatus}
                    </span>
                </a>
            `;

            grid.insertAdjacentHTML('beforeend', cardHtml);
        });
    }
</script>
@endsection