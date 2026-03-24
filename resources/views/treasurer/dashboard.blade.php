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
html, body { margin: 0; padding: 0; background: #f3f4f6; font-family: 'Inter', 'Poppins', sans-serif; overflow-x: hidden; }
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
.topbar-search { width: 100%; height: 36px; padding: 6px 15px 6px 35px; border-radius: 8px; border: 1px solid #eee; background: #eee; font-size: 13px; outline: none; }
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
    position: fixed; top: 70px; left: 0; width: 250px; height: calc(100vh - 70px);
    background: #f8f9fb; border-right: 1px solid #e5e7eb; display: flex; flex-direction: column; z-index: 1000; overflow-y: auto;
}
.sidebar-profile { padding: 20px 15px 15px; text-align: center; border-bottom: 1px solid #e5e7eb; }
.sidebar-profile img { width: 65px; height: 65px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e7eb; margin-bottom: 10px; }
.sidebar-profile h5 { font-size: 15px; font-weight: bold; margin-bottom: 0; color: #111; }
.sidebar-profile p { font-size: 13px; font-weight: bold; color: #4b5563; margin-bottom: 0; }
.sidebar-profile small { font-size: 12px; color: #777; }

.sidebar-menu { list-style: none; padding: 15px 10px; margin: 0; flex-grow: 1; }
.sidebar-menu li { height: 45px; padding: 0 15px; margin-bottom: 4px; cursor: pointer; font-weight: 600; font-size: 14px; color: #4b5563; border-radius: 8px; display: flex; align-items: center; gap: 10px; transition: 0.2s;}
.sidebar-menu li i { font-size: 16px; width: 20px; text-align: center; }
.sidebar-menu li.active { background: #e5e7eb; color: #111; border-left: 4px solid #b61b2a;}
.sidebar-menu li:hover:not(.active) { background: #eef0f4; }
.sidebar-divider { border-top: 1px solid #e5e7eb; margin: 10px; }

/* =========================================
   4. MAIN CONTENT AREA & COMPONENTS
   ========================================= */
.main { margin-top: 70px; margin-left: 250px; padding: 25px; min-height: calc(100vh - 70px); background: #f4f6f9;}
.content-section { display: none; padding-bottom: 40px; }

/* Floating Cards Base */
.floating-card { background: #ffffff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 16px; border: none; }
.custom-card { background: #ffffff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px;}

/* Specific Summary Cards (Dashboard) */
.summary-card { width: 100%; height: 105px; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 20px; color: white; position: relative; overflow: hidden; display: flex; align-items: center;}
.summary-card.dash-card { flex-direction: column; align-items: flex-start; justify-content: center; }
.summary-card .icon-circle { width: 45px; height: 45px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; justify-content: center; align-items: center; font-size: 20px; flex-shrink: 0;}
.summary-card .label { font-size: 14px; font-weight: 500; opacity: 0.9; margin-bottom: 2px; }
.summary-card .value { font-size: 26px; font-weight: bold; margin: 0; line-height: 1; }
.summary-card .bg-icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 40px; opacity: 0.2; }

.bg-red { background: linear-gradient(135deg, #e53935, #c62828); }
.bg-green { background: linear-gradient(135deg, #43a047, #2e7d32); }
.bg-orange { background: linear-gradient(135deg, #fb8c00, #ef6c00); }

/* Table Area */
.table-card { min-height: 350px; padding: 15px 20px; }
.custom-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.custom-table th { background: #f8f9fb; color: #777; font-weight: 600; padding: 12px 10px; text-align: left; position: sticky; top: 0; z-index: 1;}
.custom-table td { padding: 12px 10px; border-bottom: 1px solid #eee; color: #444; vertical-align: middle; height: 45px;}
.custom-table tbody tr:hover { background-color: #f9fafb; }

/* Action Buttons & Badges */
.action-btn { height: 30px; padding: 0 10px; border-radius: 6px; border: none; font-size: 12px; font-weight: bold; cursor: pointer; color: white; display: inline-flex; align-items: center; justify-content: center; gap: 5px; margin-right: 4px;}
.btn-gray { background-color: #9ca3af; width: 85px; }
.btn-green { background-color: #22c55e; width: 75px; } /* Updated Green */
.btn-red { background-color: #ef4444; width: 75px; } /* Updated Red */
.btn-dark-red { background-color: #8b0000; width: 85px; }

/* Status Badges */
.status-badge { display: inline-block; padding: 4px 0; border-radius: 50rem; font-size: 12px; color: white; text-align: center; width: 100px; font-weight: 500; }
.status-completed { background-color: #22c55e; }
.status-pending { background-color: #f59e0b; }
.status-failed { background-color: #ef4444; }

/* =========================================
   NEW: REPORTS TAB SPECIFIC STYLES
   ========================================= */
.reports-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}

.report-stat-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    height: 120px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 6px;
}

.report-stat-card .report-label { font-size: 12px; color: #777; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;}
.report-stat-card .report-value { font-size: 24px; font-weight: 600; color: #111; margin: 0; line-height: 1;}
.report-stat-card .report-indicator { font-size: 11px; font-weight: 600; }
.text-green { color: #22c55e !important; }
.text-red { color: #ef4444 !important; }

.report-chart-box {
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    height: 300px;
    display: flex;
    flex-direction: column;
}

.mini-card-container {
    display: flex; gap: 16px; align-items: center; justify-content: center; height: 100%;
}

.mini-stat-card {
    background: #f8f9fb;
    border-radius: 12px;
    width: 150px;
    height: 90px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border: 1px solid #eee;
}
.mini-stat-card .m-val { font-size: 20px; font-weight: 600; color: #111; line-height: 1.2;}
.mini-stat-card .m-lbl { font-size: 12px; color: #777; }

.report-flat-table { width: 100%; border-collapse: collapse; }
.report-flat-table td { padding: 12px 0; border-bottom: 1px solid #eee; font-size: 13px; color: #111; font-weight: 500;}
.report-flat-table tr:last-child td { border-bottom: none; }

/* =========================================
   MODAL STYLES
   ========================================= */
.custom-modal-overlay {
    position: fixed; top: 0; left: 250px; width: calc(100% - 250px); height: 100%; 
    background: rgba(0, 0, 0, 0.7); display: none; justify-content: center; align-items: center; 
    z-index: 1060; backdrop-filter: blur(3px);
}
.custom-modal-card {
    background: #ffffff; width: 90%; max-width: 700px; border-radius: 16px; padding: 25px; 
    box-shadow: 0 20px 40px rgba(0,0,0,0.4); position: relative; animation: slideIn 0.3s ease-out;
}
@keyframes slideIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
.modal-close-x { position: absolute; top: 15px; right: 20px; font-size: 28px; color: #888; cursor: pointer; border: none; background: none; line-height: 1; }
.modal-img-wrapper { width: 100%; min-height: 120px; display: flex; justify-content: center; align-items: center; position: relative; }
.modal-img-wrapper img { max-width: 100%; max-height: 450px; width: auto; height: auto; border-radius: 8px; border: 1px solid #ddd; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: block; }
.type-toggle-btn { width: 45px; height: 45px; border-radius: 8px; border: 1px solid #ddd; background: white; font-weight: bold; cursor: pointer; transition: 0.2s; }
.type-toggle-btn.active-1 { background: #ef4444; color: white; border-color: #ef4444; }
.type-toggle-btn.active-2 { background: #3b82f6; color: white; border-color: #3b82f6; }
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
                    <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #111;">Recent Payments</h5>
                    <span class="badge-yellow">Expiring Memberships</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Business Name</th>
                            <th>Membership Type</th>
                            <th>Amount</th>
                            <th>OR Number</th>
                            <th>Date</th>
                            <th>Proof of Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="recent-payments-table-body">
                        <tr><td colspan="7" class="text-center py-4">Loading records...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- MEMBERS TAB --}}
    <div id="section-members" class="content-section" style="display: none;">
        <div class="mb-4">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Members</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Manage and review all member records.</p>
        </div>

        <div class="d-flex gap-4 mb-4 flex-wrap">
            <div class="summary-card bg-red d-flex align-items-center flex-grow-1" style="max-width: 450px;">
                <div class="icon-circle me-3"><i class="fa fa-user-times"></i></div>
                <div><div class="label">Unpaid Members</div><div class="value" id="unpaid-count">0</div></div>
            </div>
            <div class="summary-card bg-green d-flex align-items-center flex-grow-1" style="max-width: 450px;">
                <div class="icon-circle me-3"><i class="fa fa-user-check"></i></div>
                <div><div class="label">Paid Members</div><div class="value" id="paid-count">0</div></div>
            </div>
        </div>

        <div class="floating-card table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #111;">Members Directory</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill" id="total-members-badge">0 Active</span>
                </div>
                <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <input type="text" id="memberSearch" placeholder="Search members..." style="height: 35px; padding-left: 15px; border-radius: 6px; border: 1px solid #ddd; font-size: 13px; outline: none;">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>OR Number</th>
                            <th>Reg Date</th>
                            <th>Exp Date</th>
                            <th>Status</th>
                            <th>Proof</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="members-table-body">
                        <tr><td colspan="9" class="text-center py-5 text-muted"><i class="fa fa-spinner fa-spin fs-3 mb-2"></i><br>Loading members...</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-3" style="height: 50px; gap: 15px;">
                <button id="member-prev-btn" class="btn btn-sm btn-light border rounded" onclick="prevMemberPage()"><i class="fa fa-chevron-left"></i></button>
                <span style="font-size: 14px; font-weight: bold; color: #4b5563;" id="member-pagination-text">Page 1 of 1</span>
                <button id="member-next-btn" class="btn btn-sm btn-light border rounded" onclick="nextMemberPage()"><i class="fa fa-chevron-right"></i></button>
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
        <div class="mb-4">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Transactions</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Manage and track all payment activities.</p>
        </div>

        <div class="reports-grid mb-4">
            <div class="report-stat-card">
                <div class="report-label">Total Payments</div>
                <div class="report-value" id="trans-total-amt">Php. 0</div>
                <div class="report-indicator text-green"><i class="fa fa-arrow-up"></i> + 20.3 % <span class="text-muted fw-normal">from last month</span></div>
            </div>
            <div class="report-stat-card">
                <div class="report-label">Pending Payments</div>
                <div class="report-value" id="trans-pending-amt">Php. 0</div>
            </div>
            <div class="report-stat-card">
                <div class="report-label">Complete Payments</div>
                <div class="report-value" id="trans-complete-amt">Php. 0</div>
            </div>
            <div class="report-stat-card">
                <div class="report-label">Failed Payment</div>
                <div class="report-value" id="trans-failed-amt">Php. 0</div>
            </div>
        </div>

        <div class="floating-card table-card" style="padding: 0; overflow: hidden; border-bottom: 6px solid #b61b2a;">
            <div class="table-responsive">
                <table class="custom-table mb-0">
                    <thead style="background-color: #f8f9fb;">
                        <tr>
                            <th class="text-dark py-3 ps-4">Member Name</th>
                            <th class="text-dark py-3">Payment Type</th>
                            <th class="text-dark py-3">Payment Date</th>
                            <th class="text-dark py-3">Membership Type</th>
                            <th class="text-dark py-3">OR Number</th>
                            <th class="text-dark py-3">Received by</th>
                            <th class="text-dark py-3 text-center">Status</th>
                            <th class="text-dark py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="transactions-table-body">
                        <tr><td colspan="8" class="text-center py-5 text-muted"><i class="fa fa-spinner fa-spin fs-3 mb-2"></i><br>Loading transactions...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    {{-- REPORTS TAB (NEW LAYOUT) --}}
    <div id="section-reports" class="content-section" style="display: none;">
        
        {{-- Top Section Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif; font-size: 24px;">Reports</h3>
                <p class="text-muted mb-0" style="font-size: 14px;">Generate and review comprehensive financial analytics.</p>
            </div>
            <div>
                <button class="btn btn-success fw-bold rounded-pill px-4 py-2 shadow-sm" style="background: #22c55e; border: none; font-size: 14px;">
                    <i class="fa fa-file-excel me-2"></i> Export to Excel
                </button>
            </div>
        </div>

        {{-- 4 Grid Cards --}}
        <div class="reports-grid">
            <div class="report-stat-card">
                <div class="report-label">Monthly Revenue</div>
                <div class="report-value">₱24,500</div>
                <div class="report-indicator text-green"><i class="fa fa-arrow-up"></i> 8.2% <span class="text-muted fw-normal">vs last month</span></div>
            </div>
            <div class="report-stat-card">
                <div class="report-label">Total Active Members</div>
                <div class="report-value" id="report-active-members">0</div>
                <div class="report-indicator text-green"><i class="fa fa-arrow-up"></i> 12 <span class="text-muted fw-normal">new this week</span></div>
            </div>
            <div class="report-stat-card">
                <div class="report-label">Pending Verifications</div>
                <div class="report-value text-warning" id="report-pending-count">0</div>
                <div class="report-indicator text-muted fw-normal">Requires Treasurer action</div>
            </div>
            <div class="report-stat-card">
                <div class="report-label">Failed / Cancelled</div>
                <div class="report-value text-red">0</div>
                <div class="report-indicator text-green"><i class="fa fa-arrow-down"></i> 2.1% <span class="text-muted fw-normal">vs last month</span></div>
            </div>
        </div>

        {{-- Graph Cards (Middle Section) --}}
        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="report-chart-box">
                    <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Membership Revenue</h6>
                    <div style="flex-grow: 1; position: relative;">
                        <canvas id="reportBarChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="report-chart-box">
                    <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Payment Breakdown</h6>
                    <div style="flex-grow: 1; position: relative; display:flex; justify-content:center;">
                        <canvas id="reportPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Cards --}}
        <div class="row g-4">
            <div class="col-md-6">
                <div class="report-chart-box h-100">
                    <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Collection Status</h6>
                    <div class="mini-card-container">
                        <div class="mini-stat-card">
                            <div class="m-val text-green">92%</div>
                            <div class="m-lbl">Collected</div>
                        </div>
                        <div class="mini-stat-card">
                            <div class="m-val text-red">8%</div>
                            <div class="m-lbl">Overdue</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="report-chart-box h-100" style="overflow-y: auto;">
                    <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Business Type Distribution</h6>
                    <table class="report-flat-table">
                        <tr>
                            <td>Retail & Merchandising</td>
                            <td class="text-end fw-bold">45%</td>
                        </tr>
                        <tr>
                            <td>Manufacturing</td>
                            <td class="text-end fw-bold">25%</td>
                        </tr>
                        <tr>
                            <td>Services & Consulting</td>
                            <td class="text-end fw-bold">20%</td>
                        </tr>
                        <tr>
                            <td>IT & Technology</td>
                            <td class="text-end fw-bold">10%</td>
                        </tr>
                    </table>
                </div>
            </div>
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
                    <div class="setting-box">
                        <div class="setting-left"><i class="fa fa-user-circle text-danger fs-4"></i><div><div style="font-size: 15px; color: #111;">Profile Information</div><div style="font-size: 12px; color: #777; font-weight: normal;">Update your name, email, and contact details</div></div></div>
                        <i class="fa fa-chevron-right text-muted"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="logout-btn shadow-sm" onclick="logout()"><i class="fa fa-sign-out-alt"></i> Log Out</button>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- MODALS --}}
<div class="custom-modal-overlay" id="proofModal" onclick="closeProofModal(event)">
    <div class="custom-modal-card" onclick="event.stopPropagation()">
        <button class="modal-close-x" onclick="hideProofModal()">&times;</button>
        <h5 class="fw-bold mb-3"><i class="fa fa-file-invoice text-danger me-2"></i> Payment Verification</h5>
        
        <div class="modal-img-wrapper" id="modalImgWrapper">
            <div id="modalSpinner" class="text-muted"><i class="fa fa-spinner fa-spin fs-2"></i><br><small>Loading Image...</small></div>
            <img id="modalImage" src="" alt="Proof of Payment" style="display: none;" onload="onImageLoad()">
        </div>

        <div class="mt-4">
            <label class="small text-muted fw-bold mb-2 d-block">SELECT MEMBERSHIP TYPE:</label>
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <button id="toggleBtn1" class="type-toggle-btn" onclick="selectType(1)">1</button>
                    <button id="toggleBtn2" class="type-toggle-btn" onclick="selectType(2)">2</button>
                </div>
                <button class="btn btn-success px-4 fw-bold rounded-pill shadow-sm" onclick="confirmProcessing()" style="height: 45px; background: #22c55e; border: none;">
                    Confirm Choice
                </button>
            </div>
        </div>
    </div>
</div>

<div class="custom-modal-overlay" id="memberDetailsModal" onclick="closeMemberModal(event)">
    <div class="custom-modal-card" style="max-width: 600px;" onclick="event.stopPropagation()">
        <button class="modal-close-x" onclick="hideMemberModal()">&times;</button>
        <h5 class="fw-bold mb-4"><i class="fa fa-user-tie text-danger me-2"></i> Member Profile Details</h5>
        <div id="member-detail-content"></div>
        <div class="mt-4 text-end"><button class="btn btn-secondary px-4 fw-bold rounded-pill" onclick="hideMemberModal()">Close Details</button></div>
    </div>
</div>

<div class="custom-modal-overlay" id="simpleProofModal" onclick="closeSimpleProofModal(event)">
    <div class="custom-modal-card" onclick="event.stopPropagation()">
        <button class="modal-close-x" onclick="hideSimpleProofModal()">&times;</button>
        <h5 class="fw-bold mb-3"><i class="fa fa-image text-primary me-2"></i> View Proof</h5>
        <div class="modal-img-wrapper">
            <div id="simpleModalSpinner" class="text-muted"><i class="fa fa-spinner fa-spin fs-2"></i><br><small>Loading</small></div>
            <img id="simpleModalImage" src="" alt="Proof of Payment" style="display: none;" onload="onSimpleImageLoad()">
        </div>
    </div>
</div>

{{-- JAVASCRIPT LOGIC --}}
<script>
    const token = localStorage.getItem('token');
    
    // Global data
    let allMembersData = []; 
    let filteredMembersData = []; 
    let currentMemberPage = 1;
    const membersPerPage = 10; 
    let allApplicantsData = [];
    let currentApplicantId = null;
    let currentSelectedType = 1;

    let membershipTypes = [
        { "id": 1, "name": "Micro", "price": "500.00", "duration_in_months": 12 },
        { "id": 2, "name": "Small Enterprises", "price": "5000.00", "duration_in_months": 12 }
    ];

    // Check Token Middleware
    function checkAuth(res) {
        if (res.status === 401) {
            localStorage.removeItem('token');
            window.location.href = '/login';
            return false;
        }
        return true;
    }

    // Simple Proof Modal
    function openSimpleProof(imageUrl) {
        if (!imageUrl || imageUrl === '#' || imageUrl === 'null') { alert("No proof found."); return; }
        const modalImg = document.getElementById('simpleModalImage');
        document.getElementById('simpleModalSpinner').style.display = 'block';
        modalImg.style.display = 'none';
        modalImg.src = imageUrl.startsWith('http') ? imageUrl : `https://pcci-laravel-api.onrender.com/${imageUrl.replace(/^\/+/, '')}`;
        document.getElementById('simpleProofModal').style.display = 'flex';
    }
    function onSimpleImageLoad() {
        document.getElementById('simpleModalImage').style.display = 'block';
        document.getElementById('simpleModalSpinner').style.display = 'none';
    }
    function hideSimpleProofModal() { document.getElementById('simpleProofModal').style.display = 'none'; }
    function closeSimpleProofModal(e) { if (e.target.id === 'simpleProofModal') hideSimpleProofModal(); }

    // Applicant Proof Modal
    function openProof(imageUrl, applicantId) {
        if (!imageUrl || imageUrl === '#' || imageUrl === 'null') { alert("No proof found."); return; }
        currentApplicantId = applicantId; 
        const modalImg = document.getElementById('modalImage');
        document.getElementById('modalSpinner').style.display = 'block';
        modalImg.style.display = 'none';
        modalImg.src = imageUrl.startsWith('http') ? imageUrl : `https://pcci-laravel-api.onrender.com/${imageUrl.replace(/^\/+/, '')}`;
        selectType(1); 
        document.getElementById('proofModal').style.display = 'flex';
    }
    function onImageLoad() {
        document.getElementById('modalImage').style.display = 'block';
        document.getElementById('modalSpinner').style.display = 'none';
    }
    function hideProofModal() { document.getElementById('proofModal').style.display = 'none'; }
    function closeProofModal(e) { if (e.target.id === 'proofModal') hideProofModal(); }

    function selectType(id) {
        currentSelectedType = id; 
        document.getElementById('toggleBtn1').className = (id == 1) ? 'type-toggle-btn active-1' : 'type-toggle-btn';
        document.getElementById('toggleBtn2').className = (id == 2) ? 'type-toggle-btn active-2' : 'type-toggle-btn';
    }

    async function confirmProcessing() {
        const data = membershipTypes.find(m => m.id == currentSelectedType);
        if (!data) return;

        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants?status=paid', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': `Bearer ${token}` },
                body: JSON.stringify({ applicant_id: currentApplicantId, membership_type_id: currentSelectedType })
            });

            if (!checkAuth(response)) return;

            if (response.ok || response.status === 200 || response.status === 201) {
                hideProofModal();
                await fetchApplicants(); 
                fetchMembers();        
                fetchTransactions();   
                fetchRecentPayments(); 
                alert("Success: Payment Processed!");
            } else {
                const result = await response.json();
                alert(`Backend Error: ${result.message || 'Forbidden'}`);
            }
        } catch (err) { alert("Network error: Could not reach the server."); }
    }

    // Member Details
    function viewMemberDetails(memberId) {
        const member = allMembersData.find(m => m.id === memberId);
        if (!member) return;
        const profile = member.applicant?.basic_profile || {};
        
        document.getElementById('member-detail-content').innerHTML = `
            <div class="row g-3 text-start">
                <div class="col-12 border-bottom pb-2 mb-2"><label class="text-muted small fw-bold">BUSINESS NAME</label><h5 class="fw-bold text-dark">${profile.registered_business_name || 'N/A'}</h5></div>
                <div class="col-md-6"><label class="text-muted small fw-bold">TRADE NAME</label><p class="fw-bold">${profile.trade_name || 'N/A'}</p></div>
                <div class="col-md-6"><label class="text-muted small fw-bold">EMAIL</label><p class="fw-bold">${profile.email || 'N/A'}</p></div>
            </div>
        `;
        document.getElementById('memberDetailsModal').style.display = 'flex';
    }
    function hideMemberModal() { document.getElementById('memberDetailsModal').style.display = 'none'; }
    function closeMemberModal(e) { if (e.target.id === 'memberDetailsModal') hideMemberModal(); }

    document.addEventListener('DOMContentLoaded', () => {
        if (!token) { window.location.href = '/login'; return; }
        document.getElementById('sidebarName').innerText = localStorage.getItem('userName') || 'Jesus Versula';
        
        fetchApplicants();
        fetchMembers();
        fetchRecentPayments();
        fetchTransactions();
        initCharts(); // Includes the new Reports charts!

        document.getElementById('memberSearch').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            filteredMembersData = allMembersData.filter(m => (m.applicant?.basic_profile?.registered_business_name || '').toLowerCase().includes(term));
            currentMemberPage = 1;
            displayMembersPage();
        });
    });

    // API Fetches
    async function fetchApplicants() {
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants?status=approved', { headers: { 'Authorization': `Bearer ${token}` } });
            if (!checkAuth(response)) return;
            const data = await response.json();
            if (response.ok && data.data) {
                allApplicantsData = data.data;
                document.getElementById('report-pending-count').innerText = allApplicantsData.length; // Update Reports Tab
                
                const container = document.getElementById('applicants-list'); 
                container.innerHTML = allApplicantsData.length === 0 ? `<div class="custom-card text-center py-5 text-muted"><h5>No pending applicants.</h5></div>` : '';
                
                allApplicantsData.forEach(app => {
                    const profile = app.basic_profile || {};
                    container.insertAdjacentHTML('beforeend', `
                        <div class="custom-card mb-4" style="border-left: 5px solid #f59e0b;">
                            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
                                <div><h5 class="fw-bold mb-0 text-dark">${profile.registered_business_name || 'N/A'}</h5><small class="text-muted">Applicant ID: ${app.id}</small></div>
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">APPROVED</span>
                            </div>
                            <div class="d-flex justify-content-end pt-2">
                                <button onclick="openProof('${app.proof_of_payment_url}', ${app.id})" class="btn btn-outline-primary fw-bold rounded-pill px-4 shadow-sm" style="font-size: 13px;">
                                    <i class="fa fa-image me-1"></i> View Proof & Process Payment
                                </button>
                            </div>
                        </div>
                    `);
                });
            }
        } catch (err) {}
    }

    async function fetchMembers() {
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/members', { headers: { 'Authorization': `Bearer ${token}` } });
            if (!checkAuth(response)) return;
            const data = await response.json();
            if (response.ok && data.data) {
                allMembersData = data.data; 
                filteredMembersData = data.data; 
                document.getElementById('report-active-members').innerText = allMembersData.length; // Update Reports Tab
                displayMembersPage(); 
            }
        } catch (err) {}
    }

    function displayMembersPage() {
        const totalPages = Math.ceil(filteredMembersData.length / membersPerPage) || 1;
        if (currentMemberPage > totalPages) currentMemberPage = totalPages;
        if (currentMemberPage < 1) currentMemberPage = 1;
        
        const pageData = filteredMembersData.slice((currentMemberPage - 1) * membersPerPage, currentMemberPage * membersPerPage);
        
        const tbody = document.getElementById('members-table-body');
        tbody.innerHTML = '';
        pageData.forEach(member => {
            const name = member.applicant?.basic_profile?.registered_business_name || 'N/A';
            const orNumber = `OR-${10000 + member.id}`; 
            tbody.insertAdjacentHTML('beforeend', `
                <tr>
                    <td class="fw-bold text-dark">${name}</td>
                    <td>Annual</td>
                    <td class="fw-bold">₱5,000</td>
                    <td>${orNumber}</td>
                    <td>${member.created_at ? member.created_at.split('T')[0] : 'N/A'}</td>
                    <td>2027-01-01</td>
                    <td><span class="status-badge status-completed">Active</span></td>
                    <td><button class="btn btn-sm btn-link p-0" onclick="openSimpleProof('${member.proof_of_payment_url}')">View File</button></td>
                    <td><button class="action-btn btn-gray" onclick="viewMemberDetails(${member.id})">Details</button></td>
                </tr>
            `);
        });
        document.getElementById('member-pagination-text').innerText = `Page ${currentMemberPage} of ${totalPages}`;
    }

    function prevMemberPage() { if (currentMemberPage > 1) { currentMemberPage--; displayMembersPage(); } }
    function nextMemberPage() { if (currentMemberPage < Math.ceil(filteredMembersData.length / membersPerPage)) { currentMemberPage++; displayMembersPage(); } }

    async function fetchRecentPayments() {
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants?status=approved', { headers: { 'Authorization': `Bearer ${token}` } });
            if (!checkAuth(response)) return;
            const data = await response.json();
            if (response.ok && data.data) {
                const tbody = document.getElementById('recent-payments-table-body');
                tbody.innerHTML = ''; 
                data.data.forEach(app => {
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td class="fw-bold text-dark">${app.basic_profile?.registered_business_name || 'N/A'}</td>
                            <td>Annual</td>
                            <td class="fw-bold">₱5,000</td>
                            <td>Pending</td>
                            <td>${app.date_approved || 'N/A'}</td>
                            <td><button class="btn btn-sm btn-link p-0" onclick="openSimpleProof('${app.proof_of_payment_url}')">View File</button></td>
                            <td><button class="action-btn btn-green" onclick="openProof('${app.proof_of_payment_url}', ${app.id})">Process</button></td>
                        </tr>
                    `);
                });
            }
        } catch (err) {}
    }

    async function fetchTransactions() {
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/payments', { headers: { 'Authorization': `Bearer ${token}` } });
            if (!checkAuth(response)) return;
            const data = await response.json();
            if (response.ok && data.data) {
                const tbody = document.getElementById('transactions-table-body');
                tbody.innerHTML = '';
                
                let total = 0, pending = 0, complete = 0, failed = 0;

                data.data.forEach(txn => {
                    const amt = parseFloat(txn.amount) || 0;
                    const status = String(txn.status || 'completed').toLowerCase();
                    total += amt;
                    if (status === 'completed' || status === 'paid') complete += amt;
                    else if (status === 'failed') failed += amt;
                    else pending += amt;

                    let statClass = status === 'pending' ? 'status-pending' : (status === 'failed' ? 'status-failed' : 'status-completed');

                    tbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td class="fw-bold text-dark">${txn.applicant?.basic_profile?.registered_business_name || 'Unknown'}</td>
                            <td>Gcash</td>
                            <td>${txn.created_at ? txn.created_at.split('T')[0] : 'N/A'}</td>
                            <td>Annual</td>
                            <td>${txn.or_number || 'N/A'}</td>
                            <td>Jesus V.</td>
                            <td class="text-center"><span class="status-badge ${statClass}">${status.toUpperCase()}</span></td>
                            <td class="text-center"><button class="action-icon icon-edit"><i class="far fa-edit"></i></button></td>
                        </tr>
                    `);
                });
                
                const fmt = val => `₱${val.toLocaleString()}`;
                document.getElementById('trans-total-amt').innerText = fmt(total);
                document.getElementById('trans-pending-amt').innerText = fmt(pending);
                document.getElementById('trans-complete-amt').innerText = fmt(complete);
                document.getElementById('trans-failed-amt').innerText = fmt(failed);
            }
        } catch (err) {}
    }

    // --- CHARTS (DASHBOARD & REPORTS) ---
    function initCharts() {
        // Dashboard Charts
        const ctxBar = document.getElementById('barChart');
        if(ctxBar) new Chart(ctxBar, { type: 'bar', data: { labels: ['21', '22', '23', '24'], datasets: [{ data: [120, 150, 180, 205], backgroundColor: '#3b82f6' }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } } });

        // REPORTS TAB: Grouped Bar Chart (Membership Revenue)
        const reportBar = document.getElementById('reportBarChart');
        if(reportBar) {
            new Chart(reportBar.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [
                        { label: 'Micro', data: [120, 150, 180, 90, 110, 140], backgroundColor: '#3b82f6', barPercentage: 0.6, categoryPercentage: 0.8 },
                        { label: 'Small', data: [200, 220, 250, 180, 210, 260], backgroundColor: '#ef4444', barPercentage: 0.6, categoryPercentage: 0.8 },
                        { label: 'Medium', data: [90, 110, 130, 80, 95, 120], backgroundColor: '#eab308', barPercentage: 0.6, categoryPercentage: 0.8 },
                        { label: 'Large', data: [50, 60, 70, 40, 55, 65], backgroundColor: '#22c55e', barPercentage: 0.6, categoryPercentage: 0.8 }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, font: {size: 11} } } },
                    scales: {
                        y: { grid: { color: '#eee', borderDash: [5, 5] }, ticks: { color: '#aaa', font: {size: 11} }, border: {display: false} },
                        x: { grid: { display: false }, ticks: { color: '#aaa', font: {size: 11} }, border: {display: false} }
                    }
                }
            });
        }

        // REPORTS TAB: Pie Chart (Payment Breakdown)
        const reportPie = document.getElementById('reportPieChart');
        if(reportPie) {
            new Chart(reportPie.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['Annual', 'Monthly'],
                    datasets: [{
                        data: [75, 25],
                        backgroundColor: ['#6366f1', '#f97316'], // Purple/Blue and Red/Orange
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, font: {size: 11} } } }
                }
            });
        }
    }

    // UI Tab Switcher
    function switchTab(tabName) {
        document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
        document.querySelectorAll('.sidebar-menu li').forEach(li => li.classList.remove('active'));
        document.getElementById('section-' + tabName).style.display = 'block';
        document.getElementById('nav-' + tabName).classList.add('active');
    }
    function toggleNotificationPanel(e) { e.stopPropagation(); const p = document.getElementById('notificationPanel'); p.style.display = p.style.display === 'flex' ? 'none' : 'flex'; }
    document.addEventListener('click', e => { const p = document.getElementById('notificationPanel'); if (p.style.display === 'flex' && !p.contains(e.target)) p.style.display = 'none'; });
    function clearNotifications(e) { e.stopPropagation(); document.getElementById('notificationPanel').style.display = 'none'; }
    function logout() { localStorage.removeItem('token'); window.location.href = '/login'; }
</script>
@endsection