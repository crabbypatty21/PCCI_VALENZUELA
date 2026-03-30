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
html, body { margin: 0; padding: 0; background: #f3f4f6; font-family: 'Inter', 'Poppins', sans-serif; overflow-x: hidden; transition: background-color 0.3s, color 0.3s;}
main { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }

/* =========================================
   1. TOP NAVIGATION BAR (FIXED)
   ========================================= */
.topbar {
    position: fixed; top: 0; left: 0; right: 0; height: 70px; background: #ffffff;
    display: flex; align-items: center; justify-content: space-between; padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); z-index: 1050; transition: background-color 0.3s;
}
.topbar-search-wrapper { width: 300px; position: relative; }
.topbar-search-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 13px; }
.topbar-search { width: 100%; height: 36px; padding: 6px 15px 6px 35px; border-radius: 8px; border: 1px solid #eee; background: #eee; font-size: 13px; outline: none; transition: 0.3s;}
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
    background: #f8f9fb; border-right: 1px solid #e5e7eb; display: flex; flex-direction: column; z-index: 1000; overflow-y: auto; transition: background-color 0.3s;
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
.main { margin-top: 70px; margin-left: 250px; padding: 25px; min-height: calc(100vh - 70px); background: #f4f6f9; transition: background-color 0.3s;}
.content-section { display: none; padding-bottom: 40px; }

/* Drill-down UI Animations */
.fade-in { animation: fadeIn 0.3s ease-in-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

/* Floating Cards Base */
.floating-card { background: #ffffff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 16px; border: none; transition: 0.3s; }
.custom-card { background: #ffffff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px; transition: 0.3s;}

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

/* Small Info Card */
.small-info-card { width: 280px; height: 75px; display: flex; align-items: center; gap: 15px; }
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
.custom-table th { background: #f8f9fb; color: #777; font-weight: 600; padding: 12px 10px; text-align: left; position: sticky; top: 0; z-index: 1;}
.custom-table td { padding: 12px 10px; border-bottom: 1px solid #eee; color: #444; vertical-align: middle; height: 45px;}
.custom-table tbody tr:hover { background-color: #f9fafb; }

/* Action Buttons & Badges */
.action-btn { height: 30px; padding: 0 10px; border-radius: 6px; border: none; font-size: 12px; font-weight: bold; cursor: pointer; color: white; display: inline-flex; align-items: center; justify-content: center; gap: 5px; margin-right: 4px;}
.btn-gray { background-color: #9ca3af; width: 85px; }
.btn-green { background-color: #22c55e; width: auto; padding: 0 12px;} 
.btn-red { background-color: #ef4444; width: 75px; } 

.action-icon-btn { width: 32px; height: 32px; padding: 0; border-radius: 6px; transition: 0.2s; display: inline-flex; justify-content: center; align-items: center; font-size: 14px;}
.action-icon-btn:hover { background-color: #e5e7eb; }

/* Status Badges */
.status-badge { display: inline-block; padding: 4px 0; border-radius: 50rem; font-size: 12px; color: white; text-align: center; width: 100px; font-weight: 500; }
.status-completed { background-color: #22c55e; }
.status-pending { background-color: #f59e0b; }
.status-failed { background-color: #ef4444; }

/* =========================================
   REPORTS TAB SPECIFIC STYLES & DROPDOWN
   ========================================= */
.reports-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
.report-stat-card { background: #ffffff; border-radius: 12px; padding: 16px; height: 120px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: center; gap: 6px; transition: 0.3s; }
.report-stat-card .report-label { font-size: 12px; color: #777; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;}
.report-stat-card .report-value { font-size: 24px; font-weight: 600; color: #111; margin: 0; line-height: 1;}
.report-stat-card .report-indicator { font-size: 11px; font-weight: 600; }
.text-green { color: #22c55e !important; }
.text-red { color: #ef4444 !important; }
.report-chart-box { background: #ffffff; border-radius: 12px; padding: 16px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); height: 300px; display: flex; flex-direction: column; transition: 0.3s; }
.mini-card-container { display: flex; gap: 16px; align-items: center; justify-content: center; height: 100%; }
.mini-stat-card { background: #f8f9fb; border-radius: 12px; width: 150px; height: 90px; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 1px solid #eee; transition: 0.3s; }
.mini-stat-card .m-val { font-size: 20px; font-weight: 600; color: #111; line-height: 1.2;}
.mini-stat-card .m-lbl { font-size: 12px; color: #777; }
.report-flat-table { width: 100%; border-collapse: collapse; }
.report-flat-table td { padding: 12px 0; border-bottom: 1px solid #eee; font-size: 13px; color: #111; font-weight: 500;}
.report-flat-table tr:last-child td { border-bottom: none; }

.report-dropdown-menu { position: absolute; right: 0; top: 100%; margin-top: 8px; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 220px; padding: 8px; display: none; flex-direction: column; z-index: 1050; border: 1px solid #e5e7eb; animation: fadeIn 0.2s ease-in-out;}
.report-dropdown-item { padding: 10px 15px; border-radius: 8px; cursor: pointer; font-size: 13px; font-weight: 600; color: #4b5563; display: flex; align-items: center; gap: 12px; transition: 0.2s;}
.report-dropdown-item:hover { background: #f3f4f6; color: #111; }
.report-dropdown-item i { font-size: 16px; text-align: center; width: 20px; }
.trans-filter-divider { height: 1px; background: #eee; margin: 4px 0; border: none; }

/* =========================================
   MODAL STYLES (GENERAL)
   ========================================= */
.custom-modal-overlay { position: fixed; top: 0; left: 250px; width: calc(100% - 250px); height: 100%; background: rgba(0, 0, 0, 0.7); display: none; justify-content: center; align-items: center; z-index: 1060; backdrop-filter: blur(3px); }
.custom-modal-card { background: #ffffff; width: 90%; max-width: 700px; border-radius: 16px; padding: 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.4); position: relative; animation: slideIn 0.3s ease-out; }
@keyframes slideIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
.modal-close-x { position: absolute; top: 15px; right: 20px; font-size: 28px; color: #888; cursor: pointer; border: none; background: none; line-height: 1; }
.modal-img-wrapper { width: 100%; min-height: 120px; display: flex; justify-content: center; align-items: center; position: relative; }
.modal-img-wrapper img { max-width: 100%; max-height: 400px; width: auto; height: auto; border-radius: 8px; border: 1px solid #ddd; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: block; }

.type-toggle-btn { padding: 12px; border-radius: 10px; border: 2px solid #e5e7eb; background: #f9fafb; color: #4b5563; font-weight: bold; cursor: pointer; transition: 0.2s; text-align: center; }
.type-toggle-btn:hover { border-color: #d1d5db; background: #f3f4f6; }
.type-toggle-btn.active-1 { background: #fff1f2; color: #ef4444; border-color: #ef4444; }
.type-toggle-btn.active-2 { background: #eff6ff; color: #3b82f6; border-color: #3b82f6; }

/* Settings Buttons */
.setting-box { transition: 0.2s; background: #ffffff; cursor: pointer; border: 1px solid #eee; border-radius: 12px;}
.setting-box:hover { background-color: #f9fafb; border-color: #d1d5db !important; }
.back-btn-ui { cursor: pointer; font-size: 14px; font-weight: bold; color: #4b5563; transition: 0.2s; display: inline-flex; align-items: center; padding: 5px 10px; border-radius: 6px; margin-left: -10px; box-shadow: none; border: none; background: transparent; outline: none; }
.back-btn-ui:hover { background: #e5e7eb; color: #111; }

.acc-header-out { display: flex; align-items: center; gap: 15px; margin: 0 auto 20px auto; max-width: 1000px; }
.acc-header-icon { font-size: 36px; color: #111; }

/* WIDER SETTINGS FLOATING CARD */
.new-acc-card { background: #fff; border-radius: 12px; padding: 35px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 1000px; margin: 0 auto; transition: 0.3s; }
.new-acc-avatar { width: 85px; height: 85px; border-radius: 50%; border: 3px solid #ef4444; object-fit: cover; }
.new-acc-btn-upload { background: #fff; border: 1px solid #ddd; color: #333; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
.new-acc-btn-upload:hover { background: #f9fafb; }
.new-acc-btn-delete { background: #b0b0b0; border: none; color: #fff; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: 0.2s; }
.new-acc-btn-delete:hover { background: #999; }
.new-acc-input { background: #f8f9fb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 8px 12px; padding-right: 65px; font-size: 14px; width: 100%; color: #111; outline: none; transition: 0.2s; height: 42px; }
.new-acc-edit { position: absolute; right: 6px; top: 50%; transform: translateY(-50%); background: #fff; border: 1px solid #ef4444; color: #ef4444; font-size: 11px; padding: 3px 8px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px; transition: 0.2s; cursor: pointer; }
.new-acc-edit:hover { background: #ef4444; color: #fff; }
.new-acc-action-gray { background: #9ca3af; color: #fff; border: none; padding: 10px 16px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: 0.2s; }
.new-acc-action-gray:hover { background: #6b7280; }
.new-acc-action-dark { background: #8b8b8b; color: #fff; border: none; padding: 10px 16px; border-radius: 6px; font-size: 13px; font-weight: 500; transition: 0.2s; }
.new-acc-action-dark:hover { background: #666; }

/* Security Settings Elements */
.sec-change-pw-box { background: #f8f9fb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 15px 25px; margin-bottom: 25px; transition: 0.3s; }
.sec-btn-update { background: #9ca3af; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 500; transition: 0.2s; cursor: pointer;}
.sec-btn-update:hover { background: #6b7280; }
.sec-login-box { background: #f8f9fb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; min-height: 250px; transition: 0.3s;}
.sec-login-title { font-size: 16px; font-weight: 600; margin-bottom: 10px; }
.sec-divider { height: 1px; background: #ddd; margin-bottom: 15px; border: none; }
.sec-table { width: 100%; border-collapse: collapse; }
.sec-table th { text-align: left; padding: 12px 10px; font-weight: 500; border-bottom: 1px solid #ddd; }
.sec-table td { padding: 12px 10px; color: #666; font-size: 13px; }

/* =========================================
   ADD PAYMENT MODAL STYLES (NEW)
   ========================================= */
.add-payment-modal-card { background: #ffffff; max-width: 450px !important; padding: 25px; border-radius: 12px; color: #111; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
.add-payment-modal-header { display: flex; align-items: center; justify-content: flex-start; margin-bottom: 25px; position: relative; }
.add-payment-modal-icon-container { position: relative; font-size: 32px; color: #111; margin-right: 15px; }
.add-payment-modal-check-icon { position: absolute; bottom: -2px; right: -6px; font-size: 12px; color: #fff; background: #111; border: 2px solid #fff; border-radius: 50%; width: 18px; height: 18px; display: flex; justify-content: center; align-items: center; }
.add-payment-modal-title { font-size: 18px; font-weight: bold; color: #111; margin: 0; }
.add-payment-modal-body { display: flex; flex-direction: column; gap: 15px; }
.add-payment-form-group { display: flex; flex-direction: column; gap: 5px; text-align: left; }
.add-payment-label { font-size: 13px; color: #666; margin: 0; font-weight: normal; }
.add-payment-input { width: 100%; height: 40px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 0 12px; font-size: 14px; color: #111; outline: none; transition: 0.2s; }
.add-payment-input:focus { border-color: #b61b2a; }
.add-payment-input[readonly] { background-color: #f3f4f6; color: #888; cursor: not-allowed; }
.add-payment-modal-footer { display: flex; justify-content: space-between; gap: 12px; margin-top: 30px; }
.add-payment-btn-clear { flex: 1; height: 42px; background: #e5e7eb; color: #4b5563; font-weight: bold; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; transition: 0.2s; }
.add-payment-btn-clear:hover { background: #d1d5db; }
.add-payment-btn-confirm { flex: 1; height: 42px; background: #b61b2a; color: #fff; font-weight: bold; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; transition: 0.2s; }
.add-payment-btn-confirm:hover { background: #9b1724; }

/* =========================================
   OTP & RESET PASSWORD MODAL STYLES
   ========================================= */
.otp-modal-card { background: #ffffff; max-width: 450px !important; padding: 30px; border-radius: 12px; border: none; color: #111; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
.otp-title { font-size: 20px; font-weight: bold; margin-bottom: 10px; color: #111; }
.otp-subtitle { font-size: 14px; color: #666; margin-bottom: 25px; line-height: 1.5; }
.otp-subtitle span { color: #111; font-weight: bold; }
.otp-input-container { display: flex; gap: 10px; justify-content: flex-start; }
.otp-box { width: 55px; height: 55px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 24px; text-align: center; color: #111; outline: none; transition: 0.2s; }
.otp-box:focus { background: #fff; border-color: #b61b2a; box-shadow: 0 0 0 2px rgba(182, 27, 42, 0.1); }

.reset-pw-modal-card { background: #ffffff; max-width: 450px !important; padding: 30px; border-radius: 12px; border: none; color: #111; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
.reset-pw-title { font-size: 20px; font-weight: bold; margin-bottom: 5px; color: #111; }
.reset-pw-subtitle { font-size: 14px; color: #666; margin-bottom: 25px; }
.reset-pw-label { font-size: 14px; font-weight: bold; color: #111; margin-bottom: 8px; display: block; text-align: left;}
.reset-pw-input-wrap { position: relative; margin-bottom: 15px; }
.reset-pw-input { width: 100%; height: 42px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 0 40px; font-size: 14px; color: #111; outline: none; transition: 0.2s; }
.reset-pw-input:focus { border-color: #b61b2a; }
.reset-pw-icon-left { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #888; font-size: 14px; }
.reset-pw-icon-right { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: #888; font-size: 14px; cursor: pointer; transition: 0.2s; }
.reset-pw-icon-right:hover { color: #111; }
.reset-pw-checklist { list-style: none; padding: 0; margin: -5px 0 20px 10px; font-size: 12px; color: #aaa; text-align: left; }
.reset-pw-checklist li { display: flex; align-items: center; gap: 8px; margin-bottom: 5px; transition: color 0.3s; }
.reset-pw-checklist li.valid { color: #22c55e; } 
.reset-pw-checklist li i { font-size: 14px; }
.reset-pw-actions { display: flex; justify-content: space-between; gap: 15px; margin-top: 25px; }
.reset-pw-btn-cancel { flex: 1; background: #fff; border: 1px solid #e5e7eb; color: #111; border-radius: 8px; height: 42px; font-weight: bold; font-size: 14px; cursor: pointer; transition: 0.2s; }
.reset-pw-btn-cancel:hover { background: #f9fafb; }
.reset-pw-btn-submit { flex: 1; background: #d1d5db; color: #fff; border: none; border-radius: 8px; height: 42px; font-weight: bold; font-size: 14px; cursor: not-allowed; transition: 0.2s;}
.reset-pw-btn-submit.active { background: #b61b2a; cursor: pointer; }
.reset-pw-btn-submit.active:hover { background: #9b1724; }

/* =========================================
   DARK MODE CSS OVERRIDES
   ========================================= */
body.dark-mode, body.dark-mode .main { background-color: #121212 !important; color: #e0e0e0 !important; }
body.dark-mode .topbar, body.dark-mode .sidebar, body.dark-mode .floating-card, body.dark-mode .custom-card, body.dark-mode .report-stat-card, body.dark-mode .report-chart-box, body.dark-mode .custom-modal-card:not(.otp-modal-card):not(.reset-pw-modal-card):not(.add-payment-modal-card), body.dark-mode .notification-panel, body.dark-mode .setting-box, body.dark-mode .mini-stat-card, body.dark-mode .new-acc-card { background-color: #1e1e1e !important; border-color: #333 !important; box-shadow: none !important; }
body.dark-mode h3, body.dark-mode h4, body.dark-mode h5, body.dark-mode h6, body.dark-mode p, body.dark-mode .label, body.dark-mode .value, body.dark-mode td, body.dark-mode th, body.dark-mode .report-value, body.dark-mode .text-dark, body.dark-mode .sidebar-profile h5, body.dark-mode .m-val, body.dark-mode .acc-header-icon { color: #f8f9fa !important; }
body.dark-mode .text-muted, body.dark-mode .report-label, body.dark-mode small, body.dark-mode .sidebar-profile small, body.dark-mode .m-lbl { color: #9ca3af !important; }
body.dark-mode .custom-table th, body.dark-mode .sidebar-menu li.active { background-color: #2d2d2d !important; color: #f8f9fa !important; }
body.dark-mode .custom-table tbody tr:hover, body.dark-mode .sidebar-menu li:hover:not(.active), body.dark-mode .setting-box:hover { background-color: #2d2d2d !important; }
body.dark-mode .topbar-search, body.dark-mode input:not(.add-payment-input):not(.new-acc-input):not(.otp-box):not(.reset-pw-input), body.dark-mode select:not(.add-payment-input), body.dark-mode .form-control { background-color: #2d2d2d !important; color: #f8f9fa !important; border-color: #444 !important; }
body.dark-mode .sidebar-menu li i { color: #9ca3af; }
body.dark-mode .sidebar-menu li.active i { color: #f8f9fa; }
body.dark-mode .report-indicator.text-green { color: #4ade80 !important; }
body.dark-mode .report-indicator.text-red { color: #f87171 !important; }
body.dark-mode .report-flat-table td { border-bottom-color: #333 !important; }
body.dark-mode .summary-card .label, body.dark-mode .summary-card .value { color: #ffffff !important; }
body.dark-mode #darkModeBtn { background: #2d2d2d !important; color: #f8f9fa !important; border-color: #444 !important; }
body.dark-mode .type-toggle-btn { background: #2d2d2d; border-color: #444; color: #e0e0e0; }
body.dark-mode .type-toggle-btn.active-1 { background: rgba(239, 68, 68, 0.2); border-color: #ef4444; color: #fca5a5; }
body.dark-mode .type-toggle-btn.active-2 { background: rgba(59, 130, 246, 0.2); border-color: #3b82f6; color: #93c5fd; }
body.dark-mode .back-btn { color: #e0e0e0; }
body.dark-mode .back-btn:hover { background: #333; color: #fff; }
body.dark-mode .back-btn-ui { color: #e0e0e0; }
body.dark-mode .back-btn-ui:hover { background: #333; color: #fff; }
body.dark-mode .btn-light { background-color: #2d2d2d !important; color: #e0e0e0 !important; border-color: #444 !important; } 
body.dark-mode .action-icon-btn:hover { background-color: #333 !important; }
body.dark-mode .report-dropdown-menu { background: #1e1e1e; border-color: #333; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
body.dark-mode .report-dropdown-item { color: #e0e0e0; }
body.dark-mode .report-dropdown-item:hover { background: #2d2d2d; color: #fff; }
body.dark-mode .trans-filter-divider { background: #333; }

/* Dark mode for the Account UI */
body.dark-mode .new-acc-input { background: #2d2d2d; border-color: #444; color: #fff; }
body.dark-mode .new-acc-btn-upload { background: #2d2d2d; border-color: #444; color: #fff; }
body.dark-mode .new-acc-btn-upload:hover { background: #333; }
body.dark-mode .new-acc-btn-delete { background: #444; color: #ccc; }
body.dark-mode .new-acc-edit { background: #1e1e1e; border-color: #ef4444; color: #ef4444; }
body.dark-mode .new-acc-edit:hover { background: #ef4444; color: #fff; }
body.dark-mode hr.border-secondary { border-color: #444 !important; opacity: 1;}

/* Dark Mode for Security Card */
body.dark-mode .sec-change-pw-box { background: #2d2d2d; border-color: #333; }
body.dark-mode .sec-change-pw-box i { color: #e0e0e0 !important; }
body.dark-mode .sec-change-pw-box span { color: #fff !important; }
body.dark-mode .sec-btn-update { background: #4b5563; color: #e0e0e0; }
body.dark-mode .sec-btn-update:hover { background: #374151; }
body.dark-mode .sec-login-box { background: #2d2d2d; border-color: #333; }
body.dark-mode .sec-login-title { color: #fff !important; }
body.dark-mode .sec-divider { background: #444; }
body.dark-mode .sec-table th { color: #e0e0e0 !important; border-bottom-color: #444; }
body.dark-mode .sec-table td { color: #aaa; }

/* Dark Mode Overrides for Modals */
body.dark-mode .add-payment-modal-card { background: #1e1e1e; color: #fff; border-color: #333; }
body.dark-mode .add-payment-modal-icon-container { color: #fff; }
body.dark-mode .add-payment-modal-check-icon { background: #4ade80; border-color: #1e1e1e; color: #1e1e1e; }
body.dark-mode .add-payment-modal-title { color: #fff; }
body.dark-mode .add-payment-label { color: #aaa; }
body.dark-mode .add-payment-input { background: #2d2d2d; border-color: #444; color: #fff; }
body.dark-mode .add-payment-input[readonly] { background: #1a1a1a; border-color: #333; color: #777; }
body.dark-mode .add-payment-btn-clear { background: #333; color: #ccc; border: none; }
body.dark-mode .add-payment-btn-clear:hover { background: #444; }

body.dark-mode .otp-modal-card { background: #1c1c1c; color: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
body.dark-mode .otp-title { color: #fff; }
body.dark-mode .otp-subtitle { color: #aaa; }
body.dark-mode .otp-subtitle span { color: #fff; }
body.dark-mode .otp-box { background: #2d2d2d; border-color: #444; color: #fff; }
body.dark-mode .otp-box:focus { background: #333; border-color: #ef4444; box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2); }

body.dark-mode .reset-pw-modal-card { background: #1c1c1c; color: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
body.dark-mode .reset-pw-title { color: #fff; }
body.dark-mode .reset-pw-subtitle { color: #aaa; }
body.dark-mode .reset-pw-label { color: #fff; }
body.dark-mode .reset-pw-input { background: #2d2d2d; border-color: #444; color: #fff; }
body.dark-mode .reset-pw-input:focus { border-color: #ef4444; }
body.dark-mode .reset-pw-btn-cancel { background: #2d2d2d; border-color: #444; color: #fff; }
body.dark-mode .reset-pw-btn-submit { background: #444; color: #888; }
body.dark-mode .reset-pw-btn-submit.active { background: #ef4444; color: #fff; }
body.dark-mode .reset-pw-checklist { color: #666; }

/* =========================================
   CROP PROFILE PICTURE MODAL
   ========================================= */
.crop-modal-card {
    background: #1a1a1a !important; 
    border: 1px solid #b61b2a !important; 
    max-width: 420px !important;
    padding: 0 !important; 
    border-radius: 12px;
    color: #fff;
    box-shadow: 0 10px 30px rgba(0,0,0,0.8);
    overflow: hidden;
}
.crop-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #333;
}
.crop-title {
    font-size: 11px;
    font-weight: bold;
    letter-spacing: 1px;
    margin: 0;
    color: #fff;
    text-transform: uppercase;
}
.crop-close-btn {
    background: #2d2d2d;
    border: 1px solid #b61b2a;
    color: #555;
    border-radius: 6px;
    width: 28px;
    height: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    font-size: 14px;
    transition: 0.2s;
}
.crop-close-btn:hover {
    background: #b61b2a;
    color: #fff;
}
.crop-body {
    padding: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.crop-image-container {
    position: relative;
    width: 320px;
    height: 320px;
    background: #333;
    border-radius: 4px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}
.crop-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.85;
}
.crop-overlay-circle {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 260px;
    height: 260px;
    border: 3px dotted #ffffff;
    border-radius: 50%;
    box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.4); /* Dims the outside of the circle */
    pointer-events: none; 
}
.crop-footer {
    padding: 0 25px 25px 25px;
}
.crop-btn-submit {
    width: 100%;
    background: #b61b2a;
    color: #fff;
    border: none;
    border-radius: 8px;
    height: 42px;
    font-weight: bold;
    font-size: 11px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.2s;
}
.crop-btn-submit:hover {
    background: #9b1724;
}

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
        <button class="btn btn-sm border d-flex align-items-center gap-2 text-muted fw-bold px-3 py-1" onclick="toggleDarkMode()" id="darkModeBtn" style="border-radius: 50rem; background: #f9fafb; font-size: 13px;">
            <i class="fa fa-moon" id="darkModeIcon"></i> <span id="darkModeText">Dark Mode</span>
        </button>

        <div class="position-relative" onclick="toggleNotificationPanel(event)" style="cursor:pointer; display: flex; align-items: center; margin-left: 10px;">
            <i class="fa fa-bell fs-5 text-muted"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 4px; margin-left: -5px; display: none;"></span>
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
                <p>Loading notifications...</p>
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
        <div class="row g-4 mb-4">
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
        <div class="floating-card small-info-card mb-4">
            <div class="icon-box"><i class="fa fa-calendar-check"></i></div>
            <div>
                <p>Today's Payments: <span id="today-payments-amt" class="text-success fs-6">₱0</span></p>
                <p>Yesterday payment: <span id="yesterday-payments-amt" class="text-muted fw-bold">₱0</span></p>
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
        <div class="floating-card table-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #111;">Recent Payments</h5>
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
                        </tr>
                    </thead>
                    <tbody id="recent-payments-table-body">
                        <tr><td colspan="6" class="text-center py-4">Loading records...</td></tr>
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
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
                <div class="d-flex align-items-center gap-2">
                    <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #111;">Members Directory</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill" id="total-members-badge">0 Active</span>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <select id="memberSort" class="form-select form-select-sm text-muted fw-bold" style="height: 36px; border-radius: 6px; border-color: #eee; font-size: 13px; box-shadow: none; cursor:pointer; width: 140px; background-color: #f8f9fb;">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="name_asc">Name (A-Z)</option>
                        <option value="name_desc">Name (Z-A)</option>
                    </select>
                    
                    <div style="position: relative; width: 250px;">
                        <i class="fa fa-search text-muted" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 13px;"></i>
                        <input type="text" id="memberSearch" placeholder="Search members..." style="width: 100%; height: 36px; padding-left: 35px; border-radius: 6px; border: 1px solid #eee; font-size: 13px; outline: none; background: #f8f9fb;">
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
        <div class="mb-4">
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Applicants Queue</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Review and process payments for newly approved businesses.</p>
        </div>

        <div class="floating-card table-card">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
                <div class="d-flex align-items-center gap-2">
                    <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #111;">Applicants Directory</h5>
                    <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill" id="report-pending-count-badge">0 Pending</span>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <select id="applicantSort" class="form-select form-select-sm text-muted fw-bold" style="height: 36px; border-radius: 6px; border-color: #eee; font-size: 13px; box-shadow: none; cursor:pointer; width: 140px; background-color: #f8f9fb;">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="name_asc">Name (A-Z)</option>
                        <option value="name_desc">Name (Z-A)</option>
                    </select>
                    
                    <div style="position: relative; width: 250px;">
                        <i class="fa fa-search text-muted" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 13px;"></i>
                        <input type="text" id="applicantSearch" placeholder="Search applicants..." style="width: 100%; height: 36px; padding-left: 35px; border-radius: 6px; border: 1px solid #eee; font-size: 13px; outline: none; background: #f8f9fb;">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Business Name</th>
                            <th>Trade Name</th>
                            <th>Email</th>
                            <th>Date Submitted</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="applicants-table-body">
                        <tr><td colspan="8" class="text-center py-5 text-muted"><i class="fa fa-spinner fa-spin fs-3 mb-2"></i><br>Loading applicants...</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-3" style="height: 50px; gap: 15px;">
                <button class="btn btn-sm btn-light border rounded" onclick="prevApplicantPage()"><i class="fa fa-chevron-left"></i></button>
                <span style="font-size: 14px; font-weight: bold; color: #4b5563;" id="applicant-pagination-text">Page 1 of 1</span>
                <button class="btn btn-sm btn-light border rounded" onclick="nextApplicantPage()"><i class="fa fa-chevron-right"></i></button>
            </div>
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
            
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <div>
                    <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #111;">Transaction Records</h5>
                </div>
                <div class="d-flex align-items-center gap-3">
                    
                    <div class="position-relative" id="transFilterContainer" style="width: 280px;">
                        <i class="fa fa-search text-muted" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 13px;"></i>
                        
                        <input type="text" id="transactionSearch" placeholder="Search transactions..." style="width: 100%; height: 38px; padding-left: 35px; padding-right: 40px; border-radius: 8px; border: 1px solid #eee; font-size: 13px; outline: none; background: #f8f9fb;">
                        
                        <button class="btn btn-sm p-0 d-flex justify-content-center align-items-center text-muted" onclick="toggleTransFilter(event)" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 28px; height: 28px; border-radius: 6px;">
                            <i class="fa fa-sliders-h"></i>
                        </button>

                        <div class="report-dropdown-menu" id="transFilterMenu" style="width: 180px; right: 0; top: 100%; margin-top: 5px;">
                            <div class="report-dropdown-item text-dark" onclick="filterTransactions('all')">All Transactions</div>
                            <hr class="trans-filter-divider">
                            <div class="report-dropdown-item text-success" onclick="filterTransactions('completed')"><i class="fa fa-check-circle w-20px"></i> Completed</div>
                            <div class="report-dropdown-item text-warning" onclick="filterTransactions('pending')"><i class="fa fa-clock w-20px"></i> Pending</div>
                            <div class="report-dropdown-item text-danger" onclick="filterTransactions('failed')"><i class="fa fa-times-circle w-20px"></i> Failed</div>
                        </div>
                    </div>
                    
                    <button class="btn btn-danger fw-bold shadow-sm d-flex align-items-center gap-2" style="height: 38px; border-radius: 8px; background: #dc2626; border: none; font-size: 13px; padding: 0 16px;" onclick="openAddPaymentModal()">
                        <i class="fa fa-plus"></i> Add Payment
                    </button>
                    
                    <div class="position-relative" id="transMenuContainer">
                        <button class="btn btn-light border shadow-sm d-flex justify-content-center align-items-center" onclick="toggleTransDropdown(event)" style="height: 38px; width: 38px; border-radius: 8px;">
                            <i class="fa fa-ellipsis-v text-muted"></i>
                        </button>
                        <div class="report-dropdown-menu" id="transDropdownMenu" style="width: 160px;">
                            <div class="report-dropdown-item" onclick="exportTransactions()">
                                <i class="fa fa-file-export text-success w-20px"></i> Export
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Member Name</th>
                            <th>Payment Type</th>
                            <th>Date</th>
                            <th>Membership Type</th>
                            <th>OR Number</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="transactions-table-body">
                        <tr><td colspan="7" class="text-center py-5 text-muted"><i class="fa fa-spinner fa-spin fs-3 mb-2"></i><br>Loading transactions...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    {{-- REPORTS TAB --}}
    <div id="section-reports" class="content-section" style="display: none;">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif; font-size: 24px;">Reports</h3>
                <p class="text-muted mb-0" style="font-size: 14px;">Generate and review comprehensive financial analytics.</p>
            </div>
            
            <div class="position-relative d-inline-block" id="reportDropdownContainer">
                <button class="btn btn-success fw-bold rounded-pill px-4 py-2 shadow-sm d-flex align-items-center gap-2" onclick="toggleReportDropdown(event)" style="background: #22c55e; border: none; font-size: 14px;">
                    <i class="fa fa-download"></i> Download Reports <i class="fa fa-ellipsis-v ms-1"></i>
                </button>
                <div class="report-dropdown-menu" id="reportDropdownMenu">
                    <div class="report-dropdown-item" onclick="downloadReport('pdf')">
                        <i class="fa fa-file-pdf text-danger w-20px"></i> Download as PDF
                    </div>
                    <div class="report-dropdown-item" onclick="downloadReport('docx')">
                        <i class="fa fa-file-word text-primary w-20px"></i> Download as .DOCX
                    </div>
                </div>
            </div>

        </div>

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
                        <tr><td>Retail & Merchandising</td><td class="text-end fw-bold">45%</td></tr>
                        <tr><td>Manufacturing</td><td class="text-end fw-bold">25%</td></tr>
                        <tr><td>Services & Consulting</td><td class="text-end fw-bold">20%</td></tr>
                        <tr><td>IT & Technology</td><td class="text-end fw-bold">10%</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- SETTINGS TAB --}}
    <div id="section-settings" class="content-section" style="display: none;">
        
        {{-- VIEW 1: Main Settings Menu --}}
        <div id="settings-main" class="fade-in">
            <div class="mb-4 pb-2 border-bottom">
                <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Settings</h3>
                <p class="text-muted mb-0" style="font-size: 14px;">Manage your account, security, and preferences.</p>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="custom-card mb-4 p-0 overflow-hidden" style="max-width: 1000px; margin: 0 auto; box-shadow: none; background: transparent;">
                        
                        <div class="setting-box p-4 border-bottom d-flex justify-content-between align-items-center mb-3" onclick="openSetting('settings-account')">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: #fee2e2; color: #ef4444; display: flex; justify-content: center; align-items: center; font-size: 18px;"><i class="fa fa-user"></i></div>
                                <div><div class="fw-bold text-dark" style="font-size: 16px;">Account Settings</div><div class="text-muted" style="font-size: 13px;">Profile details, email, and roles</div></div>
                            </div>
                            <i class="fa fa-chevron-right text-muted"></i>
                        </div>

                        <div class="setting-box p-4 border-bottom d-flex justify-content-between align-items-center mb-3" onclick="openSetting('settings-security')">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: #e0e7ff; color: #3b82f6; display: flex; justify-content: center; align-items: center; font-size: 18px;"><i class="fa fa-shield-alt"></i></div>
                                <div><div class="fw-bold text-dark" style="font-size: 16px;">Security</div><div class="text-muted" style="font-size: 13px;">Change password, 2FA</div></div>
                            </div>
                            <i class="fa fa-chevron-right text-muted"></i>
                        </div>

                        <div class="setting-box p-4 d-flex justify-content-between align-items-center mb-3" onclick="openSetting('settings-preferences')">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: #f3e8ff; color: #6366f1; display: flex; justify-content: center; align-items: center; font-size: 18px;"><i class="fa fa-sliders-h"></i></div>
                                <div><div class="fw-bold text-dark" style="font-size: 16px;">Preferences</div><div class="text-muted" style="font-size: 13px;">Dark mode, Notifications</div></div>
                            </div>
                            <i class="fa fa-chevron-right text-muted"></i>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end mb-5" style="max-width: 1000px; margin: 0 auto;">
                        <button class="btn btn-danger px-4 py-2 fw-bold shadow-sm rounded-pill" onclick="logout()">
                            <i class="fa fa-sign-out-alt me-2"></i> Log Out
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- VIEW 2: ACCOUNT SETTINGS --}}
        <div id="settings-account" class="fade-in" style="display: none;">
            
            <div class="acc-header-out">
                <button class="back-btn-ui" onclick="closeSetting('settings-account')">
                    <i class="fa fa-angle-left fs-4"></i>
                </button>
                <i class="fa fa-user-cog acc-header-icon"></i>
                <div class="acc-title-wrap">
                    <h4 class="fw-bold mb-0 text-dark" style="font-size: 20px;">Account</h4>
                    <span class="text-muted" style="font-size: 13px;">Manage your company profile and personal account information.</span>
                </div>
            </div>

            <div class="new-acc-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('images/PCCI-Logo.svg') }}" class="new-acc-avatar" alt="Profile">
                        <div>
                            <h6 class="fw-bold text-dark mb-0" style="font-size: 16px;">Profile Picture</h6>
                            <span class="text-muted" style="font-size: 12px; text-transform: uppercase;">PNG, JPEG under 15MB</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="new-acc-btn-upload shadow-sm" onclick="openCropModal()">Upload new photo</button>
                        <button class="new-acc-btn-delete shadow-sm">Delete</button>
                    </div>
                </div>

                <h6 class="fw-bold text-dark mt-4 mb-3" style="font-size: 14px;">Full Name</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted mb-1 w-100" style="font-size: 12px;">Last Name</label>
                        <div class="position-relative">
                            <input type="text" class="new-acc-input" id="settingsLastName" value="Jesus">
                            <button class="new-acc-edit"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted mb-1 w-100" style="font-size: 12px;">First Name</label>
                        <div class="position-relative">
                            <input type="text" class="new-acc-input" id="settingsFirstName" value="Versula">
                            <button class="new-acc-edit"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>

                <hr class="border-secondary opacity-25" style="margin: 25px 0;">

                <h6 class="fw-bold text-dark mb-3" style="font-size: 14px;">Contact Email</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted mb-1 w-100" style="font-size: 12px;">Email</label>
                        <div class="position-relative">
                            <input type="email" class="new-acc-input" id="settingsEmailInput" value="versulajesus@gmail.com">
                            <button class="new-acc-edit"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted mb-1 w-100" style="font-size: 12px;">Contact Number</label>
                        <div class="position-relative">
                            <input type="text" class="new-acc-input" value="0967 567 1234">
                            <button class="new-acc-edit"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <button class="new-acc-action-gray shadow-sm">Deactive Account</button>
                    <button class="new-acc-action-dark shadow-sm">Delete Account</button>
                </div>
            </div>
        </div>

        {{-- VIEW 3: NEW SECURITY SETTINGS --}}
        <div id="settings-security" class="fade-in" style="display: none;">
            
            <div class="acc-header-out">
                <button class="back-btn-ui" onclick="closeSetting('settings-security')">
                    <i class="fa fa-angle-left fs-4"></i>
                </button>
                <i class="fa fa-lock acc-header-icon" style="font-size: 32px;"></i>
                <div class="acc-title-wrap">
                    <h4 class="fw-bold mb-0 text-dark" style="font-size: 20px;">Security</h4>
                    <span class="text-muted" style="font-size: 13px;">Protect your account by managing passwords and security settings.</span>
                </div>
            </div>

            <div class="new-acc-card p-0" style="background: transparent; box-shadow: none;">
                
                {{-- Change Password Bar --}}
                <div class="sec-change-pw-box">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fa fa-lock fs-4 text-dark"></i>
                            <span class="fw-bold text-dark fs-5" style="font-size: 16px !important;">Change Password</span>
                        </div>
                        <button class="sec-btn-update shadow-sm" onclick="openOtpModal()">Update Password</button>
                    </div>
                </div>

                {{-- Login Activity Box --}}
                <div class="sec-login-box shadow-sm">
                    <h5 class="sec-login-title text-dark">Login Activity</h5>
                    <hr class="sec-divider">
                    <div class="table-responsive">
                        <table class="sec-table">
                            <thead>
                                <tr>
                                    <th class="text-dark">Device</th>
                                    <th class="text-dark">Location</th>
                                    <th class="text-dark">Date</th>
                                    <th class="text-dark">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Android - Chrome</td>
                                    <td>Marilao, Bulacan</td>
                                    <td>10:00Am, March 9, 2025</td>
                                    <td class="text-muted">Successful</td>
                                </tr>
                                <tr>
                                    <td>Lenovo LOQ - Chrome</td>
                                    <td>Marilao, Bulacan</td>
                                    <td>10:00Am, March 9, 2025</td>
                                    <td class="text-muted">Successful</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        {{-- VIEW 4: Preferences --}}
        <div id="settings-preferences" class="fade-in" style="display: none;">
            <div class="acc-header-out">
                <button class="back-btn-ui" onclick="closeSetting('settings-preferences')">
                    <i class="fa fa-angle-left fs-4"></i>
                </button>
                <i class="fa fa-sliders-h acc-header-icon" style="font-size: 32px;"></i>
                <div class="acc-title-wrap">
                    <h4 class="fw-bold mb-0 text-dark" style="font-size: 20px;">Preferences</h4>
                    <span class="text-muted" style="font-size: 13px;">Manage appearance and notification settings.</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="new-acc-card">
                        <h6 class="fw-bold text-dark mb-4 border-bottom pb-2">Appearance & Notifications</h6>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Dark Mode</h6>
                                <small class="text-muted">Switch between a light and dark interface</small>
                            </div>
                            <div class="form-check form-switch fs-4">
                                <input class="form-check-input" type="checkbox" id="darkModeSwitch" style="cursor: pointer;" onclick="toggleDarkMode()">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Email Notifications</h6>
                                <small class="text-muted">Receive alerts for new pending payments</small>
                            </div>
                            <div class="form-check form-switch fs-4">
                                <input class="form-check-input" type="checkbox" checked style="cursor: pointer;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">Membership Expiry Reminder</h6>
                                <small class="text-muted">Get notified 30 days before a membership expires</small>
                            </div>
                            <div class="form-check form-switch fs-4">
                                <input class="form-check-input" type="checkbox" checked style="cursor: pointer;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- MODALS --}}
<div class="custom-modal-overlay" id="proofModal" onclick="closeProofModal(event)">
    <div class="custom-modal-card" onclick="event.stopPropagation()">
        <button class="modal-close-x" onclick="hideProofModal()">&times;</button>
        <h5 class="fw-bold mb-3"><i class="fa fa-file-invoice text-danger me-2"></i> Process Applicant Payment</h5>
        
        <div class="modal-img-wrapper mb-4" id="modalImgWrapper">
            <div id="modalSpinner" class="text-muted"><i class="fa fa-spinner fa-spin fs-2"></i><br><small>Loading Image...</small></div>
            <img id="modalImage" src="" alt="Proof of Payment" style="display: none;" onload="onImageLoad()">
        </div>

        <div>
            <label class="small text-muted fw-bold mb-2 d-block">SELECT MEMBERSHIP TYPE:</label>
            
            <div class="d-flex gap-3 w-100 mb-4">
                <button id="toggleBtn1" class="type-toggle-btn active-1 flex-grow-1" onclick="selectType(1)">
                    <i class="fa fa-store mb-1 fs-5"></i><br>Micro<br><small class="fw-normal">₱500.00</small>
                </button>
                <button id="toggleBtn2" class="type-toggle-btn flex-grow-1" onclick="selectType(2)">
                    <i class="fa fa-building mb-1 fs-5"></i><br>Small Enterprise<br><small class="fw-normal">₱5,000.00</small>
                </button>
            </div>

            <div class="text-end border-top pt-3">
                <button class="btn btn-success px-4 fw-bold rounded-pill shadow-sm" onclick="confirmProcessing()" style="height: 45px; background: #22c55e; border: none; width: 100%;">
                    Confirm Payment Processing
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

{{-- ADD PAYMENT MODAL (NEW) --}}
<div class="custom-modal-overlay" id="addPaymentModal" onclick="closeAddPaymentOverlay(event)">
    <div class="custom-modal-card add-payment-modal-card" onclick="event.stopPropagation()">
        <button class="modal-close-x" onclick="hideAddPaymentModal()">&times;</button>
        <div class="add-payment-modal-header">
            <div class="add-payment-modal-icon-container">
                <i class="fa fa-user fs-1 text-dark"></i>
                <div class="add-payment-modal-check-icon"><i class="fa fa-check"></i></div>
            </div>
            <h5 class="add-payment-modal-title">Add Payment</h5>
        </div>
        
        <div class="add-payment-modal-body">
            <div class="add-payment-form-group">
                <label class="add-payment-label">Members</label>
                <select class="add-payment-input form-select" style="font-size: 13px;">
                    <option selected>Juan Dela Cruz</option>
                    <option>Other Member A</option>
                    <option>Other Member B</option>
                </select>
            </div>
            <div class="add-payment-form-group">
                <label class="add-payment-label">OR Number</label>
                <input type="text" class="add-payment-input" value="9403-4783" readonly>
            </div>
            <div class="add-payment-form-group">
                <label class="add-payment-label">Payment Date</label>
                <input type="text" class="add-payment-input" value="02-11-2027" readonly>
            </div>
            <div class="add-payment-form-group">
                <label class="add-payment-label">Membership Type</label>
                <select class="add-payment-input form-select" style="font-size: 13px;">
                    <option selected>Annual</option>
                    <option>Semi-Annual</option>
                    <option>Quarterly</option>
                </select>
            </div>
            <div class="add-payment-form-group">
                <label class="add-payment-label">Payment Type</label>
                <select class="add-payment-input form-select" style="font-size: 13px;">
                    <option selected>GCash</option>
                    <option>Cash</option>
                    <option>Bank Transfer</option>
                </select>
            </div>
            <div class="add-payment-form-group">
                <label class="add-payment-label">Proof of Payment</label>
                <input type="text" class="add-payment-input" value="Upload image (png, jpg)" readonly style="color: #999;">
            </div>
            <div class="add-payment-form-group">
                <label class="add-payment-label">Receiver</label>
                <select class="add-payment-input form-select" style="font-size: 13px;">
                    <option selected>Jesus Versula</option>
                    <option>Admin Person B</option>
                </select>
            </div>
        </div>

        <div class="add-payment-modal-footer">
            <button class="add-payment-btn-clear" onclick="clearPaymentForm()">Clear Form</button>
            <button class="add-payment-btn-confirm" onclick="confirmPaymentAdd()">Confirm</button>
        </div>
    </div>
</div>

{{-- RESET PASSWORD OTP MODAL (NEW) --}}
<div class="custom-modal-overlay" id="otpModal" onclick="closeOtpOverlay(event)">
    <div class="custom-modal-card otp-modal-card" onclick="event.stopPropagation()">
        <h5 class="otp-title">Reset Password</h5>
        <p class="otp-subtitle">Enter the code sent to <span>example@gmail.com</span> to reset your password</p>
        <div class="otp-input-container">
            <input type="text" maxlength="1" class="otp-box" oninput="moveToNext(this, event)">
            <input type="text" maxlength="1" class="otp-box" oninput="moveToNext(this, event)">
            <input type="text" maxlength="1" class="otp-box" oninput="moveToNext(this, event)">
            <input type="text" maxlength="1" class="otp-box" oninput="moveToNext(this, event)">
            <input type="text" maxlength="1" class="otp-box" oninput="moveToNext(this, event)">
            <input type="text" maxlength="1" class="otp-box" oninput="moveToNext(this, event)">
        </div>
    </div>
</div>

{{-- NEW: ENTER NEW PASSWORD MODAL --}}
<div class="custom-modal-overlay" id="resetPasswordModal" onclick="closeResetPasswordOverlay(event)">
    <div class="custom-modal-card reset-pw-modal-card" onclick="event.stopPropagation()">
        <h5 class="reset-pw-title">Reset Password</h5>
        <p class="reset-pw-subtitle">Enter your new password</p>
        
        <label class="reset-pw-label">New Password</label>
        <div class="reset-pw-input-wrap">
            <i class="fa fa-key reset-pw-icon-left"></i>
            <input type="password" class="reset-pw-input" id="newPasswordInput" placeholder="abcde" oninput="validatePassword()">
            <i class="fa fa-eye reset-pw-icon-right" onclick="togglePasswordView('newPasswordInput')"></i>
        </div>

        {{-- Live Checklist --}}
        <ul class="reset-pw-checklist">
            <li id="req-lower"><i class="fa fa-check-circle"></i> At least one lower case letter.</li>
            <li id="req-len"><i class="fa fa-check-circle"></i> Minimum of 8 characters.</li>
            <li id="req-upper"><i class="fa fa-check-circle"></i> At least one upper case letter.</li>
            <li id="req-num"><i class="fa fa-check-circle"></i> At least one number.</li>
        </ul>

        <label class="reset-pw-label">Re-Password</label>
        <div class="reset-pw-input-wrap">
            <i class="fa fa-key reset-pw-icon-left"></i>
            <input type="password" class="reset-pw-input" id="rePasswordInput" placeholder="abcde">
            <i class="fa fa-eye reset-pw-icon-right" onclick="togglePasswordView('rePasswordInput')"></i>
        </div>

        <div class="reset-pw-actions">
            <button class="reset-pw-btn-cancel" onclick="hideResetPasswordModal()">Cancel</button>
            <button class="reset-pw-btn-submit" id="resetPwSubmitBtn" onclick="submitNewPassword()">Reset Password</button>
        </div>
    </div>
</div>

{{-- CROP PROFILE PICTURE MODAL --}}
<div class="custom-modal-overlay" id="cropModal" onclick="closeCropOverlay(event)">
    <div class="custom-modal-card crop-modal-card" onclick="event.stopPropagation()">
        <div class="crop-header">
            <h5 class="crop-title">Crop your new profile picture</h5>
            <button class="crop-close-btn" onclick="hideCropModal()"><i class="fa fa-times"></i></button>
        </div>
        
        <div class="crop-body">
            <div class="crop-image-container">
                <img src="https://i.pravatar.cc/400?img=11" alt="To Crop">
                <div class="crop-overlay-circle"></div>
            </div>
        </div>

        <div class="crop-footer">
            <button class="crop-btn-submit" onclick="setNewProfilePicture()">Set New Profile Picture</button>
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
    let filteredApplicantsData = [];
    let currentApplicantPage = 1;
    const applicantsPerPage = 10;

    let currentApplicantId = null;
    let currentSelectedType = 1;

    let membershipTypes = [
        { "id": 1, "name": "Micro", "price": "500.00", "duration_in_months": 12 },
        { "id": 2, "name": "Small Enterprises", "price": "5000.00", "duration_in_months": 12 }
    ];

    // --- OTP MODAL & NEW PASSWORD MODAL LOGIC ---
    function openOtpModal() {
        document.getElementById('otpModal').style.display = 'flex';
    }
    
    function hideOtpModal() {
        document.getElementById('otpModal').style.display = 'none';
        document.querySelectorAll('.otp-box').forEach(box => box.value = '');
    }
    
    function closeOtpOverlay(e) {
        if (e.target.id === 'otpModal') hideOtpModal();
    }
    
    function moveToNext(input, event) {
        if (input.value.length === 1) {
            let next = input.nextElementSibling;
            if (next && next.tagName.toLowerCase() === 'input') {
                next.focus();
            } else if (!next) {
                // It's the last box! Auto-transition to new password screen
                setTimeout(() => {
                    hideOtpModal();
                    openResetPasswordModal();
                }, 300);
            }
        }
    }
    
    document.querySelectorAll('.otp-box').forEach(box => {
        box.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value) {
                let prev = this.previousElementSibling;
                if (prev && prev.tagName.toLowerCase() === 'input') {
                    prev.focus();
                }
            }
        });
    });

    // --- RESET PASSWORD MODAL FUNCTIONS ---
    function openResetPasswordModal() {
        document.getElementById('resetPasswordModal').style.display = 'flex';
    }
    function hideResetPasswordModal() {
        document.getElementById('resetPasswordModal').style.display = 'none';
        document.getElementById('newPasswordInput').value = '';
        document.getElementById('rePasswordInput').value = '';
        validatePassword(); // Reset checklist
    }
    function closeResetPasswordOverlay(e) {
        if (e.target.id === 'resetPasswordModal') hideResetPasswordModal();
    }
    function togglePasswordView(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === "password" ? "text" : "password";
    }
    function validatePassword() {
        const pw = document.getElementById('newPasswordInput').value;
        const reqLower = document.getElementById('req-lower');
        const reqLen = document.getElementById('req-len');
        const reqUpper = document.getElementById('req-upper');
        const reqNum = document.getElementById('req-num');
        const submitBtn = document.getElementById('resetPwSubmitBtn');

        let validCount = 0;

        if(/[a-z]/.test(pw)) { reqLower.classList.add('valid'); validCount++; } else { reqLower.classList.remove('valid'); }
        if(pw.length >= 8) { reqLen.classList.add('valid'); validCount++; } else { reqLen.classList.remove('valid'); }
        if(/[A-Z]/.test(pw)) { reqUpper.classList.add('valid'); validCount++; } else { reqUpper.classList.remove('valid'); }
        if(/[0-9]/.test(pw)) { reqNum.classList.add('valid'); validCount++; } else { reqNum.classList.remove('valid'); }

        // Light up button if all 4 conditions met
        if(validCount === 4) {
            submitBtn.classList.add('active');
        } else {
            submitBtn.classList.remove('active');
        }
    }
    function submitNewPassword() {
        const pw1 = document.getElementById('newPasswordInput').value;
        const pw2 = document.getElementById('rePasswordInput').value;
        const btn = document.getElementById('resetPwSubmitBtn');

        if(!btn.classList.contains('active')) {
            alert("Please ensure your password meets all security requirements.");
            return;
        }
        if(pw1 !== pw2) {
            alert("Passwords do not match!");
            return;
        }

        alert("Password Successfully Reset!");
        hideResetPasswordModal();
    }

    // --- CROP PROFILE PICTURE MODAL LOGIC ---
    function openCropModal() {
        document.getElementById('cropModal').style.display = 'flex';
    }
    function hideCropModal() {
        document.getElementById('cropModal').style.display = 'none';
    }
    function closeCropOverlay(e) {
        if (e.target.id === 'cropModal') hideCropModal();
    }
    function setNewProfilePicture() {
        alert("Profile picture successfully updated!");
        hideCropModal();
    }

    // --- DROPDOWN MENUS LOGIC ---
    function toggleReportDropdown(e) {
        e.stopPropagation();
        const menu = document.getElementById('reportDropdownMenu');
        menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
    function toggleTransDropdown(e) {
        e.stopPropagation();
        const menu = document.getElementById('transDropdownMenu');
        menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
    function toggleTransFilter(e) {
        e.stopPropagation();
        const menu = document.getElementById('transFilterMenu');
        menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
    
    function downloadReport(type) {
        alert(`Initiating ${type.toUpperCase()} Report Download...`);
        document.getElementById('reportDropdownMenu').style.display = 'none';
    }
    
    function exportTransactions() {
        alert("Preparing transaction data for export...");
        document.getElementById('transDropdownMenu').style.display = 'none';
    }

    // --- TRANSACTIONS SEARCH & FILTER LOGIC ---
    let currentTransFilter = 'all'; 

    function filterTransactions(filterType) {
        currentTransFilter = filterType; 
        document.getElementById('transFilterMenu').style.display = 'none'; 
        applyTransactionFilters(); 
    }

    const transSearchInput = document.getElementById('transactionSearch');
    if (transSearchInput) {
        transSearchInput.addEventListener('input', applyTransactionFilters);
    }

    function applyTransactionFilters() {
        const searchTerm = document.getElementById('transactionSearch').value.toLowerCase();
        const tbody = document.getElementById('transactions-table-body');
        if(!tbody) return;
        const rows = tbody.getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            
            if (row.innerText.includes('Loading')) continue;

            const statusBadge = row.querySelector('.status-badge');
            const statusText = statusBadge ? statusBadge.innerText.toLowerCase() : '';
            const rowText = row.innerText.toLowerCase();

            const matchesFilter = (currentTransFilter === 'all' || statusText.includes(currentTransFilter));
            const matchesSearch = rowText.includes(searchTerm);

            if (matchesFilter && matchesSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    document.addEventListener('click', (e) => {
        const reportMenu = document.getElementById('reportDropdownMenu');
        if (reportMenu && reportMenu.style.display === 'flex' && !e.target.closest('#reportDropdownContainer')) {
            reportMenu.style.display = 'none';
        }
        
        const transMenu = document.getElementById('transDropdownMenu');
        if (transMenu && transMenu.style.display === 'flex' && !e.target.closest('#transMenuContainer')) {
            transMenu.style.display = 'none';
        }

        const filterMenu = document.getElementById('transFilterMenu');
        if (filterMenu && filterMenu.style.display === 'flex' && !e.target.closest('#transFilterContainer')) {
            filterMenu.style.display = 'none';
        }

        const p = document.getElementById('notificationPanel'); 
        if (p && p.style.display === 'flex' && !p.contains(e.target) && !e.target.closest('.fa-bell')) {
            p.style.display = 'none';
        }
    });

    // --- DARK MODE LOGIC ---
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const icon = document.getElementById('darkModeIcon');
        const text = document.getElementById('darkModeText');
        const switchBtn = document.getElementById('darkModeSwitch');
        
        if (document.body.classList.contains('dark-mode')) {
            if(icon) icon.classList.replace('fa-moon', 'fa-sun');
            if(text) text.innerText = 'Light Mode';
            if(switchBtn) switchBtn.checked = true;
            localStorage.setItem('theme', 'dark');
        } else {
            if(icon) icon.classList.replace('fa-sun', 'fa-moon');
            if(text) text.innerText = 'Dark Mode';
            if(switchBtn) switchBtn.checked = false;
            localStorage.setItem('theme', 'light');
        }
    }

    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        setTimeout(() => {
            const icon = document.getElementById('darkModeIcon');
            const text = document.getElementById('darkModeText');
            const switchBtn = document.getElementById('darkModeSwitch');
            if(icon) icon.classList.replace('fa-moon', 'fa-sun');
            if(text) text.innerText = 'Light Mode';
            if(switchBtn) switchBtn.checked = true;
        }, 50);
    }

    // --- SETTINGS VIEW SWITCHER ---
    function openSetting(id) {
        document.getElementById('settings-main').style.display = 'none';
        document.getElementById(id).style.display = 'block';
    }
    function closeSetting(id) {
        document.getElementById(id).style.display = 'none';
        document.getElementById('settings-main').style.display = 'block';
    }

    // --- NOTIFICATION SYSTEM ---
    function updateExpiringNotifications() {
        const today = new Date();
        let expiringCount = 0;
        let notifHTML = '';

        allMembersData.forEach(member => {
            const endDateString = member.membership_end_date || (member.created_at ? new Date(new Date(member.created_at).setFullYear(new Date(member.created_at).getFullYear() + 1)).toISOString() : null);
            
            if (endDateString) {
                const expDate = new Date(endDateString);
                const diffTime = expDate - today; 
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays <= 30) {
                    expiringCount++;
                    const name = member.applicant?.basic_profile?.registered_business_name || 'Unknown Business';
                    let statusText = '', iconClass = '';
                    
                    if (diffDays < 0) {
                        statusText = `<span class="text-danger fw-bold">Expired ${Math.abs(diffDays)} days ago</span>`;
                        iconClass = 'fa-times-circle text-danger';
                    } else if (diffDays === 0) {
                        statusText = `<span class="text-danger fw-bold">Expires TODAY</span>`;
                        iconClass = 'fa-exclamation-circle text-danger';
                    } else {
                        statusText = `<span class="text-warning fw-bold">Expires in ${diffDays} days</span>`;
                        iconClass = 'fa-exclamation-triangle text-warning';
                    }

                    notifHTML += `
                        <div class="notif-item" style="background: #f9fafb;">
                            <div class="notif-icon" style="background: white; border: 1px solid #ddd;"><i class="fa ${iconClass} fs-5"></i></div>
                            <div class="notif-text-content">
                                <p class="fw-bold mb-1 text-dark" style="font-size: 13px;">${name}</p>
                                <small>${statusText} (${expDate.toISOString().split('T')[0]})</small>
                            </div>
                        </div>
                    `;
                }
            }
        });

        const notifBody = document.querySelector('.notif-body');
        const notifBadge = document.querySelector('.notif-badge');
        const redDot = document.querySelector('.fa-bell').nextElementSibling;

        if (expiringCount > 0) {
            notifBody.innerHTML = notifHTML;
            notifBadge.innerText = `${expiringCount} New`;
            if (redDot) redDot.style.display = 'block'; 
        } else {
            notifBody.innerHTML = `
                <div class="notif-item" style="background: #f9fafb;">
                    <div class="notif-icon" style="background: white; border: 1px solid #ddd;"><i class="fa fa-check-circle text-success fs-5"></i></div>
                    <div class="notif-text-content"><p class="text-dark">No memberships are expiring soon.</p><small>You're all caught up!</small></div>
                </div>
            `;
            notifBadge.innerText = `0 New`;
            if (redDot) redDot.style.display = 'none'; 
        }
    }

    function checkAuth(res) {
        if (res.status === 401) {
            localStorage.removeItem('token');
            window.location.href = '/login';
            return false;
        }
        return true;
    }

    // Modals
    function openSimpleProof(url) {
        if (!url || url === '#' || url === 'null') { alert("No proof found."); return; }
        const img = document.getElementById('simpleModalImage');
        document.getElementById('simpleModalSpinner').style.display = 'block';
        img.style.display = 'none';
        img.src = url.startsWith('http') ? url : `https://pcci-laravel-api.onrender.com/${url.replace(/^\/+/, '')}`;
        document.getElementById('simpleProofModal').style.display = 'flex';
    }
    function onSimpleImageLoad() { document.getElementById('simpleModalImage').style.display = 'block'; document.getElementById('simpleModalSpinner').style.display = 'none'; }
    function hideSimpleProofModal() { document.getElementById('simpleProofModal').style.display = 'none'; }
    function closeSimpleProofModal(e) { if (e.target.id === 'simpleProofModal') hideSimpleProofModal(); }

    function openProof(url, applicantId) {
        if (!url || url === '#' || url === 'null') { alert("No proof found."); return; }
        currentApplicantId = applicantId; 
        const img = document.getElementById('modalImage');
        document.getElementById('modalSpinner').style.display = 'block';
        img.style.display = 'none';
        img.src = url.startsWith('http') ? url : `https://pcci-laravel-api.onrender.com/${url.replace(/^\/+/, '')}`;
        selectType(1); 
        document.getElementById('proofModal').style.display = 'flex';
    }
    function onImageLoad() { document.getElementById('modalImage').style.display = 'block'; document.getElementById('modalSpinner').style.display = 'none'; }
    function hideProofModal() { document.getElementById('proofModal').style.display = 'none'; }
    function closeProofModal(e) { if (e.target.id === 'proofModal') hideProofModal(); }

    function selectType(id) {
        currentSelectedType = id; 
        document.getElementById('toggleBtn1').className = (id == 1) ? 'type-toggle-btn active-1 flex-grow-1' : 'type-toggle-btn flex-grow-1';
        document.getElementById('toggleBtn2').className = (id == 2) ? 'type-toggle-btn active-2 flex-grow-1' : 'type-toggle-btn flex-grow-1';
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
                
                const amtLbl = document.getElementById(`amount-label-${currentApplicantId}`);
                const typeLbl = document.getElementById(`type-label-${currentApplicantId}`);
                const bge = document.getElementById(`status-badge-${currentApplicantId}`);
                const actionBox = document.getElementById(`action-container-${currentApplicantId}`);
                
                if(amtLbl) { amtLbl.innerText = `₱ Processed`; amtLbl.className = "fw-bold text-dark"; }
                if(typeLbl) { typeLbl.innerText = "PAID"; typeLbl.className = "text-success fw-bold"; }
                if(bge) { bge.innerHTML = `<i class="fa fa-check-double me-1"></i> PAID`; bge.className = "badge bg-success text-white px-2 py-1 rounded-pill fw-bold shadow-sm"; }
                if(actionBox) { actionBox.innerHTML = `<button class="action-btn btn-gray" disabled style="width: 130px;"><i class="fa fa-check"></i> Processed</button>`; }

                fetchMembers();        
                fetchTransactions();   
                fetchRecentPayments(); 
                alert("Success: Payment Processed!");
            } else {
                const result = await response.json();
                if (response.status === 422 && result.errors) {
                    let errorMessages = "Laravel Validation Failed! It needs these fields:\n\n";
                    for (let field in result.errors) {
                        errorMessages += `❌ ${field}: ${result.errors[field].join(', ')}\n`;
                    }
                    alert(errorMessages);
                } else {
                    alert(`Backend Error: ${result.message || 'Something went wrong'}`);
                }
            }
        } catch (err) { alert("Network error: Could not reach the server."); }
    }

    function viewMemberDetails(memberId) {
        const member = allMembersData.find(m => m.id === memberId);
        if (!member) return;
        const profile = member.applicant?.basic_profile || {};
        
        document.getElementById('member-detail-content').innerHTML = `
            <div class="row g-3 text-start">
                <div class="col-12 border-bottom pb-2 mb-2"><label class="text-muted small fw-bold">BUSINESS NAME</label><h5 class="fw-bold text-dark">${profile.registered_business_name || 'N/A'}</h5></div>
                <div class="col-md-6"><label class="text-muted small fw-bold">TRADE NAME</label><p class="fw-bold text-dark">${profile.trade_name || 'N/A'}</p></div>
                <div class="col-md-6"><label class="text-muted small fw-bold">EMAIL</label><p class="fw-bold text-dark">${profile.email || 'N/A'}</p></div>
            </div>
        `;
        document.getElementById('memberDetailsModal').style.display = 'flex';
    }
    function hideMemberModal() { document.getElementById('memberDetailsModal').style.display = 'none'; }
    function closeMemberModal(e) { if (e.target.id === 'memberDetailsModal') hideMemberModal(); }

    // --- ADD PAYMENT MODAL LOGIC ---
    function openAddPaymentModal() { document.getElementById('addPaymentModal').style.display = 'flex'; }
    function hideAddPaymentModal() { document.getElementById('addPaymentModal').style.display = 'none'; }
    function closeAddPaymentOverlay(e) { if (e.target.id === 'addPaymentModal') hideAddPaymentModal(); }
    function clearPaymentForm() { alert("Form cleared!"); }
    function confirmPaymentAdd() { alert("Payment details confirmed!"); hideAddPaymentModal(); }

    document.addEventListener('DOMContentLoaded', () => {
        if (!token) { window.location.href = '/login'; return; }
        
        // Settings Name population
        const storedName = localStorage.getItem('userName') || 'Jesus Versula';
        document.getElementById('sidebarName').innerText = storedName;
        const nameInput = document.getElementById('settingsLastName');
        if (nameInput) {
             const parts = storedName.split(' ');
             if(parts.length > 1) {
                 document.getElementById('settingsFirstName').value = parts[0];
                 document.getElementById('settingsLastName').value = parts.slice(1).join(' ');
             }
        }
        
        fetchApplicants();
        fetchMembers();
        fetchRecentPayments();
        fetchTransactions();
        initCharts(); 

        document.getElementById('memberSearch').addEventListener('input', applyMemberFilters);
        document.getElementById('memberSort').addEventListener('change', applyMemberFilters);
        
        document.getElementById('applicantSearch').addEventListener('input', applyApplicantFilters);
        document.getElementById('applicantSort').addEventListener('change', applyApplicantFilters);

        // 🌟 THIS IS WHERE IT BELONGS: Check memory and switch tab immediately on load
        const savedTab = localStorage.getItem('activeTab') || 'dashboard';
        switchTab(savedTab);
    });

    // --- MEMBER FILTER/SORT ---
    function applyMemberFilters() {
        const term = document.getElementById('memberSearch').value.toLowerCase();
        const sortVal = document.getElementById('memberSort').value;

        filteredMembersData = allMembersData.filter(m => {
            const name = (m.applicant?.basic_profile?.registered_business_name || '').toLowerCase();
            return name.includes(term);
        });

        filteredMembersData.sort((a, b) => {
            const nameA = (a.applicant?.basic_profile?.registered_business_name || '').toLowerCase();
            const nameB = (b.applicant?.basic_profile?.registered_business_name || '').toLowerCase();
            const dateA = new Date(a.created_at || 0);
            const dateB = new Date(b.created_at || 0);

            if (sortVal === 'name_asc') return nameA.localeCompare(nameB);
            if (sortVal === 'name_desc') return nameB.localeCompare(nameA);
            if (sortVal === 'oldest') return dateA - dateB;
            return dateB - dateA;
        });

        currentMemberPage = 1; 
        displayMembersPage();
    }

    // --- APPLICANT FILTER/SORT ---
    function applyApplicantFilters() {
        const term = document.getElementById('applicantSearch').value.toLowerCase();
        const sortVal = document.getElementById('applicantSort').value;

        filteredApplicantsData = allApplicantsData.filter(a => {
            const name = (a.basic_profile?.registered_business_name || '').toLowerCase();
            return name.includes(term);
        });

        filteredApplicantsData.sort((a, b) => {
            const nameA = (a.basic_profile?.registered_business_name || '').toLowerCase();
            const nameB = (b.basic_profile?.registered_business_name || '').toLowerCase();
            const dateA = new Date(a.created_at || 0);
            const dateB = new Date(b.created_at || 0);

            if (sortVal === 'name_asc') return nameA.localeCompare(nameB);
            if (sortVal === 'name_desc') return nameB.localeCompare(nameA);
            if (sortVal === 'oldest') return dateA - dateB;
            return dateB - dateA;
        });

        currentApplicantPage = 1; 
        displayApplicantsPage();
    }


    // API Fetches
    async function fetchApplicants() {
        try {
            const [res1, res2] = await Promise.all([
                fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants?status=approved', { headers: { 'Authorization': `Bearer ${token}` } }),
                fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants?status=paid', { headers: { 'Authorization': `Bearer ${token}` } })
            ]);

            if (!checkAuth(res1)) return;

            let combinedData = [];
            
            if (res1.ok) {
                const data1 = await res1.json();
                if (data1.data) combinedData = combinedData.concat(data1.data);
            }
            if (res2.ok) {
                const data2 = await res2.json();
                if (data2.data) combinedData = combinedData.concat(data2.data);
            }

            allApplicantsData = combinedData;

            const pendingCount = allApplicantsData.filter(a => String(a.status).toLowerCase() !== 'paid').length;
            document.getElementById('report-pending-count').innerText = pendingCount; 
            document.getElementById('report-pending-count-badge').innerText = `${pendingCount} Pending`; 
            
            applyApplicantFilters(); 
        } catch (err) {}
    }

    function displayApplicantsPage() {
        const totalPages = Math.ceil(filteredApplicantsData.length / applicantsPerPage) || 1;
        if (currentApplicantPage > totalPages) currentApplicantPage = totalPages;
        if (currentApplicantPage < 1) currentApplicantPage = 1;
        
        const pageData = filteredApplicantsData.slice((currentApplicantPage - 1) * applicantsPerPage, currentApplicantPage * applicantsPerPage);
        
        const tbody = document.getElementById('applicants-table-body');
        tbody.innerHTML = '';
        
        if(pageData.length === 0) {
            tbody.innerHTML = `<tr><td colspan="8" class="text-center py-5 text-muted fw-bold">No applicants found.</td></tr>`;
        }

        pageData.forEach(app => {
            const profile = app.basic_profile || {};
            const isPaid = String(app.status).toLowerCase() === 'paid';
            
            let typeLabelHTML = isPaid ? `<span id="type-label-${app.id}" class="text-success fw-bold">PAID</span>` : `<span id="type-label-${app.id}" class="text-danger fw-bold">PENDING</span>`;
            let statusBadge = isPaid ? `<span id="status-badge-${app.id}" class="badge bg-success text-white px-2 py-1 rounded-pill fw-bold shadow-sm" style="font-size:10px;"><i class="fa fa-check-double me-1"></i> PAID</span>` : `<span id="status-badge-${app.id}" class="badge bg-warning text-dark px-2 py-1 rounded-pill fw-bold" style="font-size:10px;">APPROVED</span>`;
            let amountText = isPaid ? '₱ Processed' : '---';
            
            let actionButton = isPaid 
                ? `<button class="action-btn btn-gray" disabled style="width: 130px;"><i class="fa fa-check"></i> Processed</button>`
                : `<button onclick="openProof('${app.proof_of_payment_url}', ${app.id})" class="action-btn btn-green" style="width: 130px;"><i class="fa fa-image me-1"></i> Process Payment</button>`;

            tbody.insertAdjacentHTML('beforeend', `
                <tr id="applicant-row-${app.id}">
                    <td class="fw-bold text-dark">${profile.registered_business_name || 'N/A'}</td>
                    <td class="text-dark">${profile.trade_name || 'N/A'}</td>
                    <td class="text-dark">${profile.email || 'N/A'}</td>
                    <td class="text-dark">${app.date_submitted || 'N/A'}</td>
                    <td>${typeLabelHTML}</td>
                    <td><span id="amount-label-${app.id}" class="fw-bold text-dark">${amountText}</span></td>
                    <td>${statusBadge}</td>
                    <td id="action-container-${app.id}">${actionButton}</td>
                </tr>
            `);
        });
        document.getElementById('applicant-pagination-text').innerText = `Page ${currentApplicantPage} of ${totalPages}`;
    }

    function prevApplicantPage() { if (currentApplicantPage > 1) { currentApplicantPage--; displayApplicantsPage(); } }
    function nextApplicantPage() { if (currentApplicantPage < Math.ceil(filteredApplicantsData.length / applicantsPerPage)) { currentApplicantPage++; displayApplicantsPage(); } }


    // 🌟 HERE IS THE MEMBER FETCH YOU ASKED FOR
    async function fetchMembers() {
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/members', { headers: { 'Authorization': `Bearer ${token}` } });
            if (!checkAuth(response)) return;
            const data = await response.json();
            if (response.ok && data.data) {
                allMembersData = data.data; 
                
                const totalMembersBadge = document.getElementById('total-members-badge');
                if (totalMembersBadge) totalMembersBadge.innerText = `${allMembersData.length} Active`;
                
                const reportActive = document.getElementById('report-active-members');
                if (reportActive) reportActive.innerText = allMembersData.length;
                
                applyMemberFilters(); 
                updateExpiringNotifications();
            }
        } catch (err) {
            console.error("Failed to fetch members:", err);
            const tbody = document.getElementById('members-table-body');
            if(tbody) tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-danger fw-bold">Network error. Failed to load data.</td></tr>`;
        }
    }

    function displayMembersPage() {
        const totalPages = Math.ceil(filteredMembersData.length / membersPerPage) || 1;
        if (currentMemberPage > totalPages) currentMemberPage = totalPages;
        if (currentMemberPage < 1) currentMemberPage = 1;
        
        const pageData = filteredMembersData.slice((currentMemberPage - 1) * membersPerPage, currentMemberPage * membersPerPage);
        
        const tbody = document.getElementById('members-table-body');
        tbody.innerHTML = '';
        
        if(pageData.length === 0) {
            tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted fw-bold">No members found matching your search.</td></tr>`;
        }

        pageData.forEach(member => {
            const name = member.applicant?.basic_profile?.registered_business_name || 'N/A';
            const orNumber = `OR-${10000 + member.id}`; 
            
            const regDate = member.created_at ? member.created_at.split('T')[0] : 'N/A';
            let expDate = member.membership_end_date ? member.membership_end_date.split('T')[0] : 'N/A';
            if(expDate === 'N/A' && member.created_at) {
                 const dateObj = new Date(member.created_at);
                 dateObj.setFullYear(dateObj.getFullYear() + 1);
                 expDate = dateObj.toISOString().split('T')[0];
            }

            tbody.insertAdjacentHTML('beforeend', `
                <tr>
                    <td class="fw-bold text-dark">${name}</td>
                    <td>Annual</td>
                    <td class="fw-bold text-dark">₱5,000</td>
                    <td class="text-dark">${orNumber}</td>
                    <td class="text-dark">${regDate}</td>
                    <td class="text-dark">${expDate}</td>
                    <td><span class="status-badge status-completed">Active</span></td>
                    <td><button class="btn btn-sm btn-link p-0 fw-bold" onclick="openSimpleProof('${member.proof_of_payment_url}')">View File</button></td>
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
                            <td class="fw-bold text-dark">₱5,000</td>
                            <td class="text-dark">Pending</td>
                            <td class="text-dark">${app.date_approved || 'N/A'}</td>
                            <td><button class="btn btn-sm btn-link p-0 fw-bold" onclick="openSimpleProof('${app.proof_of_payment_url}')">View File</button></td>
                            <td><button class="action-btn btn-green" onclick="openProof('${app.proof_of_payment_url}', ${app.id})">Process</button></td>
                        </tr>
                    `);
                });
            }
        } catch (err) {}
    }

    // 👉 REALISTIC DUMMY DATA INJECTION FOR TRANSACTIONS
    async function fetchTransactions() {
        try {
            const todayStr = new Date().toISOString().split('T')[0];
            const yesterdayObj = new Date();
            yesterdayObj.setDate(yesterdayObj.getDate() - 1);
            const yesterdayStr = yesterdayObj.toISOString().split('T')[0];

            const data = {
                data: [
                    { applicant: { basic_profile: { registered_business_name: "Tech Innovators Corp" } }, amount: "5000.00", status: "paid", created_at: todayStr, or_number: "OR-10234" },
                    { applicant: { basic_profile: { registered_business_name: "Valenzuela Merchandising" } }, amount: "500.00", status: "completed", created_at: todayStr, or_number: "OR-10233" },
                    { applicant: { basic_profile: { registered_business_name: "Santos Family Bakery" } }, amount: "500.00", status: "pending", created_at: yesterdayStr, or_number: "---" },
                    { applicant: { basic_profile: { registered_business_name: "Metro Manila Logistics" } }, amount: "5000.00", status: "failed", created_at: yesterdayStr, or_number: "---" },
                    { applicant: { basic_profile: { registered_business_name: "Global Export Partners" } }, amount: "5000.00", status: "paid", created_at: "2023-10-15", or_number: "OR-10220" },
                    { applicant: { basic_profile: { registered_business_name: "City Cafe & Resto" } }, amount: "500.00", status: "completed", created_at: "2023-10-14", or_number: "OR-10219" }
                ]
            };

            const tbodyTrans = document.getElementById('transactions-table-body');
            if(tbodyTrans) tbodyTrans.innerHTML = '';
            
            let total = 0, pending = 0, complete = 0, failed = 0;
            let todayTotal = 0, yesterdayTotal = 0;

            if (data.data) {
                data.data.forEach(txn => {
                    const amt = parseFloat(txn.amount) || 0;
                    const status = String(txn.status || 'completed').toLowerCase();
                    const txnDate = txn.created_at ? txn.created_at.split('T')[0] : '';
                    
                    total += amt;
                    if (status === 'completed' || status === 'paid') {
                        complete += amt;
                        if (txnDate === todayStr) {
                            todayTotal += amt;
                        } else if (txnDate === yesterdayStr) {
                            yesterdayTotal += amt;
                        }
                    }
                    else if (status === 'failed') failed += amt;
                    else pending += amt;

                    let statClass = status === 'pending' ? 'status-pending' : (status === 'failed' ? 'status-failed' : 'status-completed');
                    let membershipText = amt > 1000 ? 'Small Enterprise' : 'Micro';

                    if(tbodyTrans) {
                        tbodyTrans.insertAdjacentHTML('beforeend', `
                            <tr>
                                <td class="fw-bold text-dark ps-4">${txn.applicant?.basic_profile?.registered_business_name || 'Unknown'}</td>
                                <td class="text-dark">Gcash</td>
                                <td class="text-dark">${txnDate || 'N/A'}</td>
                                <td class="text-dark">${membershipText}</td>
                                <td class="text-dark">${txn.or_number || '---'}</td>
                                <td class="text-center"><span class="status-badge ${statClass}">${status.toUpperCase()}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border shadow-sm action-icon-btn" style="color: #3b82f6;"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-light border shadow-sm action-icon-btn" style="color: #ef4444; margin-left: 4px;"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                });
            }
            
            const fmt = val => `₱${val.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            
            document.getElementById('trans-total-amt').innerText = fmt(total);
            document.getElementById('trans-pending-amt').innerText = fmt(pending);
            document.getElementById('trans-complete-amt').innerText = fmt(complete);
            document.getElementById('trans-failed-amt').innerText = fmt(failed);

            const todayEl = document.getElementById('today-payments-amt');
            const yesterdayEl = document.getElementById('yesterday-payments-amt');
            if (todayEl) todayEl.innerText = fmt(todayTotal);
            if (yesterdayEl) yesterdayEl.innerText = fmt(yesterdayTotal);

        } catch (err) {}
    }

    // --- CHARTS (DASHBOARD & REPORTS) ---
    function initCharts() {
        const ctxBar = document.getElementById('barChart');
        if(ctxBar) new Chart(ctxBar, { type: 'bar', data: { labels: ['21', '22', '23', '24'], datasets: [{ data: [120, 150, 180, 205], backgroundColor: '#3b82f6' }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } } });

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
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, font: {size: 11} } } }, scales: { y: { grid: { color: '#eee', borderDash: [5, 5] }, ticks: { color: '#aaa', font: {size: 11} }, border: {display: false} }, x: { grid: { display: false }, ticks: { color: '#aaa', font: {size: 11} }, border: {display: false} } } }
            });
        }

        const reportPie = document.getElementById('reportPieChart');
        if(reportPie) {
            new Chart(reportPie.getContext('2d'), { type: 'pie', data: { labels: ['Annual', 'Monthly'], datasets: [{ data: [75, 25], backgroundColor: ['#6366f1', '#f97316'], borderWidth: 0 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, font: {size: 11} } } } } });
        }
    }

    // UI Tab Switcher
    function switchTab(tabName) {
        localStorage.setItem('activeTab', tabName); // 🌟 NEW: Saves the current tab
        
        document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
        document.querySelectorAll('.sidebar-menu li').forEach(li => li.classList.remove('active'));
        document.getElementById('section-' + tabName).style.display = 'block';
        document.getElementById('nav-' + tabName).classList.add('active');
        
        if(tabName !== 'settings') {
            const mainSet = document.getElementById('settings-main');
            if(mainSet) mainSet.style.display = 'block';
            const accSet = document.getElementById('settings-account');
            if(accSet) accSet.style.display = 'none';
            const secSet = document.getElementById('settings-security');
            if(secSet) secSet.style.display = 'none';
            const prefSet = document.getElementById('settings-preferences');
            if(prefSet) prefSet.style.display = 'none';
        }
    }
    
    function toggleNotificationPanel(e) { e.stopPropagation(); const p = document.getElementById('notificationPanel'); p.style.display = p.style.display === 'flex' ? 'none' : 'flex'; }
    function clearNotifications(e) { e.stopPropagation(); document.getElementById('notificationPanel').style.display = 'none'; }
    function logout() { localStorage.removeItem('token'); window.location.href = '/login'; }
</script>
@endsection