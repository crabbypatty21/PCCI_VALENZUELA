@extends('layouts.admin')

@section('title', 'Members - PCCI')

@section('content')
<style>
    /* ============================================== */
    /* MEMBERS LISTING PAGE                           */
    /* ============================================== */

    .members-header-banner {
        background-color: var(--pcci-red);
        color: #fff;
        padding: 36px 40px;
        border-radius: 10px;
        font-size: 2rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 28px;
        letter-spacing: 1px;
    }

    /* --- Search & Add Row --- */
    .members-toolbar {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
        padding: 14px 20px;
        background: #fafafa;
        border-radius: 12px;
        border: 1px solid #eee;
    }

    .search-box {
        flex: 1;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 11px 4px 11px 10px;
        border: 1.5px solid #ddd;
        border-bottom: 2.5px solid var(--pcci-red);
        border-radius: 8px 8px 0 0;
        font-size: 0.92rem;
        color: #333;
        font-family: 'Inter', sans-serif;
        background: #fff;
        outline: none;
        transition: all 0.25s ease;
    }

    .search-box input::placeholder {
        color: #aaa;
        font-size: 0.9rem;
        font-style: italic;
    }

    .search-box input:focus {
        border-color: var(--pcci-red);
        border-bottom-color: var(--pcci-red);
        box-shadow: 0 3px 8px rgba(190, 30, 56, 0.08);
    }

    .search-box .search-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--pcci-red);
        font-size: 1.05rem;
        pointer-events: none;
    }

    .btn-add-new {
        background-color: var(--pcci-red);
        color: #fff;
        border: none;
        padding: 11px 26px;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.25s ease;
        letter-spacing: 0.3px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(190, 30, 56, 0.25);
    }

    .btn-add-new:hover {
        background-color: #9a0a28;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(190, 30, 56, 0.35);
    }

    /* --- Table Container --- */
    .members-table-wrapper {
        border: 2px solid var(--pcci-red);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 0;
    }

    .members-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
    }

    /* --- Table Header --- */
    .members-table thead th {
        background-color: var(--pcci-red);
        color: #fff;
        font-weight: 700;
        font-size: 0.82rem;
        padding: 14px 12px;
        text-align: left;
        white-space: nowrap;
        border-right: 1px solid rgba(255,255,255,0.15);
        position: relative;
        cursor: default;
    }

    .members-table thead th:last-child {
        border-right: none;
    }

    /* Sort icon styling */
    .sort-icon {
        font-size: 0.7rem;
        margin-left: 4px;
        opacity: 0.8;
        vertical-align: middle;
    }

    /* --- Table Body --- */
    .members-table tbody tr {
        border-bottom: 1px solid #e8e8e8;
        transition: background-color 0.15s;
    }

    .members-table tbody tr:last-child {
        border-bottom: none;
    }

    .members-table tbody tr:hover {
        background-color: #fff5f6;
    }

    .members-table tbody td {
        padding: 14px 12px;
        color: #333;
        vertical-align: middle;
        border-right: 1px solid #f0f0f0;
    }

    .members-table tbody td:last-child {
        border-right: none;
    }

    /* --- Pagination Bar --- */
    .members-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        border-top: 2px solid var(--pcci-red);
        background: #fff;
        font-size: 0.85rem;
        color: #555;
    }

    .pagination-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pagination-left label {
        font-weight: 500;
        color: #555;
    }

    .pagination-left select {
        padding: 4px 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 0.85rem;
        color: #333;
        outline: none;
        cursor: pointer;
    }

    .pagination-center {
        font-weight: 500;
        color: #555;
    }

    .pagination-right {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .pagination-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #555;
        font-size: 0.8rem;
        transition: all 0.15s;
    }

    .pagination-btn:hover {
        background: #f5f5f5;
        border-color: var(--pcci-red);
        color: var(--pcci-red);
    }

    .pagination-btn.disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    /* ============================================== */
    /* ADD NEW MEMBER MODAL                           */
    /* ============================================== */

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 15, 20, 0.55);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-card {
        background: #fff;
        border-radius: 16px;
        width: 100%;
        max-width: 620px;
        margin: 20px;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(0, 0, 0, 0.04);
        position: relative;
        animation: modalPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.92) translateY(-10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    /* --- Red Top Accent Bar --- */
    .modal-card::before {
        content: '';
        display: block;
        height: 4px;
        background: linear-gradient(90deg, var(--pcci-red), #e35d5d);
        flex-shrink: 0;
    }

    /* --- Header --- */
    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 28px 16px;
    }

    .modal-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .modal-header-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(190,30,56,0.1), rgba(190,30,56,0.05));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pcci-red);
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .modal-header h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .modal-header h3 span {
        display: block;
        font-size: 0.78rem;
        font-weight: 400;
        color: #888;
        margin-top: 2px;
    }

    .modal-close-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--pcci-red);
        color: #fff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(190, 30, 56, 0.3);
    }

    .modal-close-btn:hover {
        background: #9a0a28;
        transform: rotate(90deg) scale(1.05);
    }

    /* --- Divider --- */
    .modal-divider {
        height: 1px;
        background: #eee;
        margin: 0 28px;
    }

    /* --- Body (Scrollable) --- */
    .modal-body {
        padding: 24px 32px 12px;
        overflow-y: auto;
        flex: 1;
    }

    .modal-body::-webkit-scrollbar { width: 5px; }
    .modal-body::-webkit-scrollbar-track { background: transparent; }
    .modal-body::-webkit-scrollbar-thumb { background: #ddd; border-radius: 3px; }

    /* --- Section Label inside modal --- */
    .modal-section-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--pcci-red);
        margin-bottom: 24px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #eee;
    }

    /* --- Field --- */
    .modal-field {
        margin-bottom: 32px;
    }

    .modal-field:last-child {
        margin-bottom: 16px;
    }

    .modal-field label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .modal-field label .required {
        color: var(--pcci-red);
        margin-left: 2px;
    }

    .modal-field input,
    .modal-field select {
        width: 90%;
        padding: 12px 14px;
        border: 1.5px solid #9d9d9db9;
        border-radius: 10px;
        font-size: 0.88rem;
        font-family: 'Inter', sans-serif;
        color: #333;
        background: #fafafa;
        outline: none;
        transition: all 0.25s ease;
        appearance: none;
        -webkit-appearance: none;
    }

    .modal-field input::placeholder {
        color: #b0b0b0;
        font-style: italic;
    }

    .modal-field input:focus,
    .modal-field select:focus {
        border-color: var(--pcci-red);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(190, 30, 56, 0.08);
    }

    /* --- Input with icon --- */
    .modal-input-icon-wrap {
        position: relative;
    }

    .modal-input-icon-wrap input {
        padding-left: 40px;
    }

    .modal-input-icon-wrap .input-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 0.95rem;
        pointer-events: none;
    }

    .modal-input-icon-wrap input:focus + .input-icon,
    .modal-input-icon-wrap input:focus ~ .input-icon {
        color: var(--pcci-red);
    }

    /* --- Select arrow --- */
   .modal-select-wrap {
    position: relative;
    width: 100%;
    }

    .modal-select-wrap select {
        width: 100%;
        padding: 12px 40px 12px 16px; /* extra right padding for arrow */
        border-radius: 12px;
        border: 1px solid #ccc;
        appearance: none; /* remove default arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background: #fff;
        font-size: 1rem;
        cursor: pointer;
    }

    /* Custom Arrow */
    .modal-select-wrap::after {
        content: '\F282';
        font-family: 'bootstrap-icons';
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 0.8rem;
        color: #d32f2f; /* use your red variable if needed */
    }

    /* --- Two-column row --- */
    .modal-row {
        display: flex;
    }

    .modal-row .modal-field {
        flex: 1;
    }

    .modal-row .modal-field:first-child {
        margin-right: 16px;
    }

    .modal-row .modal-field:last-child {
        margin-left: 16px;
    }

    /* --- Date input --- */
    .modal-field input[type="date"] {
        color: #999;
    }

    .modal-field input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0.4;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .modal-field input[type="date"]:hover::-webkit-calendar-picker-indicator {
        opacity: 0.7;
    }

    /* --- Footer --- */
    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 16px 28px 22px;
        border-top: 1px solid #f0f0f0;
        background: #fafafa;
    }

    .btn-modal-cancel {
        padding: 10px 24px;
        border: 1.5px solid #d5d5d5;
        border-radius: 10px;
        background: #fff;
        color: #444;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-modal-cancel:hover {
        background: #f0f0f0;
        border-color: #bbb;
    }

    .btn-modal-save {
        padding: 10px 30px;
        border: none;
        border-radius: 10px;
        background: var(--pcci-red);
        color: #fff;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 2px 8px rgba(190, 30, 56, 0.25);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-modal-save:hover {
        background: #9a0a28;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(190, 30, 56, 0.35);
    }

    /* --- Responsive --- */
    @media (max-width: 992px) {
        .members-header-banner {
            padding: 20px 24px;
            font-size: 1.5rem;
        }

        .members-table-wrapper {
            overflow-x: auto;
        }

        .members-table {
            min-width: 800px;
        }
    }

    @media (max-width: 576px) {
        .members-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: 100%;
        }

        .btn-add-new {
            text-align: center;
            justify-content: center;
        }

        .members-pagination {
            flex-direction: column;
            gap: 12px;
            text-align: center;
        }

        .modal-card {
            margin: 12px;
            max-height: 95vh;
        }

        .modal-header {
            padding: 16px 20px 12px;
        }

        .modal-body {
            padding: 16px 20px 8px;
        }

        .modal-footer {
            padding: 14px 20px 18px;
        }

        .modal-row {
            flex-direction: column;
        }

        .modal-row .modal-field:first-child {
            margin-right: 0;
        }

        .modal-row .modal-field:last-child {
            margin-left: 0;
        }
    }
</style>

{{-- ======== RED HEADER BANNER ======== --}}
<div class="members-header-banner">
    Members
</div>

{{-- ======== SEARCH BAR + ADD NEW ======== --}}
<div class="members-toolbar">
    <div class="search-box">
        <input type="text" placeholder="Search company name . . .">
        <i class="bi bi-search search-icon"></i>
    </div>
    <button class="btn-add-new" type="button"><i class="bi bi-plus-lg"></i> Add New</button>
</div>

{{-- ======== TABLE ======== --}}
<div class="members-table-wrapper">
    <table class="members-table">
        <thead>
            <tr>
                <th>Company Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                <th>Member Type</th>
                <th>Current Status</th>
                <th>Business Address</th>
                <th>Email</th>
                <th>Contact No. <i class="bi bi-arrow-down-up sort-icon"></i></th>
                <th>Registered Member</th>
                <th>Registration date <i class="bi bi-arrow-down sort-icon"></i></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>test</td>
                <td>directory</td>
                <td>Active</td>
                <td>test</td>
                <td>testuser@gmail.com</td>
                <td>09090909090</td>
                <td>test</td>
                <td>1/25/30</td>
            </tr>
            <tr>
                <td>test</td>
                <td>directory</td>
                <td>Disabled</td>
                <td>test</td>
                <td>delacruz@gmail.com</td>
                <td>09090909090</td>
                <td>test</td>
                <td>1/25/30</td>
            </tr>
            <tr>
                <td>test</td>
                <td>directory</td>
                <td>Active</td>
                <td>valenzuela</td>
                <td>roman@gmail.com</td>
                <td>09090909090</td>
                <td>test</td>
                <td>1/25/30</td>
            </tr>
            <tr>
                <td>test</td>
                <td>directory</td>
                <td>Active</td>
                <td>test</td>
                <td>castro@gmail.com</td>
                <td>09090909090</td>
                <td>test</td>
                <td>1/25/30</td>
            </tr>
            <tr>
                <td>test</td>
                <td>directory</td>
                <td>Active</td>
                <td>test</td>
                <td>palermo@gmail.com</td>
                <td>09090909090</td>
                <td>test</td>
                <td>1/25/30</td>
            </tr>
            <tr>
                <td>test company</td>
                <td>member</td>
                <td>Active</td>
                <td>test</td>
                <td>versula@gmail.com</td>
                <td>09090909090</td>
                <td>test</td>
                <td>1/25/30</td>
            </tr>
        </tbody>
    </table>

    {{-- ======== PAGINATION ======== --}}
    <div class="members-pagination">
        <div class="pagination-left">
            <label>Rows per page</label>
            <select>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="pagination-center">
            Page 1 of 1
        </div>
        <div class="pagination-right">
            <button class="pagination-btn disabled" title="First"><i class="bi bi-chevron-double-left"></i></button>
            <button class="pagination-btn disabled" title="Previous"><i class="bi bi-chevron-left"></i></button>
            <button class="pagination-btn disabled" title="Next"><i class="bi bi-chevron-right"></i></button>
            <button class="pagination-btn disabled" title="Last"><i class="bi bi-chevron-double-right"></i></button>
        </div>
    </div>
</div>

{{-- ======== ADD NEW MEMBER MODAL ======== --}}
<div class="modal-overlay" id="addMemberModal">
    <div class="modal-card">

        {{-- Header --}}
        <div class="modal-header">
            <div class="modal-header-left">
                <div class="modal-header-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h3>
                    Add New Member
                    <span>Fill in the details below to register a new member.</span>
                </h3>
            </div>
            <button class="modal-close-btn" id="closeModal" type="button">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="modal-divider"></div>

        {{-- Body --}}
        <div class="modal-body">

            {{-- Section: Company Info --}}
            <div class="modal-section-label">Company Information</div>

            {{-- Company Name --}}
            <div class="modal-field">
                <label>Company Name <span class="required">*</span></label>
                <div class="modal-input-icon-wrap">
                    <input type="text" placeholder="Enter company name . . .">
                    <i class="bi bi-building input-icon"></i>
                </div>
            </div>

            {{-- Member Type & Status --}}
            <div class="modal-row">
                <div class="modal-field">
                    <label>Member Type <span class="required">*</span></label>
                    <div class="modal-select-wrap">
                        <select>
                            <option>Directory Member</option>
                            <option>Member</option>
                        </select>
                    </div>
                </div>
                <div class="modal-field">
                    <label>Status <span class="required">*</span></label>
                    <div class="modal-select-wrap">
                        <select>
                            <option>Active</option>
                            <option>Disabled</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Business Address --}}
            <div class="modal-field">
                <label>Business Address <span class="required">*</span></label>
                <div class="modal-input-icon-wrap">
                    <input type="text" placeholder="Enter business address . . .">
                    <i class="bi bi-geo-alt input-icon"></i>
                </div>
            </div>

            {{-- Section: Contact Details --}}
            <div class="modal-section-label">Contact Details</div>

            {{-- Email & Contact --}}
            <div class="modal-row">
                <div class="modal-field">
                    <label>Email <span class="required">*</span></label>
                    <div class="modal-input-icon-wrap">
                        <input type="email" placeholder="Enter email address . . .">
                        <i class="bi bi-envelope input-icon"></i>
                    </div>
                </div>
                <div class="modal-field">
                    <label>Contact Number</label>
                    <div class="modal-input-icon-wrap">
                        <input type="text" placeholder="Enter contact number . . .">
                        <i class="bi bi-phone input-icon"></i>
                    </div>
                </div>
            </div>

            {{-- Registration Date --}}
            <div class="modal-field">
                <label>Registration Date <span class="required">*</span></label>
                <input type="date">
            </div>

        </div>

        {{-- Footer --}}
        <div class="modal-footer">
            <button class="btn-modal-cancel" id="cancelModal" type="button">Cancel</button>
            <button class="btn-modal-save" type="button">
                <i class="bi bi-check-lg"></i> Save Member
            </button>
        </div>

    </div>
</div>

<script>
    // Open modal
    document.querySelector('.btn-add-new').addEventListener('click', function() {
        document.getElementById('addMemberModal').classList.add('active');
    });

    // Close modal (X button)
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('addMemberModal').classList.remove('active');
    });

    // Close modal (Cancel button)
    document.getElementById('cancelModal').addEventListener('click', function() {
        document.getElementById('addMemberModal').classList.remove('active');
    });

    // Close modal (click outside)
    document.getElementById('addMemberModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('active');
        }
    });
</script>

@endsection