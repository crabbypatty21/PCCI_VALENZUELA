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
    position: fixed; top: 0; left: 0; right: 0; height: 60px; background: #ffffff;
    display: flex; align-items: center; justify-content: space-between; padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); z-index: 1050;
}
.topbar-search-wrapper { width: 35%; position: relative; }
.topbar-search-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 13px; }
.topbar-search { width: 100%; padding: 6px 15px 6px 35px; border-radius: 50rem; border: 1px solid #e5e7eb; background: #f9fafb; font-size: 13px; outline: none; }
.topbar-actions { display: flex; align-items: center; gap: 15px; }
.topbar-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid #e5e7eb; cursor: pointer; }

/* =========================================
   2. NOTIFICATION PANEL
   ========================================= */
.notification-panel {
    position: fixed; top: 55px; right: 60px; width: 320px; background: #ffffff; border-radius: 12px;
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
    position: fixed; top: 60px; left: 0; width: 250px; height: calc(100vh - 60px);
    background: #ffffff; border-right: 1px solid #e5e7eb; display: flex; flex-direction: column; z-index: 1000; overflow-y: auto;
}
.sidebar-profile { padding: 20px 15px 15px; text-align: center; border-bottom: 1px solid #f3f4f6; }
.sidebar-profile img { width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 1px solid #e5e7eb; margin-bottom: 10px; }
.sidebar-profile h5 { font-size: 15px; font-weight: bold; margin-bottom: 0; color: #111827; }
.sidebar-profile p { font-size: 13px; font-weight: bold; color: #4b5563; margin-bottom: 0; }
.sidebar-profile small { font-size: 12px; color: #6b7280; }

.sidebar-menu { list-style: none; padding: 15px 10px; margin: 0; flex-grow: 1; }
.sidebar-menu li { padding: 12px 15px; margin-bottom: 4px; cursor: pointer; font-weight: 600; font-size: 14px; color: #4b5563; border-radius: 8px; display: flex; align-items: center; gap: 10px; }
.sidebar-menu li i { font-size: 16px; width: 20px; text-align: center; }
.sidebar-menu li.active { background: #f3f4f6; color: #111827; border-left: 4px solid #b61b2a;}
.sidebar-menu li:hover:not(.active) { background: #f9fafb; }
.sidebar-divider { border-top: 1px solid #e5e7eb; margin: 10px; }

/* =========================================
   4. MAIN CONTENT AREA & COMPONENTS
   ========================================= */
.main { margin-top: 60px; margin-left: 250px; padding: 30px; min-height: calc(100vh - 60px); }
.content-section { display: none; padding-bottom: 40px; }

/* Floating Cards Base */
.floating-card { background: #ffffff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 20px; border: none; }
.custom-card { background: #ffffff; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #f3f4f6; padding: 20px; margin-bottom: 20px;}

/* Summary Cards (Top Row) */
.summary-card { height: 105px; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 20px; color: white; display: flex; flex-direction: column; justify-content: center; position: relative; overflow: hidden; margin-bottom: 20px;}
.summary-card i { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 40px; opacity: 0.2; }
.summary-card .label { font-size: 13px; font-weight: 500; opacity: 0.9; margin-bottom: 5px; }
.summary-card .value { font-size: 26px; font-weight: bold; margin: 0; }

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
.table-card { min-height: 300px; padding: 20px; }
.custom-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.custom-table th { color: #888; font-weight: 600; padding: 12px 10px; border-bottom: 1px solid #eee; text-align: left; }
.custom-table td { padding: 15px 10px; border-bottom: 1px solid #f5f5f5; color: #444; vertical-align: middle; }
.custom-table tbody tr:hover { background-color: #f9fafb; }

/* Action Buttons */
.action-btn { height: 30px; padding: 0 12px; border-radius: 5px; border: none; font-size: 12px; font-weight: bold; cursor: pointer; color: white; display: inline-flex; align-items: center; justify-content: center; gap: 5px; margin-right: 4px;}
.btn-gray { background-color: #6c757d; }
.btn-green { background-color: #28a745; }
.btn-red { background-color: #dc3545; }
.btn-orange { background-color: #fd7e14; }

.badge-yellow { background-color: #ffc107; color: #000; font-size: 12px; padding: 4px 10px; border-radius: 50rem; font-weight: bold; margin-left: 10px; }
.loading, .error-msg { text-align: center; padding: 50px; color: #6b7280; font-size: 1.1rem; font-weight: bold; }

/* =========================================
   5. SETTINGS TAB STYLES
   ========================================= */
.setting-box { background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; padding: 16px 20px; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; cursor: pointer; transition: 0.2s;}
.setting-box:hover { background: #f9fafb; border-color: #d1d5db; }
.setting-left { display: flex; align-items: center; gap: 15px; font-size: 16px; font-weight: bold; color: #333; }
.logout-btn { background: #b00020; color: white; border: none; padding: 12px 30px; border-radius: 50rem; font-weight: bold; font-size: 15px; margin-top: 20px; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; justify-content: center; gap: 8px;}
.logout-btn:hover { background: #8a0019; }
</style>

{{-- TOP NAVIGATION --}}
<div class="topbar">
    <a href="{{ url('/') }}" class="d-flex align-items-center gap-3 text-decoration-none" style="outline: none; box-shadow: none;">
        <div class="rounded-circle overflow-hidden" style="width: 40px; height: 40px; border: 1px solid #e5e7eb;">
            <img src="{{ asset('images/PCCI-Logo.svg') }}" alt="PCCI Logo" class="w-100 h-100 object-fit-contain p-1">
        </div>
        <div class="d-flex flex-column">
            <span class="fw-bold text-dark" style="font-family: 'Poppins', sans-serif; font-size: 1rem; line-height: 1.2;">PCCI - Valenzuela</span>
            <span class="d-none d-sm-block text-muted" style="font-family: 'DM Sans', sans-serif; font-size: 0.7rem;">Philippine Chamber of Commerce and Industry</span>
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
        <li class="active" id="nav-dashboard" onclick="switchTab('dashboard')"><i class="fa fa-chart-pie"></i> Dashboard</li>
        <li id="nav-pending" onclick="switchTab('pending')"><i class="fa fa-users"></i> Members</li>
        <li id="nav-transactions" onclick="switchTab('transactions')"><i class="fa fa-money-bill-wave"></i> Transactions</li>
        <li id="nav-reports" onclick="switchTab('reports')"><i class="fa fa-chart-line"></i> Reports</li>
        <div class="sidebar-divider"></div>
        <li id="nav-settings" onclick="switchTab('settings')"><i class="fa fa-cog"></i> Settings</li>
       
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
                <div class="summary-card bg-red">
                    <div class="label">Total Revenue</div>
                    <div class="value">PHP 205,500</div>
                    <i class="fa fa-wallet"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card bg-green">
                    <div class="label">Paid Members</div>
                    <div class="value">Php. 205,500</div>
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card bg-orange">
                    <div class="label">Active Account</div>
                    <div class="value">20</div>
                    <i class="fa fa-user-check"></i>
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

        {{-- BOTTOM SECTION: TABLE --}}
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
                    <tbody>
                        <tr>
                            <td style="font-weight: bold; color: #222;">Juan Dela Cruz</td>
                            <td>Annual</td>
                            <td style="font-weight: bold;">5,000</td>
                            <td>OR-98231</td>
                            <td>Mar 19, 2026</td>
                            <td><a href="#" class="text-primary text-decoration-none" style="font-size: 12px;"><i class="fa fa-image"></i> View File</a></td>
                            <td>
                                <button class="action-btn btn-gray">View</button>
                                <button class="action-btn btn-green">Verify</button>
                                <button class="action-btn btn-red">Reject</button>
                                <button class="action-btn btn-orange"><i class="fa fa-print"></i> Receipt</button>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; color: #222;">Maria Santos</td>
                            <td>Monthly</td>
                            <td style="font-weight: bold;">500</td>
                            <td>OR-98232</td>
                            <td>Mar 19, 2026</td>
                            <td><a href="#" class="text-primary text-decoration-none" style="font-size: 12px;"><i class="fa fa-image"></i> View File</a></td>
                            <td>
                                <button class="action-btn btn-gray">View</button>
                                <button class="action-btn btn-green">Verify</button>
                                <button class="action-btn btn-red">Reject</button>
                                <button class="action-btn btn-orange"><i class="fa fa-print"></i> Receipt</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- PENDING PAYMENTS TAB (Original Logic) --}}
    <div id="section-pending" class="content-section" style="display: none;">
        <div class="mb-4 pb-3 border-bottom">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Approved Applicants</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Review and process payments for businesses approved by the Admin.</p>
        </div>

        <div id="applicants-list">
            <div class="loading"><i class="fa fa-spinner fa-spin fs-2 text-danger mb-3"></i><br>Loading approved applicants...</div>
        </div>
    </div>

    {{-- TRANSACTIONS & REPORTS PLACEHOLDERS --}}
    <div id="section-transactions" class="content-section" style="display: none;">
        <div class="mb-4 pb-3 border-bottom">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Transactions</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">View and manage all financial transactions.</p>
        </div>
        <div class="custom-card text-center py-5 text-muted">
            <i class="fa fa-money-bill-wave fs-1 mb-3 text-secondary"></i>
            <h5>Transactions data will go here.</h5>
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

    {{-- ============================================== --}}
    {{-- NEW FEATURE: SETTINGS TAB (Member-style)       --}}
    {{-- ============================================== --}}
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

{{-- JAVASCRIPT LOGIC --}}
<script>
    const token = localStorage.getItem('token');

    document.addEventListener('DOMContentLoaded', () => {
        if (!token) {
            window.location.href = '/login';
            return;
        }

        // Set User Info
        const userName = localStorage.getItem('userName') || 'Jesus Versula';
        document.getElementById('sidebarName').innerText = userName;
        document.getElementById('dashWelcomeName').innerText = userName;

        // Fetch Data for pending tab
        fetchApplicants();

        // Init Charts
        initCharts();
    });

    // --- CHART.JS INITIALIZATION ---
    function initCharts() {
        // 1. Bar Chart (Membership Revenue)
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['2021', '2022', '2023', '2024'],
                datasets: [{
                    label: 'Revenue',
                    data: [120000, 150000, 180000, 205500],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)', // Blue
                        'rgba(255, 206, 86, 0.8)', // Yellow
                        'rgba(75, 192, 192, 0.8)', // Teal
                        'rgba(220, 53, 69, 0.8)'   // Red
                    ],
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

        // 2. Pie Chart (Payment Breakdown)
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
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

    // --- UI LOGIC ---
    function switchTab(tabName) {
        document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
        document.querySelectorAll('.sidebar-menu li').forEach(li => li.classList.remove('active'));
        
        document.getElementById('section-' + tabName).style.display = 'block';
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

    // --- TREASURER API LOGIC (FOR PENDING TAB) ---
    async function fetchApplicants() {
        const container = document.getElementById('applicants-list');
        try {
            const baseUrl = window.API_BASE_URL || 'https://pcci-laravel-api.onrender.com/api';
            const response = await fetch(`${baseUrl}/v1/applicants?status=approved`, {
                headers: { 'Authorization': `Bearer ${token}` }
            });

            if (response.status === 401) { logout(); return; }
            const data = await response.json();

            if (response.ok && data.data) {
                renderApplicants(data.data);
            } else {
                container.innerHTML = '<div class="error-msg">Failed to load applicants.</div>';
            }
        } catch (err) {
            console.error(err);
            container.innerHTML = '<div class="error-msg text-danger"><i class="fa fa-exclamation-triangle fs-2 mb-3"></i><br>Network error. Could not connect to API.</div>';
        }
    }

    function renderApplicants(applicants) {
        const container = document.getElementById('applicants-list');
        container.innerHTML = '';

        if (applicants.length === 0) {
            container.innerHTML = `
                <div class="custom-card text-center py-5 text-muted">
                    <i class="fa fa-check-circle fs-1 mb-3 text-success"></i>
                    <h5 class="fw-bold">All caught up!</h5>
                    <p>There are no approved applicants pending payment at this time.</p>
                </div>`;
            return;
        }

        applicants.forEach(app => {
            const safe = (val) => val || 'N/A'; 
            const profile = app.basic_profile || {};
            const memTypeId = app.membership_type_id || 1; 

            const html = `
                <div class="custom-card mb-4" style="border-left: 5px solid #28a745;">
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark" style="font-family: 'Poppins', sans-serif;">${safe(profile.registered_business_name)}</h5>
                            <small class="text-muted">Applicant ID: ${app.id} | Type: <strong class="text-danger">${safe(app.membership_type)}</strong></small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold border border-success border-opacity-25">
                            <i class="fa fa-check-circle me-1"></i> APPROVED
                        </span>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><small class="text-muted">Trade Name:</small><br><span class="fw-bold text-dark">${safe(profile.trade_name)}</span></p>
                            <p class="mb-1"><small class="text-muted">Email Contact:</small><br><span class="fw-bold text-dark">${safe(profile.email)}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><small class="text-muted">Approval Date:</small><br><span class="fw-bold text-dark">${safe(app.date_approved)}</span></p>
                            <p class="mb-1"><small class="text-muted">Payment Status:</small><br><span class="fw-bold text-warning">Pending Payment</span></p>
                        </div>
                    </div>
                    
                    <div class="text-end border-top pt-3 mt-2">
                        <button onclick="processPayment(${app.id}, ${memTypeId})" class="btn btn-success fw-bold rounded-pill px-4 shadow-sm" style="font-size: 14px;">
                            <i class="fa fa-cash-register me-2"></i> Process Payment
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });
    }

    async function processPayment(applicantId, membershipTypeId) {
        if (!confirm('Are you sure you want to process the payment for this applicant? This will generate an Official Receipt.')) return;

        try {
            const baseUrl = window.API_BASE_URL || 'https://pcci-laravel-api.onrender.com/api';
            const response = await fetch(`${baseUrl}/v1/payments`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    applicant_id: applicantId,
                    membership_type_id: membershipTypeId
                })
            });

            const data = await response.json();

            if (response.ok && data.data) {
                alert(`SUCCESS: Payment Processed!\n\nOR Number: ${data.data.or_number}\nAmount: ₱${data.data.amount}\nReceived By: ${data.data.received_by.name}`);
                fetchApplicants(); 
            } else {
                alert(`Failed to process payment: ${data.message || 'Please check your inputs and try again.'}`);
            }
        } catch (err) {
            console.error(err);
            alert('A network error occurred. Please check your connection to the API.');
        }
    }
</script>
@endsection