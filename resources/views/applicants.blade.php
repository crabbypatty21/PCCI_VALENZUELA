@extends('layouts.admin')

@section('title', 'Applicants - PCCI')

@section('content')
@include('partials.api-config')

<style>
    /* ============================================== */
    /* APPLICANTS LISTING PAGE                        */
    /* ============================================== */

    .applicant-header-banner {
        background-color: var(--pcci-red, #be1e38);
        color: #fff;
        padding: 36px 40px;
        border-radius: 12px;
        font-size: 2rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 30px;
        letter-spacing: 1px;
    }

    /* --- Card Grid --- */
    .applicant-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    /* --- Individual Card --- */
    .applicant-card {
        border: 2px solid #ff0000;
        border-top: 3px solid var(--pcci-red, #be1e38);
        border-radius: 10px;
        padding: 24px 20px;
        background: #fff;
        text-align: center;
        text-decoration: none;
        color: inherit;
        transition: all 0.2s ease;
        display: block;
    }

    .applicant-card:hover {
        border-color: var(--pcci-red, #be1e38);
        box-shadow: 0 6px 20px rgba(190, 30, 56, 0.1);
        transform: translateY(-2px);
        color: inherit;
        text-decoration: none;
    }

    .applicant-card-name {
        font-size: 1rem;
        font-weight: 700;
        color: #111;
        text-transform: uppercase;
        margin-bottom: 4px;
        letter-spacing: 0.3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .applicant-card-industry {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .applicant-card-id {
        font-size: 0.8rem;
        color: #888;
        font-family: monospace;
        margin-bottom: 12px;
    }

    /* --- Status Badge --- */
    .applicant-status {
        display: inline-block;
        padding: 5px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 4px;
    }

    .status-pending { background-color: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; }
    .status-approved { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .status-rejected { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    /* Messages */
    .grid-message {
        grid-column: 1 / -1;
        text-align: center;
        padding: 50px;
        color: #666;
        font-size: 1.1rem;
        background: #f9f9f9;
        border-radius: 10px;
        border: 1px dashed #ccc;
    }

    /* --- Responsive --- */
    @media (max-width: 992px) { .applicant-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) {
        .applicant-header-banner { padding: 20px 24px; font-size: 1.5rem; }
        .applicant-grid { grid-template-columns: 1fr; }
    }
</style>

{{-- ======== RED HEADER BANNER ======== --}}
<div class="applicant-header-banner">
    Applicants
</div>

{{-- ======== APPLICANT CARD GRID ======== --}}
<div class="applicant-grid" id="applicantGrid">
    <div class="grid-message">Loading applicants...</div>
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
            // Helpers to safely extract data from your API structure
            const safe = (val) => val || 'N/A';
            const profile = app.basic_profile || {};
            const org = app.organization_membership || {};

            const companyName = safe(profile.registered_business_name);
            const industry = safe(org.type_of_company);
            const statusRaw = safe(app.status).toLowerCase();
            const idString = `ID-${String(app.id).padStart(4, '0')}`;

            // Determine status styling
            let statusClass = 'status-pending';
            let iconClass = 'bi-clock';
            
            if (statusRaw === 'approved') {
                statusClass = 'status-approved';
                iconClass = 'bi-check-circle';
            } else if (statusRaw === 'rejected' || statusRaw === 'declined') {
                statusClass = 'status-rejected';
                iconClass = 'bi-x-circle';
            }

            // Capitalize status for display
            const displayStatus = statusRaw.charAt(0).toUpperCase() + statusRaw.slice(1);

            // Construct dynamic URL for the profile page
            const profileUrl = `/applicant/${app.id}`;

            // Create card HTML
            const cardHtml = `
                <a href="${profileUrl}" class="applicant-card">
                    <div class="applicant-card-name" title="${companyName}">${companyName}</div>
                    <div class="applicant-card-industry" title="${industry}">${industry}</div>
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