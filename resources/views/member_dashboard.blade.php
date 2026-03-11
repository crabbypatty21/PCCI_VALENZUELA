@extends('layouts.app')

@section('title', 'Member Dashboard - PCCI')

@section('content')
@include('partials.api-config')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
header, footer, .navbar, nav { display: none !important; }
main { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }

body {
    background: #f5f6f8;
    font-family: Arial, sans-serif;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    height: 100vh;
    background: #f0f0f0;
    position: fixed;
    padding: 20px;
    top: 0;
    left: 0;
    overflow-y: auto;
    border-right: 1px solid #ddd;
}

.sidebar img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin-top: 30px;
}

.sidebar ul li {
    padding: 12px 15px;
    margin-bottom: 5px;
    cursor: pointer;
    font-weight: bold;
}

.sidebar ul li.active {
    background: #be1e38;
    color: white;
    border-radius: 8px;
}

.sidebar ul li:hover:not(.active) {
    background: #ddd;
    border-radius: 8px;
}

/* MAIN */
.main {
    margin-left: 250px;
    padding: 30px;
}

.card {
    border-radius: 12px;
}

.stat-box {
    padding: 20px;
    border-radius: 10px;
    color: white;
    text-align: center;
}

.orange { background: #f59e0b; }
.blue { background: #3b82f6; }

.profile-img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}

.event-img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
}
</style>

<div class="sidebar text-center">
    <h6 style="color:#be1e38;font-weight:bold;">PCCI - Valenzuela</h6>
    <img src="https://via.placeholder.com/80" id="sidebarImage">
    <h5 class="mt-3" id="sidebarCompany">Loading...</h5>
    <small id="sidebarName">Loading...</small>

    <ul class="text-start">
        <li class="active">Dashboard</li>
        <li>My Business</li>
        <li>My Products</li>
        <li>Membership</li>
        <li>Settings</li>
    </ul>
</div>

<div class="main">
    <div class="d-flex justify-content-center mb-4">
        <input 
            type="text"
            class="form-control"
            placeholder="SEARCH"
            style="max-width:500px;border-radius:20px;padding:10px;text-align:center;letter-spacing:1px;">
    </div>

    <h4 id="welcomeMessage">Welcome, Loading... !</h4>
    <p class="text-muted">Manage your business profile, products, and membership</p>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-box orange">
                <h5>12</h5>
                <p>Products/Services Listed</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box blue">
                <h5>3</h5>
                <p>Upcoming Events</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 h-100 d-flex justify-content-center">
                <b>Date Today</b>
                <h4 id="dateToday" class="mb-0 text-danger">Loading...</h4>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="fw-bold">Business Profile</h6>
                    <button class="btn btn-outline-danger btn-sm">Edit Profile</button>
                </div>
                <div class="d-flex align-items-center">
                    <img class="profile-img me-3" id="profileCardImage" src="https://via.placeholder.com/80">
                    <div>
                        <b id="profileCardCompany" style="font-size: 1.1rem;">Loading...</b><br>
                        <span id="profileCardEmail" class="text-muted">loading@email.com</span>
                        
                        <p class="mt-3 mb-0" style="font-size: 0.9rem;">
                            <strong>Business Type:</strong> <span id="profileCardBizType">Loading...</span><br>
                            <strong>Ownership Type:</strong> <span id="profileCardOwnership">Loading...</span><br>
                            <strong>Contact:</strong> <span id="profileCardContact">Loading...</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 h-100">
                <h6 class="fw-bold">Membership Overview</h6>
                
                <div class="alert alert-success mt-2 py-2" id="membershipAlert">
                    <b id="membershipStatus" class="text-uppercase">LOADING...</b><br>
                    <small>Registered Since: <span id="membershipDate">Loading...</span></small>
                </div>
                
                <p style="font-size: 0.95rem;">
                    <strong>Member ID:</strong> <span id="membershipID" class="text-danger fw-bold">Loading...</span><br>
                    <strong>Membership Type:</strong> <span id="membershipType">Loading...</span>
                </p>
                
                <button class="btn btn-danger w-100 mt-auto">Renew Membership</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h6 class="fw-bold mb-3">Recent Products/Services</h6>
            <div class="card p-3 mb-3 border-start border-danger border-4">
                <b id="productName1">Welding Services</b>
                <a id="productLink1" href="#" class="text-muted text-decoration-none small">www.abccompany.com</a>
            </div>
            <div class="card p-3 border-start border-danger border-4">
                <b id="productName2">Metal Fabrication</b>
                <a id="productLink2" href="#" class="text-muted text-decoration-none small">www.abccompany.com</a>
            </div>
        </div>

        <div class="col-md-6">
            <h6 class="fw-bold mb-3">Upcoming Events</h6>
            <div class="card p-3">
                <img class="event-img mb-2" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e">
                <h6 class="mt-2 fw-bold">Business Workshop Plan</h6>
                <small class="text-muted"><i class="bi bi-calendar"></i> March 25, 2026 | Valenzuela City</small>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const token = localStorage.getItem('token');
    
    if(!token){
        window.location.href='/login';
        return;
    }

    // Set Date Today
    const options = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
    document.getElementById('dateToday').innerText = new Date().toLocaleDateString('en-US', options);

    fetchMemberData(token);
});

async function fetchMemberData(token){
    try{
        const response = await fetch(`${window.API_BASE_URL}/v1/profile`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if(response.ok && data.data){
            const profile = data.data;
            const basic = profile.basic_profile || {};
            const org = profile.organization_membership || {};
            const rep = profile.official_representative || {};

            const companyName = basic.registered_business_name || 'Your Company';
            const repName = `${rep.first_name || ''} ${rep.surname || ''}`.trim();

            // 1. Sidebar Updates
            document.getElementById('sidebarCompany').innerText = companyName;
            document.getElementById('sidebarName').innerText = repName;
            
            // 2. Welcome Message
            document.getElementById('welcomeMessage').innerText = `Welcome, ${companyName}!`;

            // 3. Business Profile Card
            document.getElementById('profileCardCompany').innerText = companyName;
            document.getElementById('profileCardEmail').innerText = basic.email || 'N/A';
            document.getElementById('profileCardBizType').innerText = org.type_of_company || 'N/A';
            document.getElementById('profileCardOwnership').innerText = org.ownership_type || 'N/A';
            document.getElementById('profileCardContact').innerText = basic.contact_number || 'N/A';

            // 4. Membership Overview Updates (Added this part!)
            document.getElementById('membershipID').innerText = `PCCI-${new Date().getFullYear()}-${String(profile.id).padStart(4, '0')}`;
            document.getElementById('membershipType').innerText = profile.membership_type || 'Regular';
            document.getElementById('membershipStatus').innerText = profile.status || 'ACTIVE';
            
            // Format the registration date safely
            if(profile.date_approved) {
                const dateObj = new Date(profile.date_approved);
                document.getElementById('membershipDate').innerText = dateObj.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
            } else {
                document.getElementById('membershipDate').innerText = 'Recent';
            }

            // 5. Images (Added this part!)
            if(profile.photo_url) {
                document.getElementById('sidebarImage').src = profile.photo_url;
                document.getElementById('profileCardImage').src = profile.photo_url;
            }
        }
    } catch(error){
        console.error('Error fetching profile:', error);
    }
}
</script>
@endsection