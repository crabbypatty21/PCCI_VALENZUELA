@extends('layouts.app')

@section('title', 'Member Dashboard - PCCI')

@section('content')
@include('partials.api-config')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
header, footer, .navbar, nav { display: none !important; }

/* Allow natural scrolling again */
html, body {
    margin: 0;
    padding: 0;
    background: #f3f4f6; 
    font-family: Arial, sans-serif;
    overflow-x: hidden;
}

main { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }

/* =========================================
   1. TOP NAVIGATION BAR (FIXED)
   ========================================= */
.topbar {
    position: fixed;
    top: 0; left: 0; right: 0;
    height: 60px;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    z-index: 1050;
}

.topbar-brand { font-size: 18px; font-weight: bold; color: #b61b2a; width: 240px; display: flex; align-items: center; gap: 8px; }
.topbar-search-wrapper { width: 35%; position: relative; }
.topbar-search-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 13px; }
.topbar-search { width: 100%; padding: 6px 15px 6px 35px; border-radius: 50rem; border: 1px solid #e5e7eb; background: #f9fafb; font-size: 13px; }
.topbar-actions { display: flex; align-items: center; gap: 15px; }
.topbar-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid #e5e7eb; }

/* =========================================
   NOTIFICATION PANEL CSS
   ========================================= */
.notification-panel {
    position: fixed;
    top: 55px; 
    right: 60px;
    width: 320px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    display: none;
    flex-direction: column;
    z-index: 1100;
    overflow: hidden;
}
.notif-header { background-color: #b61b2a; padding: 12px 15px; display: flex; justify-content: space-between; align-items: center; color: white; }
.notif-header-title { display: flex; align-items: center; gap: 8px; font-weight: bold; font-size: 13px; margin: 0;}
.notif-badge { background-color: white; color: black; padding: 2px 8px; border-radius: 50rem; font-size: 10px; font-weight: bold; }
.notif-clear-btn { background-color: white; color: black; border: none; padding: 4px 10px; border-radius: 50rem; font-size: 10px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: 0.2s; }
.notif-clear-btn:hover { background-color: #f3f4f6; }
.notif-body { max-height: 350px; overflow-y: auto; display: flex; flex-direction: column; }
.notif-item { display: flex; align-items: flex-start; padding: 12px 15px; border-bottom: 1px solid #f3f4f6; gap: 10px; }
.notif-unread { background-color: #f3f4f6; } 
.notif-read { background-color: #ffffff; }   
.notif-icon { width: 32px; height: 32px; border-radius: 50%; background-color: white; display: flex; justify-content: center; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); flex-shrink: 0; font-size: 12px;}
.notif-read .notif-icon { background-color: #f9fafb; box-shadow: none; border: 1px solid #e5e7eb; }
.notif-text-content { display: flex; flex-direction: column; gap: 4px; }
.notif-text-content p { margin: 0; font-size: 12px; color: #111827; line-height: 1.3; }
.notif-text-content small { font-size: 10px; color: #6b7280; font-weight: 500; }
.notif-footer { border-top: 1px solid #e5e7eb; padding: 10px; text-align: center; font-size: 12px; font-weight: bold; color: #4b5563; background-color: #ffffff; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 6px; transition: 0.2s; }
.notif-footer:hover { background-color: #f9fafb; color: #111827; }

/* =========================================
   2. SIDEBAR (FIXED)
   ========================================= */
.sidebar {
    position: fixed;
    top: 60px; 
    left: 0;
    width: 250px; 
    height: calc(100vh - 60px); 
    background: #ffffff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    overflow-y: auto;
}

.sidebar-profile { padding: 20px 15px 15px; text-align: center; border-bottom: 1px solid #f3f4f6; }
.sidebar-profile img { width: 70px; height: 70px; border-radius: 50%; object-fit: cover; background: #000; padding: 3px; border: 1px solid #e5e7eb; margin-bottom: 10px; }
.sidebar-profile h5 { font-size: 15px; font-weight: bold; margin-bottom: 0; color: #111827; }
.sidebar-profile p { font-size: 13px; font-weight: bold; color: #4b5563; margin-bottom: 0; }
.sidebar-profile small { font-size: 12px; color: #6b7280; }

.sidebar-menu { list-style: none; padding: 15px 10px; margin: 0; flex-grow: 1; }
.sidebar-menu li { padding: 12px 15px; margin-bottom: 4px; cursor: pointer; font-weight: 600; font-size: 14px; transition: 0.2s; color: #4b5563; border-radius: 8px; display: flex; align-items: center; gap: 10px; }
.sidebar-menu li i { font-size: 16px; width: 20px; text-align: center; }
.sidebar-menu li.active { background: #f3f4f6; color: #111827; border-left: 4px solid #b61b2a;}
.sidebar-menu li:hover:not(.active) { background: #f9fafb; }
.sidebar-divider { border-top: 1px solid #e5e7eb; margin: 10px; }

/* =========================================
   3. MAIN CONTENT AREA (SCROLLABLE)
   ========================================= */
.main { 
    margin-top: 60px; 
    margin-left: 250px; 
    padding: 30px; 
    min-height: calc(100vh - 60px); 
}

.content-section { display: none; padding-bottom: 40px; }

/* Dashboard Cards */
.custom-card { background: #ffffff; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #f3f4f6; padding: 20px; display: flex; flex-direction: column; margin-bottom: 20px;}

/* Dashboard Specifics */
.stat-box { padding: 20px; border-radius: 16px; color: white; text-align: center; height: 100%; display: flex; flex-direction: column; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
.stat-orange { background: #f97316; }
.stat-blue { background: #3b82f6; }
.stat-teal { background: #ccfbf1; color: #0f766e; }

.active-badge { background: #dcfce7; color: #15803d; padding: 6px 16px; border-radius: 50rem; font-size: 12px; font-weight: bold; display: flex; align-items: center; gap: 6px; }
.pill-card { background: #ffffff; border-radius: 50rem; padding: 12px 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #f3f4f6; margin-bottom: 12px; }
.carousel-dots { display: flex; justify-content: center; gap: 6px; margin-top: auto; padding-top: 15px;}
.carousel-dot { width: 8px; height: 8px; border-radius: 50%; background: #d1d5db; }
.carousel-dot.active { background: #b61b2a; }

/* Restored Tab Styles */
.titleBox { background: #b61b2a; color: white; padding: 20px 25px; border-radius: 12px; font-size: 20px; display: flex; align-items: center; gap: 10px; margin-bottom: 25px; font-weight: bold;}
.editBtn { border: 1px solid #b61b2a; padding: 8px 16px; border-radius: 50rem; color: #b61b2a; background: white; cursor: pointer; font-weight: bold; font-size: 13px; transition: 0.2s; }
.editBtn:hover { background: #fdf0f1; }
.contactItem { margin-bottom: 12px; color: #444; font-size: 14px; display: flex; align-items: center; gap: 10px;}
.contactItem i { color: #888; width: 20px; text-align: center; }
.doc-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eee; }
.doc-item:last-child { border-bottom: none; }
.viewBtn { border: 1px solid #ccc; padding: 5px 15px; border-radius: 6px; background: white; cursor: pointer; font-size: 12px; font-weight: bold;}

.tableTop { display: flex; justify-content: space-between; margin-bottom: 20px; }
.tableTop input { padding: 8px 16px; border: 1px solid #ccc; border-radius: 50rem; width: 300px; font-size: 14px;}
.addBtn { background: #b71c2b; color: white; border: none; padding: 8px 20px; border-radius: 50rem; cursor: pointer; font-size: 14px; font-weight:bold; }
.custom-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.custom-table th { background: #f9fafb; padding: 12px; text-align: left; border-bottom: 2px solid #e5e7eb; color: #4b5563;}
.custom-table td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; vertical-align: middle;}

.pricing-cards { display: flex; justify-content: center; gap: 30px; margin-top: 20px; flex-wrap: wrap;}
.pricing-card { width: 340px; background: #fff; padding: 30px; border: 2px solid #b00020; border-radius: 20px; box-shadow: 0 6px 10px -2px rgba(0,0,0,0.05); display: flex; flex-direction: column; }
.pricing-card h2 { text-align: center; font-size: 22px; margin-bottom: 15px; border-bottom: 2px solid #333; padding-bottom: 10px; font-weight: bold;}
.pricing-card ul { margin-top: 15px; list-style: none; padding: 0; flex-grow: 1; font-size: 14px; color: #4b5563;}
.pricing-card ul li { margin-bottom: 12px; display: flex; gap: 10px;}
.pricing-price { margin-top: 20px; padding: 12px; border-radius: 10px; font-size: 18px; font-weight: bold; text-align: center; border: 2px solid #b00020; color: #b00020;}
.pricing-price.red { background: #b00020; color: #fff; border: none; }

.setting-box { background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; padding: 16px 20px; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; cursor: pointer; transition: 0.2s;}
.setting-box:hover { background: #f9fafb; }
.setting-left { display: flex; align-items: center; gap: 15px; font-size: 16px; font-weight: bold; color: #333; }
.logout-btn { background: #b00020; color: white; border: none; padding: 12px 30px; border-radius: 50rem; font-weight: bold; font-size: 15px; margin-top: 20px; align-self: flex-end;}

/* Modals */
.modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1200; justify-content: center; align-items: center; }
.modal-content-box { background: white; padding: 30px; border-radius: 20px; width: 100%; max-width: 450px; }
</style>

<div class="topbar">
    <a href="{{ url('/') }}" class="d-flex align-items-center gap-3 text-decoration-none" style="outline: none; box-shadow: none;">
        <div class="rounded-circle overflow-hidden" style="width: 40px; height: 40px;">
            <img src="{{ asset('images/PCCI-Logo.svg') }}" alt="PCCI Logo" class="w-100 h-100 object-fit-contain">
        </div>

        <div class="d-flex flex-column">
            <span class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif; font-size: 1rem; line-height: 1.2;">
                PCCI - Valenzuela
            </span>
            <span class="d-none d-sm-block text-muted" style="font-family: 'DM Sans', sans-serif; font-size: 0.7rem;">
                Philippine Chamber of Commerce and Industry
            </span>
        </div>
    </a>
    
    <div class="topbar-search-wrapper">
        <i class="fa fa-search"></i>
        <input type="text" class="topbar-search" placeholder="Search dashboard...">
    </div>

    <div class="topbar-actions">
        <div class="position-relative" onclick="toggleNotificationPanel(event)" style="cursor:pointer; display: flex; align-items: center;">
            <i class="fa fa-bell fs-5 text-muted"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 4px; margin-left: -5px;"></span>
        </div>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/ABC_Logo_2021.svg/1200px-ABC_Logo_2021.svg.png" class="topbar-avatar ms-3" id="topbarAvatar" alt="User">
    </div>
</div>

<div class="notification-panel" id="notificationPanel">
    <div class="notif-header">
        <h6 class="notif-header-title">Your Notification <span class="notif-badge">1 New</span></h6>
        <button class="notif-clear-btn" onclick="clearNotifications(event)"><i class="fa fa-times"></i> Close</button>
    </div>
    <div class="notif-body">
        <div class="notif-item notif-unread">
            <div class="notif-icon"><i class="fa fa-bell text-danger fs-5"></i></div>
            <div class="notif-text-content">
                <p><strong>Mr. ABC</strong> your membership is near to <strong>expired</strong> to .........</p>
                <small>Monday, February 23, 2026</small>
            </div>
        </div>
        <div class="notif-item notif-read">
            <div class="notif-icon"><i class="fa fa-check text-secondary fs-5"></i></div>
            <div class="notif-text-content">
                <p>Your business profile details were successfully <strong>updated</strong>.</p>
                <small>Sunday, February 22, 2026</small>
            </div>
        </div>
        <div class="notif-item notif-read">
            <div class="notif-icon"><i class="fa fa-box-open text-secondary fs-5"></i></div>
            <div class="notif-text-content">
                <p>Your latest product <strong>Welding Services</strong> has been approved.</p>
                <small>Friday, February 20, 2026</small>
            </div>
        </div>
    </div>
    <div class="notif-footer" onclick="markAllRead(event)"><i class="fa fa-sync-alt"></i> Mark All as Read</div>
</div>

<div class="sidebar">
    <div class="sidebar-profile">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/ABC_Logo_2021.svg/1200px-ABC_Logo_2021.svg.png" id="sidebarImage" alt="Profile">
        <h5 id="sidebarCompany">Loading...</h5>
        <p id="sidebarName">Loading...</p>
        <small id="sidebarEmail">loading...</small>
    </div>

    <ul class="sidebar-menu text-start">
        <li class="active" id="nav-dashboard" onclick="switchTab('dashboard')"><i class="fa fa-chart-pie"></i> Dashboard</li>
        <li id="nav-business" onclick="switchTab('business')"><i class="fa fa-briefcase"></i> My Business</li>
        <li id="nav-products" onclick="switchTab('products')"><i class="fa fa-box-open"></i> My Products</li>
        <li id="nav-membership" onclick="switchTab('membership')"><i class="fa fa-id-badge"></i> Membership</li>
        <div class="sidebar-divider"></div>
        <li id="nav-settings" onclick="switchTab('settings')"><i class="fa fa-gear"></i> Settings</li>
    </ul>
</div>

<div class="main">

    {{-- DASHBOARD TAB --}}
    <div id="section-dashboard" class="content-section" style="display: block;">
        <div class="mb-4">
            <h4 id="welcomeMessage" class="fw-bold text-dark mb-1">Welcome, Loading... !</h4>
            <p class="text-muted mb-0" style="font-size: 14px;">Manage your business profile, products, and membership</p>
        </div>

        <div class="row mb-4 g-4">
            <div class="col-md-3">
                <div class="stat-box stat-orange">
                    <h2 class="fw-bold mb-0">12</h2>
                    <p class="mb-0" style="font-size: 14px;">Products/Services</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box stat-blue">
                    <h2 class="fw-bold mb-0">3</h2>
                    <p class="mb-0" style="font-size: 14px;">Upcoming Events</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-box stat-teal text-start px-4" style="align-items: flex-start; justify-content: center;">
                    <h5 id="liveDate" class="fw-bold mb-1 text-dark">Loading Date...</h5>
                    <h2 id="liveTime" class="fw-bold mb-0" style="color: #0f766e;">Loading Time...</h2>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">
            <div class="col-md-6">
                <div class="custom-card">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/ABC_Logo_2021.svg/1200px-ABC_Logo_2021.svg.png" id="dashBizImage" style="width: 60px; height: 60px; border-radius: 50%; border: 1px solid #ddd; padding: 2px; object-fit: cover;">
                            <div>
                                <h5 class="fw-bold mb-0" id="dashBizName">Loading...</h5>
                                <small class="text-muted" id="dashBizEmail">Loading...</small>
                            </div>
                        </div>
                        <button class="btn btn-light text-danger rounded-pill px-3 fw-bold" onclick="switchTab('business')" style="border: 1px solid #e5e7eb; font-size: 13px;">
                            <i class="fa fa-pen me-1"></i> Edit
                        </button>
                    </div>
                    <div style="font-size: 14px;">
                        <p class="mb-2"><strong class="text-muted d-inline-block" style="width: 140px;">Official Receipt No:</strong> <span class="text-dark fw-bold">123456789</span></p>
                        <p class="mb-2"><strong class="text-muted d-inline-block" style="width: 140px;">Business Type:</strong> <span class="text-dark fw-bold" id="dashBizType">Loading...</span></p>
                        <p class="mb-0"><strong class="text-muted d-inline-block" style="width: 140px;">Ownership Type:</strong> <span class="text-dark fw-bold">Solo Partnership</span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="custom-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Membership Overview</h5>
                        <div class="active-badge"><i class="fa fa-check-circle"></i> <span id="dashMembershipStatus">Loading...</span></div>
                    </div>
                    <div style="font-size: 14px;" class="mb-4 flex-grow-1">
                        <p class="mb-2"><strong class="text-muted d-inline-block" style="width: 140px;">Member ID:</strong> <span class="text-dark fw-bold" id="dashMembershipID">...</span></p>
                        <p class="mb-2"><strong class="text-muted d-inline-block" style="width: 140px;">Receipt No:</strong> <span class="text-dark fw-bold">987654321</span></p>
                        <p class="mb-0"><strong class="text-muted d-inline-block" style="width: 140px;">Membership Type:</strong> <span class="text-dark fw-bold" id="dashMembershipType">Loading...</span></p>
                    </div>
                    <button class="btn btn-danger w-100 rounded-pill py-2 fw-bold mt-auto" onclick="switchTab('membership')">Renew Membership</button>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                    <h5 class="fw-bold mb-0 text-dark">Recent Products/Services</h5>
                    <button class="btn btn-link text-danger p-0 text-decoration-none fw-bold" style="font-size: 13px;" onclick="switchTab('products')">View All <i class="fa fa-arrow-right ms-1"></i></button>
                </div>

                <div class="pill-card">
                    <b class="text-dark mb-0" style="font-size: 14px;">Welding Services</b>
                    <a href="https://www.abccompany.com/welding" target="_blank" class="text-primary text-decoration-none fw-bold text-truncate" style="font-size: 13px; max-width: 200px;">
                        www.abccompany.com/welding <i class="fa fa-external-link-alt ms-1"></i>
                    </a>
                </div>
                <div class="pill-card">
                    <b class="text-dark mb-0" style="font-size: 14px;">Metal Fabrication</b>
                    <a href="https://www.abccompany.com/fab" target="_blank" class="text-primary text-decoration-none fw-bold text-truncate" style="font-size: 13px; max-width: 200px;">
                        www.abccompany.com/fab <i class="fa fa-external-link-alt ms-1"></i>
                    </a>
                </div>
                <div class="pill-card mb-0">
                    <b class="text-dark mb-0" style="font-size: 14px;">Industrial Repair</b>
                    <a href="https://www.abccompany.com/repair" target="_blank" class="text-primary text-decoration-none fw-bold text-truncate" style="font-size: 13px; max-width: 200px;">
                        www.abccompany.com/repair <i class="fa fa-external-link-alt ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="custom-card p-3">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80" 
                         class="w-100 rounded-3 mb-3" style="height: 150px; object-fit: cover;">
                    <div class="px-2">
                        <h5 class="fw-bold text-dark mb-2">Business Workshop Plan</h5>
                        <div class="d-flex justify-content-between text-muted" style="font-size: 13px;">
                            <span><i class="fa fa-calendar text-danger me-1"></i> Mar 25, 2026</span>
                            <span><i class="fa fa-map-marker-alt text-danger me-1"></i> Valenzuela City</span>
                        </div>
                    </div>
                    <div class="carousel-dots">
                        <div class="carousel-dot active"></div>
                        <div class="carousel-dot"></div>
                        <div class="carousel-dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MY BUSINESS TAB --}}
    <div id="section-business" class="content-section" style="display: none;">
        <div class="titleBox"><i class="fa fa-briefcase"></i> My Business</div>
        
        <div class="custom-card">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div class="d-flex align-items-center gap-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/ABC_Logo_2021.svg/1200px-ABC_Logo_2021.svg.png" id="bizMainImage" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e7eb; padding: 4px;">
                    <div>
                        <h4 class="fw-bold mb-1" id="bizNameTitle">Loading...</h4>
                        <div class="text-muted" style="font-size: 15px;" id="bizIndustryTitle">Loading Industry...</div>
                    </div>
                </div>
                <button class="editBtn" onclick="openEditProfileModal()"><i class="fa fa-pen me-1"></i> Edit Profile</button>
            </div>

            <div class="row mt-2">
                <div class="col-md-7">
                    <div class="contactItem"><i class="fa fa-envelope"></i> <span id="bizEmailText">loading...</span></div>
                    <div class="contactItem"><i class="fa fa-phone"></i> <span id="bizPhoneText">loading...</span></div>
                    <div class="contactItem"><i class="fa fa-location-dot"></i> <span id="bizAddressText">loading...</span></div>
                </div>
                <div class="col-md-5 border-start ps-4">
                    <h6 class="fw-bold mb-2">Membership Details</h6>
                    <p class="text-muted mb-0" style="font-size: 13px;">Expires Date</p>
                    <p class="fw-bold mb-3" style="font-size: 14px;" id="bizExpiryText">March 1, 2027</p>
                    <p class="text-muted mb-0" style="font-size: 13px;">Membership Type</p>
                    <p class="fw-bold mb-0" style="font-size: 14px;" id="bizMembershipTypeText">Loading...</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-7">
                <div class="custom-card h-100">
                    <h5 class="fw-bold mb-3">Business Description</h5>
                    <p class="text-muted mb-0" style="line-height: 1.6; font-size: 14px;" id="bizDescriptionText">
                        Your business profile description will appear here. This area highlights your high-quality products, services, and core operations to other members of the PCCI network.
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="custom-card mb-4">
                    <h5 class="fw-bold mb-3">Representative</h5>
                    <p class="fw-bold mb-0" style="font-size: 15px;" id="repNameText">Loading...</p>
                    <p class="text-muted mb-3" style="font-size: 13px;" id="repDesignationText">Loading Designation...</p>
                    <div class="contactItem mb-2"><i class="fa fa-envelope"></i> <span id="repEmailText">...</span></div>
                    <div class="contactItem mb-0"><i class="fa fa-phone"></i> <span id="repPhoneText">...</span></div>
                </div>
                <div class="custom-card">
                    <h5 class="fw-bold mb-3">Documents</h5>
                    <div class="doc-item">
                        <span class="text-success fw-bold" style="font-size: 14px;"><i class="fa fa-check me-2"></i> Mayor Permit</span>
                        <button class="viewBtn" id="btnViewMayors" onclick="viewDocument('mayors')">View</button>
                    </div>
                    <div class="doc-item">
                        <span class="text-success fw-bold" style="font-size: 14px;"><i class="fa fa-check me-2"></i> DTI / SEC</span>
                        <button class="viewBtn" id="btnViewDTI" onclick="viewDocument('dti')">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- REFACTORED INCLUDES --}}
    @include('member.products')
    @include('member.membership')
    @include('member.settings')

</div>

<div class="modal-overlay" id="editProfileModal">
    <div class="modal-content-box" style="max-width: 650px; max-height: 90vh; overflow-y: auto;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0 text-dark"><i class="fa fa-pen text-danger me-2"></i>Edit Business Profile</h5>
            <button class="btn-close" onclick="closeEditProfileModal()"></button>
        </div>

        <div id="profileAlert" class="alert alert-danger" style="display: none; font-size: 13px;"></div>
        
        <h6 class="fw-bold mb-3 text-danger border-bottom pb-2">Business Details</h6>
        <div class="mb-3">
            <label class="form-label fw-bold text-muted" style="font-size: 13px;">Registered Business Name</label>
            <input type="text" id="ep_companyName" class="form-control" placeholder="Company Name">
        </div>
        <div class="row mb-3 g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold text-muted" style="font-size: 13px;">Email Address</label>
                <input type="email" id="ep_email" class="form-control" placeholder="example@email.com">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold text-muted" style="font-size: 13px;">Contact Number</label>
                <input type="text" id="ep_phone" class="form-control" placeholder="+63 912 345 6789">
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold text-muted" style="font-size: 13px;">Industry / Type of Company</label>
            <input type="text" id="ep_industry" class="form-control" placeholder="e.g. Manufacturing">
        </div>

        <div class="row mb-4 g-3">
            <div class="col-md-7">
                <label class="form-label fw-bold text-muted" style="font-size: 13px;">Business Address</label>
                <input type="text" id="ep_address" class="form-control" placeholder="Street Address">
            </div>
            <div class="col-md-5">
                <label class="form-label fw-bold text-muted" style="font-size: 13px;">City/Municipality</label>
                <input type="text" id="ep_city" class="form-control" placeholder="City">
            </div>
        </div>
        
        <h6 class="fw-bold mb-3 text-danger border-bottom pb-2">Official Representative</h6>
        <div class="row mb-3 g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold text-muted" style="font-size: 13px;">First Name</label>
                <input type="text" id="ep_repFirstName" class="form-control" placeholder="First Name">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold text-muted" style="font-size: 13px;">Surname</label>
                <input type="text" id="ep_repLastName" class="form-control" placeholder="Last Name">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold text-muted" style="font-size: 13px;">Designation</label>
            <input type="text" id="ep_repDesignation" class="form-control" placeholder="e.g. CEO, Manager">
        </div>

        <div class="d-flex justify-content-end gap-2 mt-2">
            <button class="btn btn-light fw-bold" onclick="closeEditProfileModal()">Cancel</button>
            <button class="btn btn-danger fw-bold px-4" id="btnSaveProfile" onclick="saveProfile()">Save Changes</button>
        </div>
    </div>
</div>

<script>

const token = localStorage.getItem('token');

// ==========================================
// INITIALIZATION & AUTHENTICATION
// ==========================================
document.addEventListener('DOMContentLoaded', function(){
    if(!token) { 
        window.location.href = '/login'; 
        return; 
    }

    startLiveClock();
    fetchRealDashboardData(token);
});

// Update the Date and Time in the Light-Teal widget
function startLiveClock() {
    const dateEl = document.getElementById('liveDate');
    const timeEl = document.getElementById('liveTime');
    function updateTime() {
        const now = new Date();
        dateEl.innerText = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        timeEl.innerText = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
    }
    updateTime(); 
    setInterval(updateTime, 1000);
}

// Tab Logic
function switchTab(tabName) {
    document.querySelectorAll('.content-section').forEach(section => section.style.display = 'none');
    document.querySelectorAll('.sidebar-menu li').forEach(li => li.classList.remove('active'));
    document.getElementById('section-' + tabName).style.display = 'block'; // Block restores natural scroll flow
    const activeNav = document.getElementById('nav-' + tabName);
    if(activeNav) activeNav.classList.add('active');

    if (tabName === 'products') fetchProducts();
}

// Notification Logic
function toggleNotificationPanel(event) {
    event.stopPropagation(); 
    const panel = document.getElementById('notificationPanel');
    panel.style.display = panel.style.display === 'flex' ? 'none' : 'flex';
}

document.addEventListener('click', function(event) {
    const panel = document.getElementById('notificationPanel');
    if (panel.style.display === 'flex' && !panel.contains(event.target)) {
        panel.style.display = 'none';
    }
});

function clearNotifications(event) { 
    event.stopPropagation(); 
    document.getElementById('notificationPanel').style.display = 'none'; 
}

function markAllRead(event) { 
    event.stopPropagation(); 
    alert('All notifications marked as read!'); 
}

function logout() { 
    localStorage.removeItem('token'); 
    window.location.href = '/login'; 
}

function openAddProductModal() { document.getElementById('addProductModal').style.display = 'flex'; }
function editProfileAlert() { alert("Edit Profile modal will open here!"); }
function viewDocument(type) { alert("Viewing document: " + type); }

// ========================================
// REAL API FETCH LOGIC
// ==========================================
async function fetchRealDashboardData(token) {
    try {
        // Updated to use the correct /v1/application endpoint
        const response = await fetch(`${window.API_BASE_URL}/v1/application`, {
            headers: { 
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json' 
            }
        });
        
        // Handle expired/invalid tokens just like the admin dashboard
        if (response.status === 401) { 
            logout(); 
            return; 
        }

        const data = await response.json();

        if (response.ok && data.data) {
            window.currentProfileData = null;
            // Depending on if the API returns an array or single object for the user's application
            const profile = Array.isArray(data.data) ? data.data[0] : data.data;
            window.currentProfileData = profile;
            if (!profile) return;

            const basic = profile.basic_profile || {};
            const org = profile.organization_membership || {};
            const rep = profile.official_representative || {};
            const loc = basic.business_location || {};
            
            const companyName = basic.registered_business_name || 'Your Company';
            const repName = `${rep.first_name || ''} ${rep.surname || ''}`.trim();
            const memberID = `PCCI-${new Date().getFullYear()}-${String(profile.id).padStart(4, '0')}`;
            const memStatus = profile.status || 'Pending';
            const memType = profile.membership_type || 'N/A';

            // Sidebar Injection
            document.getElementById('sidebarCompany').innerText = companyName;
            document.getElementById('sidebarName').innerText = repName || 'No Rep Assigned';
            document.getElementById('sidebarEmail').innerText = basic.email || 'N/A';
            if(profile.photo_url) {
                document.getElementById('sidebarImage').src = profile.photo_url;
                document.getElementById('topbarAvatar').src = profile.photo_url;
                document.getElementById('dashBizImage').src = profile.photo_url;
                document.getElementById('bizMainImage').src = profile.photo_url;
            }

            // Dashboard Title Injection
            document.getElementById('welcomeMessage').innerText = `Welcome, ${companyName}!`;

            // Dashboard Profile Card Injection
            document.getElementById('dashBizName').innerText = companyName;
            document.getElementById('dashBizEmail').innerText = basic.email || 'N/A';
            document.getElementById('dashBizType').innerText = org.type_of_company || 'Industry not specified';

            // Dashboard Membership Overview Card Injection
            document.getElementById('dashMembershipStatus').innerText = memStatus.toUpperCase();
            document.getElementById('dashMembershipID').innerText = memberID;
            document.getElementById('dashMembershipType').innerText = memType;

            // Restored "My Business" Tab Injection
            document.getElementById('bizNameTitle').innerText = companyName;
            document.getElementById('bizIndustryTitle').innerText = org.type_of_company || 'Industry not specified';
            document.getElementById('bizEmailText').innerText = basic.email || 'N/A';
            document.getElementById('bizPhoneText').innerText = basic.contact_number || 'N/A';
            
            const addressString = `${loc.business_address || ''}, ${loc.city_municipality || ''}`.trim().replace(/^,|,$/g, '');
            document.getElementById('bizAddressText').innerText = addressString || 'Address not provided';
            
            document.getElementById('bizMembershipTypeText').innerText = memType;
            if(profile.date_approved) {
                let d = new Date(profile.date_approved);
                d.setFullYear(d.getFullYear() + 1);
                document.getElementById('bizExpiryText').innerText = d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            } else {
                document.getElementById('bizExpiryText').innerText = 'Pending Approval';
            }

            document.getElementById('repNameText').innerText = repName || 'N/A';
            document.getElementById('repDesignationText').innerText = rep.designation || 'Representative';
            document.getElementById('repEmailText').innerText = rep.email || basic.email || 'N/A';
            document.getElementById('repPhoneText').innerText = rep.contact_number || basic.contact_number || 'N/A';
        }
    } catch(error) {
        console.error("Failed to fetch API Data:", error);
    }
}

// ==========================================
// REAL PRODUCTS API LOGIC
// ==========================================

// 1. Fetch & Display Products (GET)
async function fetchProducts() {
    const tbody = document.getElementById('productsTableBody');
    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">Loading products...</td></tr>';
    
    try {
        const response = await fetch(`${window.API_BASE_URL}/v1/products`, {
            headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
        });
        
        if (response.status === 401) { logout(); return; }
        
        const data = await response.json();
        // Adjust "data.data" if your API wraps the array differently
        const products = data.data || []; 
        
        tbody.innerHTML = '';
        if(products.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">No products found.</td></tr>';
            return;
        }
        
        products.forEach(prod => {
            const name = prod.name || 'N/A';
            const desc = prod.description || '';
            const url = prod.url || prod.service_url || '#'; // Adjust property name to match your API response
            const status = prod.status || 'Active';
            const statusColor = status.toLowerCase() === 'active' ? 'green' : 'gray';
            
            // Format URL to be clickable
            const cleanUrl = url !== '#' && !url.startsWith('http') ? 'https://' + url : url;
            const urlDisplay = url !== '#' ? `<a href="${cleanUrl}" target="_blank" class="text-primary text-decoration-none">${url}</a>` : '<span class="text-muted">N/A</span>';

            tbody.innerHTML += `
                <tr>
                    <td class="fw-bold text-dark">${name}</td>
                    <td class="text-muted">${desc}</td>
                    <td>${urlDisplay}</td>
                    <td style="color: ${statusColor}; font-weight: bold;">${status}</td>
                    <td>
                        <button class="btn btn-sm btn-light text-warning shadow-sm me-1" onclick="editProduct(${prod.id}, '${name.replace(/'/g, "\\'")}', '${desc.replace(/'/g, "\\'")}', '${url.replace(/'/g, "\\'")}')"><i class="fa fa-pen"></i></button>
                        <button class="btn btn-sm btn-light text-danger shadow-sm" onclick="deleteProduct(${prod.id})"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            `;
        });
    } catch (error) {
        console.error("Error fetching products:", error);
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-danger">Failed to load products.</td></tr>';
    }
}

// 2. Open Add Modal
function openAddProductModal() {
    document.getElementById('productModalTitle').innerText = 'Add New Product';
    document.getElementById('prodId').value = '';
    document.getElementById('prodName').value = '';
    document.getElementById('prodUrl').value = '';
    document.getElementById('prodDesc').value = '';
    document.getElementById('productAlert').style.display = 'none';
    document.getElementById('addProductModal').style.display = 'flex';
}

// 3. Open Edit Modal
function editProduct(id, name, desc, url) {
    document.getElementById('productModalTitle').innerText = 'Edit Product';
    document.getElementById('prodId').value = id;
    document.getElementById('prodName').value = name;
    document.getElementById('prodDesc').value = desc === 'null' ? '' : desc;
    document.getElementById('prodUrl').value = url === 'null' || url === '#' ? '' : url;
    document.getElementById('productAlert').style.display = 'none';
    document.getElementById('addProductModal').style.display = 'flex';
}

// Close Modal
function closeProductModal() {
    document.getElementById('addProductModal').style.display = 'none';
}

// 4. Create (POST) or Update (PUT/POST) Product
async function saveProduct() {
    const id = document.getElementById('prodId').value;
    const name = document.getElementById('prodName').value;
    const desc = document.getElementById('prodDesc').value;
    const url = document.getElementById('prodUrl').value;
    const btn = document.getElementById('btnSaveProduct');
    const alertBox = document.getElementById('productAlert');
    
    if(!name) {
        alertBox.innerText = 'Product name is required.';
        alertBox.style.display = 'block';
        return;
    }

    btn.disabled = true;
    btn.innerText = 'Saving...';
    alertBox.style.display = 'none';

    // Ensure property names match your Laravel validation request
    const payload = {
        name: name,
        description: desc,
        url: url, // change to 'service_url' if that's what your API expects
        status: 'active' 
    };

    const isUpdate = id !== '';
    const endpoint = isUpdate ? `${window.API_BASE_URL}/v1/products/${id}` : `${window.API_BASE_URL}/v1/products`;
    
    // Note: If your Postman update route requires POST instead of PUT, change method here to 'POST'
    let method = isUpdate ? 'PUT' : 'POST';

    try {
        const response = await fetch(endpoint, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (response.ok || response.status === 201 || response.status === 200) {
            closeProductModal();
            fetchProducts(); // Refresh the table
        } else {
            alertBox.innerText = data.message || 'Failed to save product.';
            if(data.errors) alertBox.innerText += ' ' + Object.values(data.errors).flat().join(' ');
            alertBox.style.display = 'block';
        }
    } catch (error) {
        alertBox.innerText = 'Network error occurred.';
        alertBox.style.display = 'block';
    } finally {
        btn.disabled = false;
        btn.innerText = 'Save Product';
    }
}

// 5. Delete Product (DELETE)
async function deleteProduct(id) {
    if(!confirm('Are you sure you want to remove this product?')) return;
    
    try {
        const response = await fetch(`${window.API_BASE_URL}/v1/products/${id}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if(response.ok) {
            fetchProducts(); // Refresh the list
        } else {
            const data = await response.json();
            alert(data.message || "Failed to delete product.");
        }
    } catch(error) {
        alert("Network error. Could not delete product.");
    }
}

// ==========================================
// EDIT PROFILE LOGIC
// ==========================================

function openEditProfileModal() {
    if (!window.currentProfileData) {
        alert("Still loading profile data. Please wait a moment.");
        return;
    }
    
    const profile = window.currentProfileData;
    const basic = profile.basic_profile || {};
    const org = profile.organization_membership || {};
    const rep = profile.official_representative || {};
    const loc = basic.business_location || {};

    // Populate Modal Inputs
    document.getElementById('ep_companyName').value = basic.registered_business_name || '';
    document.getElementById('ep_email').value = basic.email || '';
    document.getElementById('ep_phone').value = basic.contact_number || '';
    
    document.getElementById('ep_industry').value = org.type_of_company || '';
    
    document.getElementById('ep_address').value = loc.business_address || '';
    document.getElementById('ep_city').value = loc.city_municipality || '';
    
    document.getElementById('ep_repFirstName').value = rep.first_name || '';
    document.getElementById('ep_repLastName').value = rep.surname || '';
    document.getElementById('ep_repDesignation').value = rep.designation || '';

    // Show Modal
    document.getElementById('profileAlert').style.display = 'none';
    document.getElementById('editProfileModal').style.display = 'flex';
}

function closeEditProfileModal() {
    document.getElementById('editProfileModal').style.display = 'none';
}

async function saveProfile() {
    const btn = document.getElementById('btnSaveProfile');
    const alertBox = document.getElementById('profileAlert');
    
    if (!window.currentProfileData) {
        alertBox.innerText = 'Profile data not loaded yet. Please refresh and try again.';
        alertBox.style.display = 'block';
        return;
    }

    btn.disabled = true;
    btn.innerText = 'Saving...';
    alertBox.style.display = 'none';

    // 1. Create a deep copy of the existing profile data so we send EVERYTHING back
    let payload = JSON.parse(JSON.stringify(window.currentProfileData));

    // Ensure objects exist to prevent javascript errors
    payload.basic_profile = payload.basic_profile || {};
    payload.basic_profile.business_location = payload.basic_profile.business_location || {};
    payload.organization_membership = payload.organization_membership || {};
    payload.official_representative = payload.official_representative || {};

    // 2. Override ONLY the fields that are in the Edit Profile modal
    payload.basic_profile.registered_business_name = document.getElementById('ep_companyName').value;
    payload.basic_profile.email = document.getElementById('ep_email').value;
    
    // Note: The sample JSON uses 'telephone_no', so we use that here
    payload.basic_profile.telephone_no = document.getElementById('ep_phone').value; 
    
    payload.organization_membership.type_of_company = document.getElementById('ep_industry').value;
    
    payload.basic_profile.business_location.business_address = document.getElementById('ep_address').value;
    payload.basic_profile.business_location.city_municipality = document.getElementById('ep_city').value;
    
    payload.official_representative.first_name = document.getElementById('ep_repFirstName').value;
    payload.official_representative.surname = document.getElementById('ep_repLastName').value;
    payload.official_representative.designation = document.getElementById('ep_repDesignation').value;

    try {
        const response = await fetch(`${window.API_BASE_URL}/v1/application`, {
            method: 'POST', // Use POST as required by your backend
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (response.ok || response.status === 200 || response.status === 201) {
            closeEditProfileModal();
            fetchRealDashboardData(token); // Refresh the UI with the updated data
            alert('Profile updated successfully!'); 
        } else {
            alertBox.innerText = data.message || 'Failed to update profile.';
            if(data.errors) {
                alertBox.innerText += ' ' + Object.values(data.errors).flat().join(' ');
            }
            alertBox.style.display = 'block';
        }
    } catch (error) {
        console.error("Error saving profile:", error);
        alertBox.innerText = 'Network error occurred while saving.';
        alertBox.style.display = 'block';
    } finally {
        btn.disabled = false;
        btn.innerText = 'Save Changes';
    }
}

</script>
@endsection