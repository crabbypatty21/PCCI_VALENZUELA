@extends('layouts.app')

@section('title', 'Treasurer Dashboard - PCCI')

@section('content')
@include('partials.api-config')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* Reset Layout Constraints */
header, footer, .navbar, nav { display: none !important; }
html, body { margin: 0; padding: 0; background: #f3f4f6; font-family: 'DM Sans', sans-serif; overflow-x: hidden; }
main { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }

/* =========================================
   1. TOP NAVIGATION BAR (FIXED)
   ========================================= */
.topbar {
    position: fixed; top: 0; left: 0; right: 0; height: 70px; background: #ffffff;
    display: flex; align-items: center; justify-content: space-between; padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); z-index: 1050;
}
.topbar-search-wrapper { width: 300px; position: relative; }
.topbar-search-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 13px; }
.topbar-search { width: 100%; height: 35px; padding: 6px 15px 6px 35px; border-radius: 50rem; border: 1px solid #e5e7eb; background: #f9fafb; font-size: 13px; outline: none; }
.topbar-actions { display: flex; align-items: center; gap: 15px; }
.topbar-avatar { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid #e5e7eb; cursor: pointer; }

/* =========================================
   2. NOTIFICATION PANEL
   ========================================= */
.notification-panel {
    position: fixed; top: 60px; right: 60px; width: 320px; background: #ffffff; border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; display: none; flex-direction: column; z-index: 1100; overflow: hidden;
}
.notif-header { background-color: #b61b2a; padding: 12px 15px; display: flex; justify-content: space-between; align-items: center; color: white; }
.notif-header-title { font-weight: bold; font-size: 13px; margin: 0;}
.notif-badge { background-color: white; color: black; padding: 2px 8px; border-radius: 50rem; font-size: 10px; font-weight: bold; }
.notif-clear-btn { background-color: white; color: black; border: none; padding: 4px 10px; border-radius: 50rem; font-size: 10px; font-weight: bold; cursor: pointer; }
.notif-body { max-height: 350px; overflow-y: auto; display: flex; flex-direction: column; }
.notif-item { display: flex; padding: 12px 15px; border-bottom: 1px solid #f3f4f6; gap: 10px; }
.notif-icon { width: 32px; height: 32px; border-radius: 50%; display: flex; justify-content: center; align-items: center; flex-shrink: 0; font-size: 12px;}
.notif-text-content p { margin: 0; font-size: 12px; color: #111827; line-height: 1.3; }
.notif-text-content small { font-size: 10px; color: #6b7280; }
.notif-footer { padding: 10px; text-align: center; font-size: 12px; font-weight: bold; color: #4b5563; background-color: #ffffff; cursor: pointer; border-top: 1px solid #e5e7eb;}

/* =========================================
   3. SIDEBAR (FIXED)
   ========================================= */
.sidebar {
    position: fixed; top: 70px; left: 0; width: 240px; height: calc(100vh - 70px);
    background: #ffffff; border-right: 1px solid #e5e7eb; display: flex; flex-direction: column; z-index: 1000; overflow-y: auto;
}
.sidebar-profile { padding: 20px 15px 15px; text-align: center; border-bottom: 1px solid #f3f4f6; }
.sidebar-profile img { width: 65px; height: 65px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e7eb; margin-bottom: 10px; }
.sidebar-profile h5 { font-size: 15px; font-weight: bold; margin-bottom: 0; color: #111827; }
.sidebar-profile p { font-size: 13px; font-weight: bold; color: #4b5563; margin-bottom: 0; }
.sidebar-profile small { font-size: 12px; color: #6b7280; }

.sidebar-menu { list-style: none; padding: 15px 10px; margin: 0; flex-grow: 1; }
.sidebar-menu li { height: 45px; padding: 0 15px; margin-bottom: 4px; cursor: pointer; font-weight: 600; font-size: 14px; color: #4b5563; border-radius: 8px; display: flex; align-items: center; gap: 10px; }
.sidebar-menu li i { font-size: 16px; width: 20px; text-align: center; }
.sidebar-menu li.active { background: #f3f4f6; color: #111827; border-left: 4px solid #b61b2a;}
.sidebar-menu li:hover:not(.active) { background: #f9fafb; }
.sidebar-divider { border-top: 1px solid #e5e7eb; margin: 10px; }

/* =========================================
   4. MAIN CONTENT AREA & COMPONENTS
   ========================================= */
.main { margin-top: 70px; margin-left: 240px; padding: 20px; min-height: calc(100vh - 70px); }
.content-section { display: none; padding-bottom: 40px; }

/* Floating Cards Base */
.floating-card { background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; border: none; }
.custom-card { background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px;}

/* Specific Summary Cards */
.summary-card { width: 100%; height: 105px; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 20px; color: white; position: relative; overflow: hidden; display: flex; align-items: center;}
.summary-card.dash-card { flex-direction: column; align-items: flex-start; justify-content: center; }
.summary-card .icon-circle { width: 45px; height: 45px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; justify-content: center; align-items: center; font-size: 20px; flex-shrink: 0;}
.summary-card .label { font-size: 14px; font-weight: 500; opacity: 0.9; margin-bottom: 2px; }
.summary-card .value { font-size: 26px; font-weight: bold; margin: 0; line-height: 1; }
.summary-card .bg-icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 40px; opacity: 0.2; }

.bg-red { background: linear-gradient(135deg, #e53935, #c62828); }
.bg-green { background: linear-gradient(135deg, #43a047, #2e7d32); }
.bg-orange { background: linear-gradient(135deg, #fb8c00, #ef6c00); }

/* Small Info Card */
.small-info-card { width: 280px; height: 75px; display: flex; align-items: center; gap: 15px; margin-top: 10px; margin-bottom: 25px; }
.small-info-card .icon-box { width: 40px; height: 40px; border-radius: 8px; background: #e3f2fd; color: #1976d2; display: flex; justify-content: center; align-items: center; font-size: 18px; }
.small-info-card p { margin: 0; font-size: 12px; color: #555; font-weight: 500; }
.small-info-card p span { font-weight: bold; color: #222; }

/* Charts Area */
.chart-container { height: 280px; width: 100%; position: relative; }
.card-title-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
.card-title-row h5 { font-size: 16px; font-weight: bold; margin: 0; color: #333; }

/* Table Area */
.table-card { min-height: 350px; padding: 15px 20px; }
.custom-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.custom-table th { background: #f3f4f6; color: #4b5563; font-weight: 600; padding: 12px 10px; text-align: left; position: sticky; top: 0; z-index: 1;}
.custom-table td { padding: 12px 10px; border-bottom: 1px solid #f5f5f5; color: #444; vertical-align: middle; height: 45px;}
.custom-table tbody tr:hover { background-color: #f9fafb; }

/* Custom Scrollbars */
.table-responsive { max-height: 420px; overflow-y: auto; overflow-x: auto;}
.table-responsive::-webkit-scrollbar { height: 6px; width: 6px; }
.table-responsive::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
.table-responsive::-webkit-scrollbar-thumb { background: #e53935; border-radius: 4px; } /* Red horizontal scroll */

/* Action Buttons & Badges */
.action-btn { height: 30px; padding: 0 10px; border-radius: 6px; border: none; font-size: 12px; font-weight: bold; cursor: pointer; color: white; display: inline-flex; align-items: center; justify-content: center; gap: 5px; margin-right: 4px;}
.btn-gray { background-color: #9ca3af; width: 80px; }
.btn-green { background-color: #28a745; width: 75px; }
.btn-red { background-color: #dc3545; width: 75px; }
.btn-orange { background-color: #fd7e14; }
.btn-dark-red { background-color: #8b0000; width: 140px; } /* Print Receipt */

.badge-yellow { background-color: #ffc107; color: #000; font-size: 12px; padding: 4px 10px; border-radius: 50rem; font-weight: bold; margin-left: 10px; }
.badge-pill-green { background-color: #28a745; color: white; font-size: 12px; padding: 6px 15px; border-radius: 50rem; font-weight: bold; display: inline-block; text-align: center; }

.loading, .error-msg { text-align: center; padding: 50px; color: #6b7280; font-size: 1.1rem; font-weight: bold; }

/* =========================================
   6. MODAL STYLES (UPDATED)
   ========================================= */
.custom-modal-overlay {
    position: fixed; 
    top: 0; 
    left: 240px; 
    width: calc(100% - 240px); 
    height: 100%; 
    background: rgba(0, 0, 0, 0.7); 
    display: none; 
    justify-content: center;
    align-items: center; 
    z-index: 1060; 
    backdrop-filter: blur(3px);
}

.custom-modal-card {
    background: #ffffff; 
    width: 90%; 
    max-width: 700px; 
    border-radius: 16px;
    padding: 25px; 
    box-shadow: 0 20px 40px rgba(0,0,0,0.4); 
    position: relative;
    animation: slideIn 0.3s ease-out;
}
@keyframes slideIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

.modal-close-x { position: absolute; top: 15px; right: 20px; font-size: 28px; color: #888; cursor: pointer; border: none; background: none; line-height: 1; }

.modal-img-wrapper { 
    width: 100%; 
    height: 350px; 
    border-radius: 8px; 
    background: #f1f1f1; 
    border: 1px solid #ddd; 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    position: relative;
    overflow: hidden; 
}
.modal-img-wrapper img { 
    width: 100%; 
    height: 100%; 
    object-fit: contain; 
    display: block; 
}
#modalSpinner, #simpleModalSpinner {
    text-align: center;
}

/* Option Buttons inside Modal */
.type-toggle-btn { width: 45px; height: 45px; border-radius: 8px; border: 1px solid #ddd; background: white; font-weight: bold; cursor: pointer; transition: 0.2s; }
.type-toggle-btn.active-1 { background: #dc3545; color: white; border-color: #dc3545; }
.type-toggle-btn.active-2 { background: #0d6efd; color: white; border-color: #0d6efd; }
</style>

{{-- TOP NAVIGATION --}}
<div class="topbar">
    <a href="{{ url('/') }}" class="d-flex align-items-center gap-3 text-decoration-none" style="outline: none; box-shadow: none;">
        <div class="rounded-circle overflow-hidden" style="width: 40px; height: 40px; border: 1px solid #e5e7eb;">
            <img src="{{ asset('images/PCCI-Logo.svg') }}" alt="PCCI Logo" class="w-100 h-100 object-fit-contain p-1">
        </div>
        <div class="d-flex flex-column">
            <span class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif; font-size: 1rem; line-height: 1.2;">PCCI - Valenzuela</span>
        </div>
    </a>
    
    <div class="topbar-search-wrapper">
        <i class="fa fa-search"></i>
        <input type="text" class="topbar-search" placeholder="Search records, members...">
    </div>

    <div class="topbar-actions">
        <div class="position-relative" onclick="toggleNotificationPanel(event)" style="cursor:pointer; display: flex; align-items: center;">
            <i class="fa fa-bell fs-5 text-muted"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 4px; margin-left: -5px;"></span>
        </div>
        <img src="{{ asset('images/PCCI-Logo.svg') }}" class="topbar-avatar ms-3" id="topbarAvatar" alt="User">
    </div>
</div>

{{-- NOTIFICATION PANEL --}}
<div class="notification-panel" id="notificationPanel">
    <div class="notif-header">
        <h6 class="notif-header-title">Notifications <span class="notif-badge">0 New</span></h6>
        <button class="notif-clear-btn" onclick="clearNotifications(event)"><i class="fa fa-times"></i></button>
    </div>
    <div class="notif-body">
        <div class="notif-item" style="background: #f9fafb;">
            <div class="notif-icon" style="background: white; border: 1px solid #ddd;"><i class="fa fa-info-circle text-primary fs-5"></i></div>
            <div class="notif-text-content">
                <p>You have no new payment notifications today.</p>
                <small>Just now</small>
            </div>
        </div>
    </div>
    <div class="notif-footer" onclick="clearNotifications(event)">Close Panel</div>
</div>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="sidebar-profile">
        <img src="{{ asset('images/PCCI-Logo.svg') }}" alt="Profile">
        <h5 id="sidebarName">Jesus Versula</h5>
        <small id="sidebarEmail">jesus.versula@pcci.com</small>
    </div>

    <ul class="sidebar-menu text-start">
        <li class="active" id="nav-dashboard" onclick="switchTab('dashboard')">
            <i class="fa fa-chart-pie"></i> Dashboard
        </li>
        <li id="nav-members" onclick="switchTab('members')">
            <i class="fa fa-users"></i> Members
        </li>
        <li id="nav-applicants" onclick="switchTab('applicants')">
            <i class="fa fa-user-plus"></i> Applicants
        </li>
        <li id="nav-transactions" onclick="switchTab('transactions')">
            <i class="fa fa-money-bill-wave"></i> Transactions
        </li>
        <li id="nav-reports" onclick="switchTab('reports')">
            <i class="fa fa-chart-line"></i> Reports
        </li>
        <div class="sidebar-divider"></div>
        <li id="nav-settings" onclick="switchTab('settings')">
            <i class="fa fa-cog"></i> Settings
        </li>
    </ul>
</div>

{{-- MAIN CONTENT --}}
<div class="main">

    {{-- DASHBOARD OVERVIEW TAB --}}
    <div id="section-dashboard" class="content-section" style="display: block;">
        <div class="mb-4 pb-2">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Welcome, <span id="dashWelcomeName">Jesus</span>!</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Here is your financial overview for today.</p>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="summary-card dash-card bg-red">
                    <div class="label">Total Revenue</div>
                    <div class="value">PHP 205,500</div>
                    <i class="fa fa-wallet bg-icon"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card dash-card bg-green">
                    <div class="label">Paid Members</div>
                    <div class="value">Php. 205,500</div>
                    <i class="fa fa-users bg-icon"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card dash-card bg-orange">
                    <div class="label">Active Account</div>
                    <div class="value">20</div>
                    <i class="fa fa-user-check bg-icon"></i>
                </div>
            </div>
        </div>

        {{-- SMALL INFO CARD --}}
        <div class="floating-card small-info-card">
            <div class="icon-box"><i class="fa fa-calendar-check"></i></div>
            <div>
                <p>Today's Payments: <span>PHP 2,500</span></p>
                <p>Yesterday payment: <span>PHP 500</span></p>
            </div>
        </div>

        {{-- MIDDLE SECTION: CHARTS --}}
        <div class="row g-4 mb-4">
            <div class="col-lg-7">
                <div class="floating-card">
                    <div class="card-title-row">
                        <h5>Membership Revenue</h5>
                        <select class="form-select form-select-sm" style="width: auto; font-size: 12px; cursor: pointer;">
                            <option>This Month</option>
                            <option>This Year</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="floating-card">
                    <div class="card-title-row">
                        <h5>Payment Breakdown</h5>
                        <button class="btn btn-sm btn-outline-secondary" style="font-size: 12px; font-weight: bold;">View Report</button>
                    </div>
                    <div class="chart-container d-flex justify-content-center">
                        <canvas id="pieChart" style="max-height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTTOM SECTION: RECENT PAYMENTS TABLE --}}
        <div class="floating-card table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #333;">Recent Payments</h5>
                    <span class="badge-yellow">Expiring Memberships</span>
                </div>
                <div style="position: relative; width: 250px; height: 32px;">
                    <i class="fa fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa; font-size: 12px;"></i>
                    <input type="text" placeholder="Search..." style="width: 100%; height: 100%; padding-left: 30px; border-radius: 5px; border: 1px solid #ddd; font-size: 12px; outline: none;">
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Membership Type</th>
                            <th>Amount</th>
                            <th>OR Number</th>
                            <th>Date</th>
                            <th>Proof of Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="recent-payments-table-body">
                        <tr>
                            <td colspan="7" class="text-center py-4">Loading records...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- MEMBERS TAB --}}
    <div id="section-members" class="content-section" style="display: none;">
        
        {{-- Header Area --}}
        <div class="mb-4">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Members</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Manage and review all member records.</p>
        </div>

        {{-- Summary Cards Row --}}
        <div class="d-flex gap-4 mb-4 flex-wrap">
            <div class="summary-card bg-red d-flex align-items-center flex-grow-1" style="max-width: 450px;">
                <div class="icon-circle me-3"><i class="fa fa-user-times"></i></div>
                <div>
                    <div class="label">Unpaid Members</div>
                    <div class="value" id="unpaid-count">0</div>
                </div>
            </div>
            
            <div class="summary-card bg-green d-flex align-items-center flex-grow-1" style="max-width: 450px;">
                <div class="icon-circle me-3"><i class="fa fa-user-check"></i></div>
                <div>
                    <div class="label">Paid Members</div>
                    <div class="value" id="paid-count">0</div>
                </div>
            </div>
        </div>

        {{-- Main Table Card --}}
        <div class="floating-card table-card">
            
            {{-- Top Controls --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #333;">Members Directory</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill" id="total-members-badge">0 Active</span>
                </div>
                
                <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <select class="form-select form-select-sm" id="memberTypeFilter" style="width: 120px; height: 35px; font-size: 13px; cursor: pointer;">
                            <option value="all">All</option>
                            <option value="annual">Annual</option>
                            <option value="life">Life</option>
                        </select>
                        <div style="position: relative; width: 250px; height: 35px;">
                            <i class="fa fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa; font-size: 13px;"></i>
                            <input type="text" id="memberSearch" placeholder="Search members..." style="width: 100%; height: 100%; padding-left: 30px; border-radius: 6px; border: 1px solid #ddd; font-size: 13px; outline: none;">
                        </div>
                    </div>
                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center" style="width: 110px; height: 35px; font-weight: bold; border-radius: 6px;">
                        <i class="fa fa-download me-2"></i> Export
                    </button>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Membership Type</th>
                            <th>Amount</th>
                            <th>OR Number</th>
                            <th>Registered Date</th>
                            <th>Expired Date</th>
                            <th>Status</th>
                            <th>Proof of Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="members-table-body">
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fa fa-spinner fa-spin fs-3 mb-2 text-primary"></i><br>Loading members...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination Footer --}}
            <div class="d-flex justify-content-center align-items-center mt-3" style="height: 50px; gap: 15px;">
                <button class="btn btn-sm btn-light border rounded"><i class="fa fa-chevron-left"></i></button>
                <span style="font-size: 14px; font-weight: bold; color: #4b5563;" id="pagination-text">1 out 1</span>
                <button class="btn btn-sm btn-light border rounded"><i class="fa fa-chevron-right"></i></button>
            </div>

        </div>
    </div>

    {{-- APPLICANTS TAB --}}
    <div id="section-applicants" class="content-section" style="display: none;">
        <div class="mb-4 pb-3 border-bottom">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Approved Applicants</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Review and process payments for businesses approved by the Admin.</p>
        </div>

        <div id="applicants-list">
            <div class="loading"><i class="fa fa-spinner fa-spin fs-2 text-danger mb-3"></i><br>Loading approved applicants...</div>
        </div>
    </div>

    {{-- TRANSACTIONS TAB --}}
    <div id="section-transactions" class="content-section" style="display: none;">
        <div class="mb-4 pb-3 border-bottom">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Transactions History</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">View, filter, and export all processed financial transactions.</p>
        </div>

        {{-- Summary Cards Row --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="summary-card bg-green d-flex align-items-center">
                    <div class="icon-circle me-3"><i class="fa fa-wallet"></i></div>
                    <div>
                        <div class="label">Total Processed Payments</div>
                        <div class="value" id="trans-total-amount">₱0.00</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="summary-card d-flex align-items-center" style="background: linear-gradient(135deg, #0d6efd, #0b5ed7);">
                    <div class="icon-circle me-3"><i class="fa fa-receipt"></i></div>
                    <div>
                        <div class="label">Transactions Recorded</div>
                        <div class="value" id="trans-total-count">0</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Table Card --}}
        <div class="floating-card table-card">
            
            {{-- Top Controls --}}
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #333;">Transaction Records</h5>
                
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <input type="date" class="form-control form-control-sm" style="width: 140px; font-size: 13px; cursor: pointer;">
                    <span class="text-muted small">to</span>
                    <input type="date" class="form-control form-control-sm" style="width: 140px; font-size: 13px; cursor: pointer;">
                    
                    <select class="form-select form-select-sm" id="transTypeFilter" style="width: 130px; font-size: 13px; cursor: pointer;">
                        <option value="all">All Types</option>
                        <option value="new">New</option>
                        <option value="renewal">Renewal</option>
                    </select>

                    <div style="position: relative; width: 220px; height: 32px;">
                        <i class="fa fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #aaa; font-size: 12px;"></i>
                        <input type="text" id="transSearch" placeholder="Search OR#, Name..." style="width: 100%; height: 100%; padding-left: 30px; border-radius: 5px; border: 1px solid #ddd; font-size: 12px; outline: none;">
                    </div>
                    
                    <button class="btn btn-dark btn-sm d-flex align-items-center justify-content-center gap-2 px-3" style="height: 32px; font-size: 12px; font-weight: bold;">
                        <i class="fa fa-file-excel"></i> Export
                    </button>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>OR Number</th>
                            <th>Business Name</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="transactions-table-body">
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa fa-spinner fa-spin fs-3 mb-2 text-primary"></i><br>Loading transactions...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Footer --}}
            <div class="d-flex justify-content-center align-items-center mt-3" style="height: 50px; gap: 15px;">
                <button class="btn btn-sm btn-light border rounded"><i class="fa fa-chevron-left"></i></button>
                <span style="font-size: 14px; font-weight: bold; color: #4b5563;">Page 1 of 1</span>
                <button class="btn btn-sm btn-light border rounded"><i class="fa fa-chevron-right"></i></button>
            </div>

        </div>
    </div>
    
    <div id="section-reports" class="content-section" style="display: none;">
        <div class="mb-4 pb-3 border-bottom">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Reports</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Generate and review financial reports.</p>
        </div>
        <div class="custom-card text-center py-5 text-muted">
            <i class="fa fa-chart-line fs-1 mb-3 text-secondary"></i>
            <h5>Generated Reports will go here.</h5>
        </div>
    </div>

    {{-- SETTINGS TAB --}}
    <div id="section-settings" class="content-section" style="display: none;">
        <div class="mb-4 pb-2 border-bottom">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Settings</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Manage your account and system preferences.</p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="custom-card mb-4">
                    <h5 class="fw-bold mb-4" style="color: #333;">Account Settings</h5>
                    
                    <div class="setting-box" onclick="alert('Profile Settings modal will open here')">
                        <div class="setting-left">
                            <i class="fa fa-user-circle text-danger fs-4"></i>
                            <div>
                                <div style="font-size: 15px; color: #111827;">Profile Information</div>
                                <div style="font-size: 12px; color: #6b7280; font-weight: normal;">Update your name, email, and contact details</div>
                            </div>
                        </div>
                        <i class="fa fa-chevron-right text-muted"></i>
                    </div>

                    <div class="setting-box" onclick="alert('Change Password modal will open here')">
                        <div class="setting-left">
                            <i class="fa fa-lock text-danger fs-4"></i>
                            <div>
                                <div style="font-size: 15px; color: #111827;">Change Password</div>
                                <div style="font-size: 12px; color: #6b7280; font-weight: normal;">Update your account password securely</div>
                            </div>
                        </div>
                        <i class="fa fa-chevron-right text-muted"></i>
                    </div>
                </div>

                <div class="custom-card mb-4">
                    <h5 class="fw-bold mb-4" style="color: #333;">System Preferences</h5>
                    
                    <div class="setting-box">
                        <div class="setting-left">
                            <i class="fa fa-bell text-danger fs-4"></i>
                            <div>
                                <div style="font-size: 15px; color: #111827;">Notifications</div>
                                <div style="font-size: 12px; color: #6b7280; font-weight: normal;">Manage email and dashboard alerts</div>
                            </div>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" checked style="cursor:pointer;">
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end">
                    <button class="logout-btn shadow-sm" onclick="logout()">
                        <i class="fa fa-sign-out-alt"></i> Log Out of Account
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- POPUP MODAL ELEMENT (APPLICANTS TAB SPECIFIC) --}}
<div class="custom-modal-overlay" id="proofModal" onclick="closeProofModal(event)">
    <div class="custom-modal-card" onclick="event.stopPropagation()">
        <button class="modal-close-x" onclick="hideProofModal()">&times;</button>
        <h5 class="fw-bold mb-3"><i class="fa fa-file-invoice text-danger me-2"></i> Payment Verification</h5>
        
        <div class="modal-img-wrapper" id="modalImgWrapper">
            <div id="modalSpinner" class="text-muted">
                <i class="fa fa-spinner fa-spin fs-2"></i><br><small>Loading Image...</small>
            </div>
            <img id="modalImage" src="" alt="Proof of Payment" style="display: none;" onload="onImageLoad()">
        </div>

        {{-- Type and Amount Selection --}}
        <div class="mb-4">
            <label class="small text-muted fw-bold mb-2 d-block">SELECT MEMBERSHIP TYPE:</label>
            <div class="d-flex gap-2">
                <button id="toggleBtn1" class="type-toggle-btn" onclick="selectType(1)">1</button>
                <button id="toggleBtn2" class="type-toggle-btn" onclick="selectType(2)">2</button>
            </div>
            <div class="mt-2">
                <span id="typeHint" class="badge bg-light text-dark border">Loading data...</span>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <button class="btn btn-success px-4 fw-bold rounded-pill" onclick="confirmProcessing()">Confirm Choice</button>
        </div>
    </div>
</div>

{{-- MEMBER DETAILS MODAL --}}
<div class="custom-modal-overlay" id="memberDetailsModal" onclick="closeMemberModal(event)">
    <div class="custom-modal-card" style="max-width: 600px;" onclick="event.stopPropagation()">
        <button class="modal-close-x" onclick="hideMemberModal()">&times;</button>
        <h5 class="fw-bold mb-4"><i class="fa fa-user-tie text-danger me-2"></i> Member Profile Details</h5>
        
        <div id="member-detail-content">
            {{-- Content will be injected by JS --}}
        </div>

        <div class="mt-4 text-end">
            <button class="btn btn-secondary px-4 fw-bold rounded-pill" onclick="hideMemberModal()">Close Details</button>
        </div>
    </div>
</div>

{{-- SIMPLE POPUP MODAL FOR NON-APPLICANTS TAB --}}
<div class="custom-modal-overlay" id="simpleProofModal" onclick="closeSimpleProofModal(event)">
    <div class="custom-modal-card" onclick="event.stopPropagation()">
        <button class="modal-close-x" onclick="hideSimpleProofModal()">&times;</button>
        <h5 class="fw-bold mb-3"><i class="fa fa-image text-primary me-2"></i> View Proof</h5>
        
        <div class="modal-img-wrapper">
            <div id="simpleModalSpinner" class="text-muted">
                <i class="fa fa-spinner fa-spin fs-2"></i><br><small>Loading Image...</small>
            </div>
            <img id="simpleModalImage" src="" alt="Proof of Payment" style="display: none;" onload="onSimpleImageLoad()">
        </div>

        <div class="mt-4 text-end">
            <button class="btn btn-secondary px-4 fw-bold rounded-pill" onclick="hideSimpleProofModal()">Close View</button>
        </div>
    </div>
</div>

{{-- JAVASCRIPT LOGIC --}}
<script>
    const token = localStorage.getItem('token');
    
    // Global data stores
    let allMembersData = []; 
    let allApplicantsData = [];
    let currentApplicantId = null;
    let currentSelectedType = 1;

    // Fail-Safe: Pre-loaded with exact JSON data in case local fetch fails
    let membershipTypes = [
        {
            "id": 1,
            "name": "Micro",
            "price": "500.00",
            "duration_in_months": 12
        },
        {
            "id": 2,
            "name": "Small Enterprises",
            "price": "5000.00",
            "duration_in_months": 12
        }
    ];

    // --- NON-APPLICANT MODAL LOGIC (Simple View) ---
    function openSimpleProof(imageUrl) {
        if (!imageUrl || imageUrl === '#' || imageUrl === 'null' || imageUrl === 'undefined') {
            alert("No proof of payment image was found for this record.");
            return;
        }
        const modal = document.getElementById('simpleProofModal');
        const modalImg = document.getElementById('simpleModalImage');
        const spinner = document.getElementById('simpleModalSpinner');

        modalImg.style.display = 'none';
        spinner.style.display = 'block';

        let finalUrl = imageUrl;
        if (!imageUrl.startsWith('http')) {
            finalUrl = `https://pcci-laravel-api.onrender.com/${imageUrl.replace(/^\/+/, '')}`;
        }

        modalImg.src = finalUrl;
        modal.style.display = 'flex';
    }
    function onSimpleImageLoad() {
        document.getElementById('simpleModalImage').style.display = 'block';
        document.getElementById('simpleModalSpinner').style.display = 'none';
    }
    function hideSimpleProofModal() { document.getElementById('simpleProofModal').style.display = 'none'; }
    function closeSimpleProofModal(e) { if (e.target.id === 'simpleProofModal') hideSimpleProofModal(); }


    // --- APPLICANT MODAL LOGIC (Interactive) ---
    function openProof(imageUrl, applicantId) {
        if (!imageUrl || imageUrl === '#' || imageUrl === 'null' || imageUrl === 'undefined') {
            alert("No proof of payment image was found for this record.");
            return;
        }

        currentApplicantId = applicantId; // Stores the ID of the specific applicant being clicked
        const modal = document.getElementById('proofModal');
        const modalImg = document.getElementById('modalImage');
        const spinner = document.getElementById('modalSpinner');

        modalImg.style.display = 'none';
        spinner.style.display = 'block';

        let finalUrl = imageUrl;
        if (!imageUrl.startsWith('http')) {
            finalUrl = `https://pcci-laravel-api.onrender.com/${imageUrl.replace(/^\/+/, '')}`;
        }

        modalImg.src = finalUrl;
        selectType(1); // Set default choice to Micro when it opens
        modal.style.display = 'flex';
    }

    function selectType(id) {
        currentSelectedType = id; 
        const btn1 = document.getElementById('toggleBtn1');
        const btn2 = document.getElementById('toggleBtn2');
        const hint = document.getElementById('typeHint');

        // Finds the match in the Fail-Safe array (or the API if it successfully loaded)
        const data = membershipTypes.find(m => m.id == id);

        if (id == 1) {
            btn1.className = 'type-toggle-btn active-1';
            btn2.className = 'type-toggle-btn';
        } else {
            btn1.className = 'type-toggle-btn';
            btn2.className = 'type-toggle-btn active-2';
        }

        if (data) {
            hint.innerHTML = `Selected: <strong class="text-success">₱${data.price}</strong> (${data.name.toUpperCase()})`;
        } else {
            hint.innerHTML = `Error: Could not load data for Option ${id}`;
        }
    }

    function confirmProcessing() {
        // Target the specific HTML labels for the applicant being reviewed
        const amountLabel = document.getElementById(`amount-label-${currentApplicantId}`);
        const typeLabel = document.getElementById(`type-label-${currentApplicantId}`);
        
        // Grab the active data (1 or 2)
        const data = membershipTypes.find(m => m.id == currentSelectedType);

        if (data) {
            // Instantly push the new text to the screen
            if(amountLabel) {
                amountLabel.innerText = `₱${data.price}`;
                amountLabel.className = "fw-bold fs-5 text-dark"; // Keeps text dark
            }
            if(typeLabel) {
                typeLabel.innerText = data.name.toUpperCase();
                typeLabel.className = (currentSelectedType == 1) ? "text-danger fw-bold" : "text-primary fw-bold";
            }
        } else {
            alert("Error applying data to the card.");
        }
        
        hideProofModal();
    }

    function viewMemberDetails(memberId) {
        // Find the member from our stored data
        const member = allMembersData.find(m => m.id === memberId);
        if (!member) return;

        const app = member.applicant || {};
        const profile = app.basic_profile || {};
        const tracking = app.internal_tracking || {};

        const content = document.getElementById('member-detail-content');
        
        content.innerHTML = `
            <div class="row g-3 text-start">
                <div class="col-12 border-bottom pb-2 mb-2">
                    <label class="text-muted small fw-bold">REGISTERED BUSINESS NAME</label>
                    <h5 class="fw-bold text-dark">${profile.registered_business_name || 'N/A'}</h5>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold">TRADE NAME</label>
                    <p class="mb-0 fw-bold">${profile.trade_name || 'N/A'}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold">EMAIL CONTACT</label>
                    <p class="mb-0 fw-bold">${profile.email || 'N/A'}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold">MEMBERSHIP TYPE</label>
                    <p class="mb-0"><span class="badge bg-primary">${app.membership_type || 'N/A'}</span></p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold">STATUS</label>
                    <p class="mb-0"><span class="badge bg-success">${member.status.toUpperCase()}</span></p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold">DATE APPROVED</label>
                    <p class="mb-0 fw-bold">${app.date_approved || 'N/A'}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small fw-bold">JOIN DATE</label>
                    <p class="mb-0 fw-bold">${member.created_at ? member.created_at.split('T')[0] : 'N/A'}</p>
                </div>
                <div class="col-12 mt-3 p-3 bg-light rounded shadow-sm">
                    <label class="text-muted small fw-bold">INTERNAL TRACKING</label>
                    <p class="mb-0 small italic">Recommended by: <strong>${tracking.recommending_approval || 'None'}</strong></p>
                </div>
            </div>
        `;

        document.getElementById('memberDetailsModal').style.display = 'flex';
    }

    function hideMemberModal() { document.getElementById('memberDetailsModal').style.display = 'none'; }
    function closeMemberModal(e) { if (e.target.id === 'memberDetailsModal') hideMemberModal(); }

    function onImageLoad() {
        document.getElementById('modalImage').style.display = 'block';
        document.getElementById('modalSpinner').style.display = 'none';
    }
    function hideProofModal() { document.getElementById('proofModal').style.display = 'none'; }
    function closeProofModal(e) { if (e.target.id === 'proofModal') hideProofModal(); }


    document.addEventListener('DOMContentLoaded', () => {
        if (!token) {
            window.location.href = '/login';
            return;
        }

        const userName = localStorage.getItem('userName') || 'Jesus Versula';
        document.getElementById('sidebarName').innerText = userName;
        document.getElementById('dashWelcomeName').innerText = userName;

        // Fetch data
        fetchMembershipTypes(); 
        fetchApplicants();
        fetchMembers();
        fetchRecentPayments();
        initCharts();
        fetchTransactions();

        document.getElementById('memberSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const filtered = allMembersData.filter(member => {
                const name = (member.basic_profile?.registered_business_name || '').toLowerCase();
                return name.includes(searchTerm);
            });
            renderMembers(filtered);
        });
    });

    // ==========================================
    // --- MEMBERSHIP TYPES API LOGIC ---
    // ==========================================
    async function fetchMembershipTypes() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/v1/membership-types', {
                method: 'GET',
                headers: { 'Authorization': `Bearer ${token}` }
            });
            const data = await response.json();
            if (response.ok && data) {
                const fetchedData = data.data ? data.data : data;
                if(fetchedData.length > 0) membershipTypes = fetchedData;
            }
        } catch (err) { 
            console.warn("Local API fetch failed, falling back to pre-loaded JSON.", err); 
        }
    }

    // --- CHART.JS INITIALIZATION ---
    function initCharts() {
        const ctxBar = document.getElementById('barChart');
        if(ctxBar) {
            new Chart(ctxBar.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['2021', '2022', '2023', '2024'],
                    datasets: [{
                        label: 'Revenue',
                        data: [120000, 150000, 180000, 205500],
                        backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(220, 53, 69, 0.8)'],
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [2, 4], color: '#eee' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        const ctxPie = document.getElementById('pieChart');
        if(ctxPie) {
            new Chart(ctxPie.getContext('2d'), {
                type: 'doughnut', 
                data: {
                    labels: ['Monthly', 'Annual'],
                    datasets: [{
                        data: [35, 65],
                        backgroundColor: ['#6f42c1', '#dc3545'],
                        borderWidth: 2, borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: { legend: { position: 'bottom', labels: { padding: 20, font: { size: 13 } } } }
                }
            });
        }
    }

    // --- UI LOGIC ---
    function switchTab(tabName) {
        document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
        document.querySelectorAll('.sidebar-menu li').forEach(li => li.classList.remove('active'));
        
        const section = document.getElementById('section-' + tabName);
        if (section) section.style.display = 'block';
        
        const activeNav = document.getElementById('nav-' + tabName);
        if(activeNav) activeNav.classList.add('active');
    }

    function toggleNotificationPanel(event) {
        event.stopPropagation();
        const panel = document.getElementById('notificationPanel');
        panel.style.display = panel.style.display === 'flex' ? 'none' : 'flex';
    }

    document.addEventListener('click', function(event) {
        const panel = document.getElementById('notificationPanel');
        if (panel.style.display === 'flex' && !panel.contains(event.target)) panel.style.display = 'none';
    });

    function clearNotifications(event) {
        event.stopPropagation();
        document.getElementById('notificationPanel').style.display = 'none';
    }

    function logout() {
        localStorage.removeItem('token');
        localStorage.removeItem('userName');
        window.location.href = '/login';
    }

    // ==========================================
    // --- APPLICANTS API LOGIC ---
    // ==========================================
    async function fetchApplicants() {
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants?status=approved', {
                headers: { 'Authorization': `Bearer ${token}` }
            });

            if (response.status === 401) { logout(); return; }
            const data = await response.json();

            if (response.ok && data.data) {
                allApplicantsData = data.data;
                const unpaidBadge = document.getElementById('unpaid-count');
                if(unpaidBadge) unpaidBadge.innerText = allApplicantsData.length;
                renderApplicants(data.data);
            }
        } catch (err) {
            console.error(err);
        }
    }

    function renderApplicants(applicants) {
        const container = document.getElementById('applicants-list'); 
        if(!container) return;
        container.innerHTML = '';

        if (applicants.length === 0) {
            container.innerHTML = `<div class="custom-card text-center py-5 text-muted"><h5 class="fw-bold">No approved applicants pending payment.</h5></div>`;
            return;
        }

        applicants.forEach(app => {
            const safe = (val) => val || 'N/A'; 
            const profile = app.basic_profile || {};

            const html = `
                <div class="custom-card mb-4" style="border-left: 5px solid #28a745;">
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Poppins', sans-serif;">${safe(profile.registered_business_name)}</h5>
                            <small class="text-muted">Applicant ID: ${app.id} | Type: <strong id="type-label-${app.id}" class="text-danger fw-bold">PENDING SELECTION</strong></small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold border border-success border-opacity-25">
                            <i class="fa fa-check-circle me-1"></i> ${String(app.status).toUpperCase()}
                        </span>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-4">
                            <p class="mb-1"><small class="text-muted">Trade Name:</small><br><span class="fw-bold text-dark">${safe(profile.trade_name)}</span></p>
                            <p class="mb-1"><small class="text-muted">Email Contact:</small><br><span class="fw-bold text-dark">${safe(profile.email)}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><small class="text-muted">Date Submitted:</small><br><span class="fw-bold text-dark">${safe(app.date_submitted)}</span></p>
                            <p class="mb-1"><small class="text-muted">Payment Amount:</small><br><span id="amount-label-${app.id}" class="fw-bold text-dark fs-5">---</span></p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><small class="text-muted">Payment Status:</small><br><span class="fw-bold text-warning">Pending Review</span></p>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end align-items-center border-top pt-3 mt-2">
                        <button onclick="openProof('${app.proof_of_payment_url}', ${app.id})" class="btn btn-outline-primary fw-bold rounded-pill px-3 shadow-sm me-3" style="font-size: 13px;">
                            <i class="fa fa-image me-1"></i> View Proof & Select Type
                        </button>
                        <button onclick="processPayment(${app.id})" class="btn btn-success fw-bold rounded-pill px-4 shadow-sm" style="font-size: 14px;">
                            <i class="fa fa-cash-register me-2"></i> Process Payment
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });
    }

    async function processPayment(applicantId) {
        if (!confirm('Process payment for this applicant?')) return;
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/payments', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': `Bearer ${token}` },
                body: JSON.stringify({ applicant_id: applicantId, membership_type_id: currentSelectedType })
            });
            const data = await response.json();
            if (response.ok) {
                alert(`SUCCESS: Payment Processed! OR: ${data.data.or_number}`);
                fetchApplicants(); 
                fetchMembers(); 
                fetchRecentPayments();
            } else {
                alert(`Failed: ${data.message}`);
            }
        } catch (err) { console.error(err); }
    }

    // ==========================================
    // --- MEMBERSHIP API LOGIC ---
    // ==========================================
    async function fetchMembers() {
        const tbody = document.getElementById('members-table-body');
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/members', {
                headers: { 'Authorization': `Bearer ${token}` }
            });

            if (response.status === 401) { logout(); return; }
            const data = await response.json();

            if (response.ok && data.data) {
                allMembersData = data.data; 
                const paidBadge = document.getElementById('paid-count');
                if(paidBadge) paidBadge.innerText = allMembersData.length;
                renderMembers(allMembersData);
            }
        } catch (err) {
            console.error(err);
        }
    }

    function renderMembers(members) {
        const tbody = document.getElementById('members-table-body');
        if(!tbody) return;
        tbody.innerHTML = '';
        members.forEach(member => {
            const safe = (val) => val || 'N/A'; 
            const applicant = member.applicant || {};
            const profile = applicant.basic_profile || {};
            const name = profile.registered_business_name || 'N/A';
            const type = safe(member.membership_type_id == 1 ? 'Micro' : 'Small Enterprises');
            const regDate = member.induction_date ? member.induction_date.split('T')[0] : 'N/A';
            const expDate = member.membership_end_date ? member.membership_end_date.split('T')[0] : 'N/A';
            const amount = member.membership_type_id == 1 ? '₱500.00' : '₱5,000.00';
            const orNumber = `OR-${10000 + member.id}`; 

            let proofUrl = member.proof_of_payment_url || applicant.proof_of_payment_url || '#';
            const proofHtml = proofUrl !== '#' 
                ? `<button class="action-btn btn-gray" onclick="openSimpleProof('${proofUrl}')">View</button>`
                : `<span class="text-muted" style="font-size: 11px;">No File</span>`;

            tbody.insertAdjacentHTML('beforeend', `
                <tr>
                    <td style="font-weight: bold; color: #111827;">${name}</td>
                    <td>${type}</td>
                    <td style="font-weight: 600;">${amount}</td>
                    <td>${orNumber}</td>
                    <td>${regDate}</td>
                    <td>${expDate}</td>
                    <td><span class="badge-pill-green">Active</span></td>
                    <td>${proofHtml}</td>
                    <td style="min-width: 320px;">
                        <button class="action-btn btn-gray" onclick="viewMemberDetails(${member.id})"><i class="fa fa-info-circle"></i> Details</button>
                        <button class="action-btn btn-green"><i class="fa fa-check"></i> Verify</button>
                        <button class="action-btn btn-dark-red"><i class="fa fa-print"></i> Print</button>
                    </td>
                </tr>
            `);
        });
    }

    // ==========================================
    // --- RECENT PAYMENTS LOGIC ---
    // ==========================================
    async function fetchRecentPayments() {
        const tbody = document.getElementById('recent-payments-table-body');
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants?status=approved', {
                headers: { 'Authorization': `Bearer ${token}` }
            });
            const data = await response.json();
            
            if (response.ok && data.data) {
                tbody.innerHTML = ''; 
                data.data.forEach(app => {
                    const profile = app.basic_profile || {};
                    const orNumber = `OR-${1000 + app.id}`;
                    let proofUrl = app.proof_of_payment_url || '#';
                    
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td style="font-weight: bold; color: #222;">${profile.registered_business_name || 'N/A'}</td>
                            <td>${app.membership_type || 'Annual'}</td>
                            <td style="font-weight: bold;">5,000</td>
                            <td>${orNumber}</td>
                            <td>${app.date_approved || 'N/A'}</td>
                            <td>
                                <button class="btn btn-sm btn-link text-primary text-decoration-none" style="font-size: 12px;" onclick="openSimpleProof('${proofUrl}')">
                                    <i class="fa fa-image"></i> View File
                                </button>
                            </td>
                            <td>
                                <button class="action-btn btn-gray" onclick="openSimpleProof('${proofUrl}')">View</button>
                                <button class="action-btn btn-green" onclick="processPayment(${app.id})">Verify</button>
                                <button class="action-btn btn-red">Reject</button>
                                <button class="action-btn btn-orange"><i class="fa fa-print"></i> Receipt</button>
                            </td>
                        </tr>
                    `);
                });
            }
        } catch (err) { console.error(err); }
    }

    // ==========================================
    // --- TRANSACTIONS API LOGIC ---
    // ==========================================
    async function fetchTransactions() {
        const tbody = document.getElementById('transactions-table-body');
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/payments', {
                method: 'GET',
                headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
            });
            const data = await response.json();
            if (response.ok && data.data) {
                renderTransactions(data.data);
                updateTransactionSummary(data.data);
            }
        } catch (err) { console.error(err); }
    }

    function renderTransactions(transactions) {
        const tbody = document.getElementById('transactions-table-body');
        if (!tbody) return;
        tbody.innerHTML = transactions.length === 0 ? '<tr><td colspan="7">No records.</td></tr>' : '';
        transactions.forEach(txn => {
            const date = txn.created_at ? txn.created_at.split('T')[0] : 'N/A';
            const businessName = txn.applicant?.basic_profile?.registered_business_name || 'N/A';
            tbody.insertAdjacentHTML('beforeend', `
                <tr>
                    <td class="text-muted">${date}</td>
                    <td class="fw-bold">${txn.or_number || 'N/A'}</td>
                    <td class="fw-bold">${businessName}</td>
                    <td>${txn.membership_type?.name || 'N/A'}</td>
                    <td class="fw-bold text-success">₱${txn.amount || '0'}</td>
                    <td><span class="badge bg-success bg-opacity-10 text-success">PAID</span></td>
                    <td><button class="action-btn btn-gray">View</button></td>
                </tr>`);
        });
    }

    function updateTransactionSummary(transactions) {
        const sum = transactions.reduce((acc, txn) => acc + (parseFloat(txn.amount) || 0), 0);
        document.getElementById('trans-total-amount').innerText = `₱${sum.toLocaleString()}`;
        document.getElementById('trans-total-count').innerText = transactions.length;
    }
</script>
@endsection 