@extends('layouts.admin')

@section('title', 'Admin Dashboard - PCCI')

@section('content')
@include('partials.api-config')

<style>
    /* ============================================== */
    /* ALDRIN'S DASHBOARD STATS CSS                   */
    /* ============================================== */
    .dashboard-header-banner {
        background-color: var(--pcci-red, #be1e38);
        color: #fff;
        padding: 36px 40px;
        border-radius: 10px;
        font-size: 2rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 30px;
        letter-spacing: 1px;
    }
    .dashboard-stats { display: flex; gap: 24px; margin-bottom: 40px; }
    .dash-stat-card {
        border: 2px solid #ff0000; border-top: 3px solid var(--pcci-red, #be1e38);
        border-radius: 10px; padding: 20px 24px; background: #f9f9f9;
        width: 220px; min-height: 100px; display: flex; flex-direction: column;
        justify-content: space-between; text-decoration: none; color: inherit; transition: all 0.2s ease;
    }
    .dash-stat-card:hover { border-color: var(--pcci-red, #be1e38); box-shadow: 0 6px 20px rgba(190, 30, 56, 0.1); transform: translateY(-2px); text-decoration: none; color: inherit;}
    .dash-stat-card-title { font-size: 1rem; font-weight: 800; text-transform: uppercase; color: #111; letter-spacing: 0.3px; }
    .dash-stat-card-value { display: flex; align-items: center; justify-content: flex-end; gap: 8px; margin-top: 16px; }
    .dash-stat-card-value i { color: var(--pcci-red, #be1e38); font-size: 1.3rem; }
    .dash-stat-card-value .count { font-size: 1.5rem; font-weight: 700; color: #111; }
    .count-loading {
        display: inline-block; width: 20px; height: 20px; border: 3px solid #eee;
        border-top: 3px solid var(--pcci-red, #be1e38); border-radius: 50%; animation: countSpin 0.8s linear infinite;
    }
    @keyframes countSpin { to { transform: rotate(360deg); } }

    /* ============================================== */
    /* PAUL'S APPLICANT LIST & MODAL CSS              */
    /* ============================================== */
    :root {
        --primary-red: #be1e38; --dark-bg: #222431; --card-bg: #2b2d3c; 
        --section-bg: #323545; --text-grey: #a0aec0; --text-white: #ffffff; --border-color: #4a4d61;
    }
    
    /* Applicant Cards */
    .applicant-card { background-color: var(--card-bg); border-radius: 12px; margin-bottom: 30px; border: 1px solid var(--border-color); overflow: hidden; color: var(--text-white); }
    .card-header { background-color: rgba(190, 30, 56, 0.1); padding: 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); }
    .card-header h3 { margin: 0; color: var(--primary-red); font-family: 'Poppins', sans-serif; }
    .status-badge { background-color: var(--primary-red); color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; text-transform: uppercase; font-weight: bold; }
    .card-body { padding: 25px; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
    .info-section { background-color: var(--section-bg); padding: 20px; border-radius: 8px; }
    .info-section h4 { margin-top: 0; margin-bottom: 15px; color: #fff; border-bottom: 1px solid var(--border-color); padding-bottom: 8px; font-size: 1rem; }
    .data-row { margin-bottom: 10px; font-size: 0.9rem; display: flex; flex-direction: column; }
    .data-row strong { color: var(--text-grey); font-size: 0.8rem; margin-bottom: 2px; }
    
    /* Modals */
    .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 1000; justify-content: center; align-items: center; }
    .modal-content { background: var(--card-bg); padding: 30px; border-radius: 12px; border: 1px solid var(--border-color); width: 100%; max-width: 400px; color: white;}
    .modal-content h3 { margin-top: 0; color: var(--primary-red); font-family: 'Poppins', sans-serif; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; color: var(--text-grey); font-size: 0.9rem;}
    .form-group input, .form-group select { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid var(--border-color); background: var(--dark-bg); color: white; }
    .btn { padding: 10px 15px; border-radius: 6px; border: none; cursor: pointer; font-weight: bold; }
    .btn-primary { background: var(--primary-red); color: white; width: 100%; transition: 0.3s; }
    .btn-primary:hover { opacity: 0.9; }
    .btn-secondary { background: var(--section-bg); color: white; margin-top: 10px; width: 100%; border: 1px solid var(--border-color); transition: 0.3s; }
    .alert { padding: 10px; border-radius: 6px; margin-bottom: 15px; display: none; }
    .alert-error { background: rgba(255,0,0,0.1); color: #ff6b6b; border: 1px solid #ff6b6b; }
    .alert-warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; border: 1px solid #ffc107; margin-top: 15px; font-size: 0.85rem;}
    .password-display { background: var(--dark-bg); padding: 15px; border-radius: 6px; font-family: monospace; font-size: 1.2rem; text-align: center; margin: 15px 0; border: 1px dashed var(--text-grey); }
</style>

{{-- ======== ALDRIN'S HEADER BANNER ======== --}}
<div class="dashboard-header-banner">
    Dashboard
</div>

{{-- ======== ALDRIN'S STAT CARDS ======== --}}
<div class="dashboard-stats">
    <a href="{{ route('members') }}" class="dash-stat-card">
        <div class="dash-stat-card-title">Members</div>
        <div class="dash-stat-card-value">
            <i class="bi bi-people-fill"></i>
            <span class="count" id="memberCount"><span class="count-loading"></span></span>
        </div>
    </a>
    <a href="{{ route('applicants') }}" class="dash-stat-card">
        <div class="dash-stat-card-title">Applicants</div>
        <div class="dash-stat-card-value">
            <i class="bi bi-person-fill"></i>
            <span class="count" id="applicantCount"><span class="count-loading"></span></span>
        </div>
    </a>
</div>

{{-- ======== PAUL'S LIST & ACTION HEADER ======== --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
    <h2 style="margin: 0; color: var(--dark-bg);">Membership Applicants</h2>
    <button class="btn btn-primary" style="width: auto;" onclick="openRegisterModal()">+ Register Treasurer</button>
</div>

<div id="applicants-list">
    <div style="text-align: center; padding: 50px; color: var(--text-grey); font-size: 1.2rem;">Loading applicants...</div>
</div>

{{-- ======== PAUL'S MODALS ======== --}}
<div id="registerModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Register New Treasurer</h3>
        <div id="registerError" class="alert alert-error"></div>
        <form id="registerForm" onsubmit="handleRegister(event)">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="regName" required placeholder="e.g. John Doe">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="regEmail" required placeholder="treasurer@example.com">
            </div>
            <button type="submit" id="regSubmitBtn" class="btn btn-primary">Register Account</button>
            <button type="button" class="btn btn-secondary" onclick="closeRegisterModal()">Cancel</button>
        </form>
    </div>
</div>

<div id="successModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Treasurer Created!</h3>
        <p style="color: var(--text-grey); font-size: 0.9rem;">The account for <strong id="successEmail" style="color: white;"></strong> has been successfully registered.</p>
        <div class="alert-warning" style="display: block;">
            <strong>⚠️ IMPORTANT:</strong> Copy this password now. For security reasons, it will only be displayed once.
        </div>
        <div class="password-display" id="generatedPassword"></div>
        <button class="btn btn-primary" onclick="copyPassword()" id="copyBtn">Copy Password</button>
        <button class="btn btn-secondary" onclick="closeSuccessModal()">I have copied the password (Close)</button>
    </div>
</div>

<div id="approveModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Approve Applicant</h3>
        <p style="color: var(--text-grey); font-size: 0.9rem;">Assign a membership type to finalize the approval.</p>
        <div id="approveError" class="alert alert-error"></div>
        <form id="approveForm" onsubmit="submitApprove(event)">
            <div class="form-group">
                <label>Membership Type</label>
                <select id="approveMembershipType" required>
                    <option value="Regular">Regular</option>
                    <option value="Life">Life</option>
                    <option value="Associate">Associate</option>
                    <option value="Chapter">Chapter</option>
                </select>
            </div>
            <button type="submit" id="approveSubmitBtn" class="btn btn-primary" style="background-color: #28a745;">Confirm Approval</button>
            <button type="button" class="btn btn-secondary" onclick="closeApproveModal()">Cancel</button>
        </form>
    </div>
</div>

{{-- ======== COMBINED JAVASCRIPT ======== --}}
<script>
    const token = localStorage.getItem('token');

    document.addEventListener('DOMContentLoaded', function() {
        if (!token) {
            window.location.href = '/login';
            return;
        } 
        
        // Execute Aldrin's Count fetches routing through your API_BASE_URL
        fetchCount(`${window.API_BASE_URL}/v1/members`, token, 'memberCount');
        fetchCount(`${window.API_BASE_URL}/v1/applicants`, token, 'applicantCount');
        
        // Execute Your Applicant Fetch
        fetchApplicants();
    });

    // --- ALDRIN'S STATS LOGIC ---
    async function fetchCount(url, token, elementId) {
        const el = document.getElementById(elementId);
        try {
            const headers = { 'Content-Type': 'application/json', 'Authorization': `Bearer ${token}` };
            const response = await fetch(url, { headers });
            const data = await response.json();

            if (response.ok) {
                let count = 0;
                if (Array.isArray(data)) count = data.length;
                else if (data.data && Array.isArray(data.data)) count = data.data.length;
                else if (data.total !== undefined) count = data.total;
                else if (data.count !== undefined) count = data.count;
                animateCount(el, count);
            } else { el.textContent = '0'; }
        } catch (err) { el.textContent = '—'; }
    }

    function animateCount(el, target) {
        let current = 0; const duration = 600; const steps = 30;
        const increment = target / steps; const stepTime = duration / steps;
        el.textContent = '0';
        if (target === 0) return;
        const timer = setInterval(function() {
            current += increment;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = Math.round(current);
        }, stepTime);
    }

    // --- PAUL'S LIST AND MODAL LOGIC ---
    async function fetchApplicants() {
        const container = document.getElementById('applicants-list');
        try {
            const response = await fetch(`${window.API_BASE_URL}/v1/applicants`, {
                headers: { 'Authorization': `Bearer ${token}` }
            });
            if (response.status === 401) { logout(); return; }
            const data = await response.json();
            if (response.ok && data.data) { renderApplicants(data.data); } 
            else { container.innerHTML = '<div style="color:var(--text-grey); text-align:center;">Failed to load applicants.</div>'; }
        } catch (err) {
            container.innerHTML = '<div style="color:var(--text-grey); text-align:center;">Network error. Please try again.</div>';
        }
    }

    function renderApplicants(applicants) {
        const container = document.getElementById('applicants-list');
        container.innerHTML = '';
        if (applicants.length === 0) {
            container.innerHTML = '<div style="color:var(--text-grey); text-align:center;">No applicants found.</div>'; return;
        }

        applicants.forEach(app => {
            const safe = (val) => val || 'N/A'; 
            const profile = app.basic_profile || {}; const loc = profile.business_location || {};
            const rep = app.official_representative || {}; const alt = app.alternate_representative || {};
            const org = app.organization_membership || {}; const track = app.internal_tracking || {};
            const isApproved = app.status && app.status.toLowerCase() === 'approved';
            
            const approveBtnHtml = isApproved ? 
                `<button class="btn btn-secondary" disabled style="opacity: 0.5; cursor: not-allowed; width: auto; padding: 5px 15px; font-size: 0.8rem;">Approved</button>` : 
                `<button class="btn btn-primary" style="width: auto; padding: 5px 15px; font-size: 0.8rem; background-color: #28a745;" onclick="openApproveModal(${app.id}, '${app.membership_type || 'Regular'}')">Approve</button>`;

            container.insertAdjacentHTML('beforeend', `
                <div class="applicant-card">
                    <div class="card-header">
                        <div>
                            <h3>${safe(profile.registered_business_name)}</h3>
                            <small style="color:var(--text-grey)">ID: ${app.id} | Type: <span id="type-${app.id}">${safe(app.membership_type)}</span></small>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="status-badge" style="${isApproved ? 'background-color: #28a745;' : ''}">${safe(app.status)}</span>
                            ${approveBtnHtml}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="info-section">
                            <h4>Business Profile</h4>
                            <div class="data-row"><strong>Trade Name:</strong> <span>${safe(profile.trade_name)}</span></div>
                            <div class="data-row"><strong>Email:</strong> <span>${safe(profile.email)}</span></div>
                        </div>
                        <div class="info-section">
                            <h4>Location</h4>
                            <div class="data-row"><strong>Address:</strong> <span>${safe(loc.business_address)}, ${safe(loc.city_municipality)}</span></div>
                        </div>
                        <div class="info-section">
                            <h4>Representatives</h4>
                            <div class="data-row"><strong>Official Rep:</strong> <span>${safe(rep.first_name)} ${safe(rep.surname)}</span></div>
                        </div>
                    </div>
                </div>
            `);
        });
    }

    function openRegisterModal() { document.getElementById('registerModal').style.display = 'flex'; document.getElementById('registerError').style.display = 'none'; }
    function closeRegisterModal() { document.getElementById('registerModal').style.display = 'none'; document.getElementById('registerForm').reset(); }

    async function handleRegister(e) {
        e.preventDefault();
        const btn = document.getElementById('regSubmitBtn'); const errorDiv = document.getElementById('registerError');
        btn.disabled = true; btn.innerText = 'Registering...'; errorDiv.style.display = 'none';
        try {
            const response = await fetch(`${window.API_BASE_URL}/register`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': `Bearer ${token}` },
                body: JSON.stringify({ name: document.getElementById('regName').value, email: document.getElementById('regEmail').value, role: 'treasurer' })
            });
            const data = await response.json();
            if (response.ok || response.status === 201 || response.status === 202) {
                closeRegisterModal(); showSuccessModal(data.user.email, data.password);
            } else {
                errorDiv.innerText = data.message || 'Registration failed.';
                if(data.errors) errorDiv.innerText += ' ' + Object.values(data.errors).flat().join(' ');
                errorDiv.style.display = 'block';
            }
        } catch (err) { errorDiv.innerText = 'Network error.'; errorDiv.style.display = 'block'; }
        finally { btn.disabled = false; btn.innerText = 'Register Account'; }
    }

    function showSuccessModal(email, password) {
        document.getElementById('successEmail').innerText = email; document.getElementById('generatedPassword').innerText = password;
        document.getElementById('successModal').style.display = 'flex'; document.getElementById('copyBtn').innerText = 'Copy Password';
    }
    function closeSuccessModal() { document.getElementById('successModal').style.display = 'none'; document.getElementById('generatedPassword').innerText = ''; }
    function copyPassword() { navigator.clipboard.writeText(document.getElementById('generatedPassword').innerText).then(() => { document.getElementById('copyBtn').innerText = 'Copied!'; }); }

    let currentApproveId = null;
    function openApproveModal(id, currentType) {
        currentApproveId = id; document.getElementById('approveModal').style.display = 'flex'; document.getElementById('approveError').style.display = 'none';
        const select = document.getElementById('approveMembershipType');
        if (currentType && currentType !== 'N/A') {
            for(let i=0; i<select.options.length; i++) { if(select.options[i].value.toLowerCase() === currentType.toLowerCase()) { select.selectedIndex = i; break; } }
        }
    }
    function closeApproveModal() { document.getElementById('approveModal').style.display = 'none'; currentApproveId = null; }

    async function submitApprove(e) {
        e.preventDefault(); if (!currentApproveId) return;
        const btn = document.getElementById('approveSubmitBtn'); const errorDiv = document.getElementById('approveError');
        btn.disabled = true; btn.innerText = 'Approving...'; errorDiv.style.display = 'none';
        try {
            const response = await fetch(`${window.API_BASE_URL}/v1/applicants/${currentApproveId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': `Bearer ${token}` },
                body: JSON.stringify({ status: 'approved', membership_type: document.getElementById('approveMembershipType').value })
            });
            const data = await response.json();
            if (response.ok) { closeApproveModal(); fetchApplicants(); } 
            else { errorDiv.innerText = data.message || 'Approval failed.'; errorDiv.style.display = 'block'; }
        } catch (err) { errorDiv.innerText = 'Network error.'; errorDiv.style.display = 'block'; }
        finally { btn.disabled = false; btn.innerText = 'Confirm Approval'; }
    }

    function logout() { localStorage.removeItem('token'); window.location.href = '/login'; }
</script>
@endsection