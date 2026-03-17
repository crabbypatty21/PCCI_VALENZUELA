@extends('layouts.admin')

@section('title', 'Board of Trustees - PCCI')

@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .board-wrapper {
        font-family: 'Montserrat', sans-serif;
        --dark-red: #be1e38;
        --light-red: #df5861;
        --text-dark: #222222;
        --text-gray: #b0b0b0;
        --pill-bg: #e5e5e5;
    }

    /* BANNER */
    .board-wrapper .board-banner {
        background-color: var(--dark-red);
        color: #ffffff;
        padding: 36px 40px;
        border-radius: 10px;
        font-size: 2.2rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 30px;
    }

    /* TOOLBAR */
    .board-wrapper .board-toolbar {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 40px;
        width: 100%;
        box-sizing: border-box;
    }

    .board-wrapper .toolbar-search {
        position: relative;
        flex: 1;
        max-width: 500px;
    }

    .board-wrapper .toolbar-search i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #b0b0b0;
        font-size: 1.1rem;
    }

    .board-wrapper .toolbar-search input {
        width: 100%;
        height: 45px;
        box-sizing: border-box;
        padding: 0 16px 0 46px;
        border: 1.5px solid var(--dark-red);
        border-radius: 6px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-dark);
        text-transform: uppercase;
        outline: none;
        background: #ffffff;
    }

    .board-wrapper .toolbar-search input::placeholder { color: #c0c0c0; font-weight: 500; letter-spacing: 0.5px; }

    .board-wrapper .toolbar-filter {
        height: 45px;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0 24px;
        border: 1.5px solid var(--dark-red);
        border-radius: 6px;
        background: #ffffff;
        color: #b0b0b0;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        white-space: nowrap;
        transition: 0.2s ease;
    }

    .board-wrapper .toolbar-filter i { font-size: 1.3rem; color: #b0b0b0; }
    .board-wrapper .toolbar-filter:hover { background: #fdf2f2; }

    .board-wrapper .toolbar-add {
        height: 45px;
        box-sizing: border-box;
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0 32px;
        border: none;
        border-radius: 6px;
        background-color: #be1e38;
        color: #ffffff;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .board-wrapper .toolbar-add i { font-size: 1.2rem; }
    .board-wrapper .toolbar-add:hover { background-color: #ff0000; }

    /* CARD GRID */
    .board-wrapper .board-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .board-wrapper .board-card {
        border: 1.5px solid var(--dark-red);
        border-radius: 8px;
        background: #ffffff;
        padding: 35px 20px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .board-wrapper .card-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 25px;
        background-color: #f0f0f0;
    }

    .board-wrapper .card-photo-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #e8e8e8;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        font-size: 3.5rem;
        color: #bbb;
    }

    .board-wrapper .card-name {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--text-dark);
        text-transform: uppercase;
        margin-bottom: 12px;
        letter-spacing: 0.5px;
    }

    .board-wrapper .card-position-pill {
        font-size: 0.65rem;
        font-weight: 700;
        color: #888888;
        background-color: var(--pill-bg);
        padding: 6px 18px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 30px;
    }

    .board-wrapper .card-actions {
        display: flex;
        gap: 10px;
        width: 100%;
        margin-top: auto;
    }

    .board-wrapper .btn-card {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 4px;
        border: 1px solid var(--dark-red);
        border-radius: 4px;
        background: #ffffff;
        color: var(--text-gray);
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .board-wrapper .btn-card:hover { background: #fdf2f2; color: var(--dark-red); }

    /* ============================================== */
    /* ADD / EDIT BOARD MODAL                         */
    /* ============================================== */
    .add-board-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .add-board-overlay.active { display: flex; }

    .add-board-modal {
        font-family: 'Montserrat', sans-serif;
        background: #ffffff;
        border-radius: 10px;
        width: 100%;
        max-width: 360px;
        padding: 28px 28px 24px;
        position: relative;
        box-shadow: 0 8px 40px rgba(0,0,0,0.18);
        animation: modalIn 0.22s ease;
    }

    @keyframes modalIn {
        from { transform: scale(0.94); opacity: 0; }
        to   { transform: scale(1);    opacity: 1; }
    }

    .add-board-modal .modal-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .add-board-modal .modal-header-icon {
        width: 38px; height: 38px;
        background: #A81C31; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.1rem; flex-shrink: 0;
    }

    .add-board-modal .modal-title {
        font-size: 1rem; font-weight: 800;
        color: #222; text-transform: uppercase; letter-spacing: 1px;
    }

    .add-board-modal .modal-close {
        position: absolute; top: 16px; right: 16px;
        width: 28px; height: 28px;
        border: 1.5px solid #ccc; border-radius: 5px;
        background: #fff; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; color: #888; transition: 0.15s;
    }

    .add-board-modal .modal-close:hover { border-color: #A81C31; color: #A81C31; }

    /* Photo Upload */
    .add-board-modal .photo-upload-wrapper {
        display: flex; justify-content: center;
        margin-bottom: 22px; position: relative;
    }

    .add-board-modal .photo-preview {
        width: 130px; height: 130px; border-radius: 50%;
        background: #e8e8e8;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden; position: relative;
    }

    .add-board-modal .photo-preview img { width: 100%; height: 100%; object-fit: cover; display: none; }
    .add-board-modal .photo-preview .default-icon { font-size: 4rem; color: #bbb; }

    .add-board-modal .photo-add-btn {
        position: absolute; bottom: 4px; right: calc(50% - 65px + 6px);
        width: 26px; height: 26px; background: #222;
        border-radius: 50%; border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1rem; transition: 0.15s;
    }

    .add-board-modal .photo-add-btn:hover { background: #A81C31; }

    /* Form Fields */
    .add-board-modal .form-row { display: flex; gap: 10px; margin-bottom: 10px; }
    .add-board-modal .form-field { flex: 1; position: relative; }

    .add-board-modal .form-field i {
        position: absolute; left: 12px; top: 50%;
        transform: translateY(-50%); color: #bbb; font-size: 0.9rem;
    }

    .add-board-modal .form-input {
        width: 100%; box-sizing: border-box; height: 40px;
        border: 1.5px solid #ddd; border-radius: 6px;
        padding: 0 12px 0 34px;
        font-family: 'Montserrat', sans-serif; font-size: 0.75rem;
        font-weight: 600; color: #444; text-transform: uppercase;
        outline: none; transition: border-color 0.15s;
    }

    .add-board-modal .form-input::placeholder { color: #bbb; font-weight: 500; }
    .add-board-modal .form-input:focus { border-color: #A81C31; }

    /* Gender */
    .add-board-modal .gender-row {
        display: flex; align-items: center; gap: 16px;
        height: 40px; border: 1.5px solid #ddd; border-radius: 6px;
        padding: 0 14px; margin-bottom: 10px;
        font-size: 0.75rem; font-weight: 600; color: #bbb;
        text-transform: uppercase; box-sizing: border-box;
    }

    .add-board-modal .gender-row label { display: flex; align-items: center; gap: 6px; cursor: pointer; color: #555; font-size: 0.75rem; font-weight: 600; }
    .add-board-modal .gender-row input[type="radio"] { accent-color: #A81C31; cursor: pointer; }

    /* Shared dropdown styles */
    .add-board-modal .position-wrapper,
    .add-board-modal .status-wrapper { position: relative; margin-bottom: 10px; }

    .add-board-modal .position-select-btn,
    .add-board-modal .status-select-btn {
        width: 100%; height: 40px;
        border: 1.5px solid #ddd; border-radius: 6px; padding: 0 14px;
        font-family: 'Montserrat', sans-serif; font-size: 0.75rem;
        font-weight: 600; color: #bbb; text-transform: uppercase;
        background: #fff; cursor: pointer;
        display: flex; align-items: center; justify-content: space-between;
        transition: border-color 0.15s; box-sizing: border-box; outline: none;
    }

    .add-board-modal .position-select-btn.has-value,
    .add-board-modal .status-select-btn.has-value { color: #444; }

    .add-board-modal .position-select-btn:hover,
    .add-board-modal .position-select-btn.open,
    .add-board-modal .status-select-btn:hover,
    .add-board-modal .status-select-btn.open { border-color: #A81C31; }

    .add-board-modal .position-select-btn i,
    .add-board-modal .status-select-btn i { font-size: 1rem; color: #aaa; transition: transform 0.15s; }

    .add-board-modal .position-select-btn.open i,
    .add-board-modal .status-select-btn.open i { transform: rotate(180deg); }

    .add-board-modal .position-dropdown,
    .add-board-modal .status-dropdown {
        display: none; position: absolute;
        top: calc(100% + 4px); left: 0; right: 0;
        background: #fff; border: 1.5px solid #ddd; border-radius: 6px;
        z-index: 100; box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        max-height: 230px; overflow-y: auto;
    }

    .add-board-modal .position-dropdown.open,
    .add-board-modal .status-dropdown.open { display: block; }

    .add-board-modal .position-option,
    .add-board-modal .status-option {
        padding: 10px 16px;
        font-family: 'Montserrat', sans-serif; font-size: 0.78rem;
        font-weight: 600; color: #555; text-transform: uppercase;
        letter-spacing: 0.4px; cursor: pointer;
        transition: background 0.1s, color 0.1s;
    }

    .add-board-modal .position-option:hover,
    .add-board-modal .status-option:hover { background: #fdf2f2; color: #A81C31; }

    .add-board-modal .position-option.selected,
    .add-board-modal .status-option.selected { color: #A81C31; }

    .add-board-modal .add-position-row {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 16px;
        border-top: 1.5px solid #eee;
        border-left: none; border-right: none; border-bottom: none;
        background: none; width: 100%;
        font-family: 'Montserrat', sans-serif; font-size: 0.78rem;
        font-weight: 700; color: #333; text-transform: uppercase;
        letter-spacing: 0.4px; cursor: pointer; transition: color 0.15s;
    }

    .add-board-modal .add-position-row i { font-size: 1.15rem; color: #333; transition: color 0.15s; }
    .add-board-modal .add-position-row:hover { color: #A81C31; }
    .add-board-modal .add-position-row:hover i { color: #A81C31; }

    /* Modal Footer */
    .add-board-modal .modal-footer { display: flex; gap: 10px; margin-top: 18px; }

    .add-board-modal .btn-clear {
        flex: 1; height: 40px;
        border: 1.5px solid #A81C31; border-radius: 6px;
        background: #fff; color: #A81C31;
        font-family: 'Montserrat', sans-serif; font-size: 0.78rem; font-weight: 700;
        text-transform: uppercase; cursor: pointer; transition: 0.15s;
    }

    .add-board-modal .btn-clear:hover { background: #fdf2f2; }

    .add-board-modal .btn-confirm {
        flex: 1; height: 40px; border: none; border-radius: 6px;
        background: #A81C31; color: #fff;
        font-family: 'Montserrat', sans-serif; font-size: 0.78rem; font-weight: 700;
        text-transform: uppercase; cursor: pointer; transition: 0.15s;
    }

    .add-board-modal .btn-confirm:hover { background: #c0283f; }

    /* ============================================== */
    /* RESPONSIVE                                     */
    /* ============================================== */
    @media (max-width: 1200px) {
        .board-wrapper .board-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 900px) {
        .board-wrapper .board-banner { font-size: 1.6rem; padding: 36px 40px; }
        .board-wrapper .board-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .board-wrapper .board-toolbar { flex-wrap: wrap; gap: 10px; }
        .board-wrapper .toolbar-search { max-width: 100%; flex: 1 1 180px; }
        .board-wrapper .toolbar-add { margin-left: auto; }
        .add-board-modal { max-width: 420px; padding: 24px 22px 20px; }
    }

    @media (max-width: 600px) {
        .board-wrapper .board-banner { font-size: 1.2rem; padding: 20px 18px; border-radius: 6px; margin-bottom: 20px; }
        .board-wrapper .board-toolbar { flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
        .board-wrapper .toolbar-search { flex: 1 1 100%; max-width: 100%; order: 1; }
        .board-wrapper .toolbar-filter { flex: 1; justify-content: center; order: 2; }
        .board-wrapper .toolbar-add { flex: 1; margin-left: 0; justify-content: center; order: 3; }
        .board-wrapper .board-grid { grid-template-columns: 1fr; gap: 14px; }
        .add-board-overlay { align-items: flex-end; }
        .add-board-modal {
            max-width: 100%; width: 100%; border-radius: 16px 16px 0 0;
            padding: 24px 18px 32px; animation: slideUp 0.25s ease;
            max-height: 92vh; overflow-y: auto;
        }
        @keyframes slideUp { from { transform: translateY(100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .add-board-modal .photo-preview { width: 110px; height: 110px; }
        .add-board-modal .photo-preview .default-icon { font-size: 3.2rem; }
        .add-board-modal .photo-add-btn { right: calc(50% - 55px + 6px); }
        .add-board-modal .form-row { flex-direction: column; gap: 8px; }
        .add-board-modal .position-dropdown,
        .add-board-modal .status-dropdown { top: auto; bottom: calc(100% + 4px); max-height: 180px; }
        .add-board-modal .modal-footer { gap: 8px; }
        .add-board-modal .btn-clear, .add-board-modal .btn-confirm { height: 44px; font-size: 0.82rem; }
    }

    @media (max-width: 400px) {
        .board-wrapper .board-banner { font-size: 1rem; padding: 16px 14px; }
        .board-wrapper .board-grid { gap: 10px; }
        .add-board-modal { padding: 20px 14px 28px; }
        .add-board-modal .modal-title { font-size: 0.88rem; }
        .add-board-modal .gender-row { gap: 10px; padding: 0 10px; font-size: 0.7rem; }
    }

    /* ============================================== */
    /* ADD POSITION MODAL                             */
    /* ============================================== */
    .add-pos-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.38); z-index: 10000;
        align-items: center; justify-content: center; padding: 16px;
    }

    .add-pos-overlay.active { display: flex; }

    .add-pos-modal {
        font-family: 'Montserrat', sans-serif; background: #ffffff;
        border-radius: 8px; width: 100%; max-width: 360px;
        padding: 32px 32px 28px; position: relative;
        box-shadow: 0 8px 40px rgba(0,0,0,0.22);
        animation: modalIn 0.2s cubic-bezier(.22,.68,0,1.2);
    }

    .add-pos-modal .modal-header { display: flex; align-items: center; gap: 14px; margin-bottom: 24px; }

    .add-pos-modal .modal-header-icon {
        width: 42px; height: 42px; background: #A81C31; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.15rem; flex-shrink: 0;
    }

    .add-pos-modal .modal-title { font-size: 1.05rem; font-weight: 800; color: #1a1a1a; text-transform: uppercase; letter-spacing: 1.5px; }

    .add-pos-modal .modal-close {
        position: absolute; top: 18px; right: 18px; width: 30px; height: 30px;
        border: 1.5px solid #ccc; border-radius: 6px; background: #fff; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; color: #888; transition: border-color 0.15s, color 0.15s;
    }

    .add-pos-modal .modal-close:hover { border-color: #A81C31; color: #A81C31; }

    .add-pos-field { margin-bottom: 0; }

    .add-pos-input {
        width: 100%; box-sizing: border-box; height: 44px;
        border: 1.5px solid #A81C31; border-radius: 6px; padding: 0 16px;
        font-family: 'Montserrat', sans-serif; font-size: 0.75rem; font-weight: 500;
        color: #333; outline: none; transition: box-shadow 0.15s, border-color 0.15s;
        margin-bottom: 20px; background: #fff; letter-spacing: 0.5px;
    }

    .add-pos-input::placeholder { color: #bbb; font-weight: 500; text-transform: uppercase; font-size: 0.72rem; letter-spacing: 0.8px; }
    .add-pos-input:focus { box-shadow: 0 0 0 3px rgba(168,28,49,0.1); }
    .add-pos-input.error { border-color: #c0392b; box-shadow: 0 0 0 3px rgba(192,57,43,0.12); }

    .add-pos-modal .modal-footer { display: flex; gap: 12px; margin-top: 0; }

    .add-pos-modal .btn-clear {
        flex: 1; height: 42px; border: 1.5px solid #A81C31; border-radius: 6px;
        background: #fff; color: #A81C31; font-family: 'Montserrat', sans-serif;
        font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        cursor: pointer; transition: background 0.15s;
    }

    .add-pos-modal .btn-clear:hover { background: #fdf2f2; }

    .add-pos-modal .btn-confirm {
        flex: 1; height: 42px; border: none; border-radius: 6px;
        background: #A81C31; color: #fff; font-family: 'Montserrat', sans-serif;
        font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        cursor: pointer; transition: background 0.15s;
    }

    .add-pos-modal .btn-confirm:hover { background: #c0283f; }

    @media (max-width: 600px) {
        .add-pos-overlay { align-items: flex-end; padding: 0; }
        .add-pos-modal { max-width: 100%; border-radius: 16px 16px 0 0; padding: 26px 20px 36px; animation: slideUp 0.25s ease; }
    }

    @media (max-width: 400px) {
        .add-pos-modal { padding: 22px 16px 30px; }
        .add-pos-modal .modal-footer { flex-direction: column; gap: 8px; }
        .add-pos-modal .btn-clear, .add-pos-modal .btn-confirm { width: 100%; }
    }

    /* ============================================== */
    /* VIEW PROFILE MODAL                             */
    /* ============================================== */
    .view-profile-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.45); z-index: 9999;
        align-items: center; justify-content: center; padding: 16px;
    }

    .view-profile-overlay.active { display: flex; }

    .view-profile-modal {
        font-family: 'Montserrat', sans-serif; background: #ffffff;
        border-radius: 12px; width: 100%; max-width: 340px;
        padding: 40px 28px 40px; position: relative;
        box-shadow: 0 8px 40px rgba(0,0,0,0.18);
        display: flex; flex-direction: column; align-items: center;
        text-align: center; animation: modalIn 0.22s ease;
    }

    .view-profile-modal .vp-close {
        position: absolute; top: 14px; right: 14px;
        width: 28px; height: 28px;
        border: 1.5px solid #ccc; border-radius: 5px;
        background: #fff; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; color: #888; transition: 0.15s;
    }

    .view-profile-modal .vp-close:hover { border-color: #A81C31; color: #A81C31; }

    .view-profile-modal .vp-photo {
        width: 170px; height: 170px; border-radius: 50%;
        object-fit: cover; margin-bottom: 28px; background: #f0f0f0;
    }

    .view-profile-modal .vp-photo-placeholder {
        width: 170px; height: 170px; border-radius: 50%;
        background: #e8e8e8; display: flex; align-items: center;
        justify-content: center; margin-bottom: 28px;
        font-size: 5rem; color: #bbb;
    }

    .view-profile-modal .vp-name {
        font-size: 1.05rem; font-weight: 800; color: #1a1a1a;
        text-transform: uppercase; letter-spacing: 0.5px;
        margin-bottom: 16px; line-height: 1.3;
    }

    .view-profile-modal .vp-position-pill {
        font-size: 0.65rem; font-weight: 700; color: #888;
        background: #e5e5e5; padding: 7px 24px;
        border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;
    }

    @media (max-width: 600px) {
        .view-profile-overlay { align-items: flex-end; padding: 0; }
        .view-profile-modal {
            max-width: 100%; border-radius: 16px 16px 0 0;
            padding: 32px 20px 44px; animation: slideUp 0.25s ease;
        }
        .view-profile-modal .vp-photo,
        .view-profile-modal .vp-photo-placeholder { width: 140px; height: 140px; }
    }

    /* ============================================== */
    /* FILTER DROPDOWN PANEL                          */
    /* ============================================== */
    .filter-wrapper { position: relative; }

    .toolbar-filter.filter-active {
        background: #fdf2f2;
        color: var(--dark-red);
    }
    .toolbar-filter.filter-active i { color: var(--dark-red); }

    .filter-panel {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        background: #fff;
        border: 1.5px solid #ddd;
        border-radius: 8px;
        z-index: 500;
        box-shadow: 0 6px 24px rgba(0,0,0,0.10);
        min-width: 230px;
        padding: 16px;
        font-family: 'Montserrat', sans-serif;
    }

    .filter-panel.open { display: block; }

    .filter-panel-title {
        font-size: 0.62rem;
        font-weight: 700;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .filter-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 14px;
    }

    .filter-chip {
        padding: 5px 14px;
        border: 1.5px solid #ddd;
        border-radius: 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.63rem;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        cursor: pointer;
        background: #fff;
        transition: 0.15s;
    }

    .filter-chip:hover { border-color: var(--dark-red); color: var(--dark-red); }
    .filter-chip.chip-active { border-color: var(--dark-red); background: var(--dark-red); color: #fff; }

    .filter-divider { border: none; border-top: 1px solid #eee; margin: 10px 0; }

    .filter-clear-btn {
        width: 100%; height: 34px;
        border: 1.5px solid #ddd; border-radius: 6px;
        background: #fff; color: #888;
        font-family: 'Montserrat', sans-serif; font-size: 0.68rem;
        font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        cursor: pointer; transition: 0.15s;
    }

    .filter-clear-btn:hover { border-color: var(--dark-red); color: var(--dark-red); }

    /* No results */
    .board-no-results {
        display: none;
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: #ccc;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .board-no-results i { display: block; font-size: 2.8rem; margin-bottom: 12px; color: #ddd; }

    /* Loading state */
    .board-loading {
        display: none;
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: #ccc;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .board-loading i { display: block; font-size: 2.8rem; margin-bottom: 12px; color: #ddd; }
</style>

<div class="board-wrapper">
    <div class="board-banner">Board of Trustees</div>

    <div class="board-toolbar">
        <div class="toolbar-search">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Search">
        </div>
        <div class="filter-wrapper">
            <button class="toolbar-filter" id="filterBtn">
                <i class="bi bi-sliders"></i> Filter
            </button>
            <div class="filter-panel" id="filterPanel">
                <div class="filter-panel-title">Position</div>
                {{-- Position chips will be populated dynamically from API --}}
                <div class="filter-chips" id="positionChips">
                    {{-- e.g. <button class="filter-chip" data-filter="position" data-value="President">President</button> --}}
                </div>
                <hr class="filter-divider">
                <div class="filter-panel-title">Status</div>
                <div class="filter-chips">
                    <button class="filter-chip" data-filter="status" data-value="Active">Active</button>
                    <button class="filter-chip" data-filter="status" data-value="Inactive">Inactive</button>
                </div>
                <hr class="filter-divider">
                <button class="filter-clear-btn" id="filterClearBtn">Clear Filters</button>
            </div>
        </div>
        <button class="toolbar-add" id="openAddBoard">
            <i class="bi bi-plus-lg"></i> Add
        </button>
    </div>

    {{-- ================================================
         BOARD GRID — populated via fetch() from the API
         GET http://192.168.55.184:8000/api/v1/trustees
         Each card is rendered by renderCard() in JS below
    ================================================= --}}
    <div class="board-grid" id="boardGrid">

        <div class="board-loading" id="loadingState" style="display:flex; flex-direction:column; align-items:center;">
            <i class="bi bi-arrow-repeat"></i>
            Loading trustees…
        </div>

        <div class="board-no-results" id="noResults">
            <i class="bi bi-person-x"></i>
            No members found
        </div>

    </div>
</div>

<!-- VIEW PROFILE MODAL -->
<div class="view-profile-overlay" id="viewProfileOverlay">
    <div class="view-profile-modal">
        <button class="vp-close" id="closeViewProfile"><i class="bi bi-x"></i></button>
        <img src="" alt="" class="vp-photo" id="vpPhoto" style="display:none;">
        <div class="vp-photo-placeholder" id="vpPhotoPlaceholder" style="display:none;">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="vp-name" id="vpName"></div>
        <div class="vp-position-pill" id="vpPosition"></div>
    </div>
</div>

<!-- ADD / EDIT BOARD MODAL (shared) -->
<div class="add-board-overlay" id="addBoardOverlay">
    <div class="add-board-modal">

        <div class="modal-header">
            <div class="modal-header-icon"><i class="bi bi-person-fill"></i></div>
            <span class="modal-title" id="modalTitle">Add Board</span>
        </div>

        <button class="modal-close" id="closeAddBoard"><i class="bi bi-x"></i></button>

        <div class="photo-upload-wrapper">
            <div class="photo-preview" id="photoPreview">
                <i class="bi bi-person-fill default-icon" id="defaultIcon"></i>
                <img id="previewImg" src="" alt="Preview">
            </div>
            <button class="photo-add-btn" id="photoAddBtn" title="Upload photo">
                <i class="bi bi-plus"></i>
            </button>
            <input type="file" id="photoInput" accept="image/*" style="display:none;">
        </div>

        <div class="form-row">
            <div class="form-field">
                <i class="bi bi-person"></i>
                <input type="text" id="lastName" class="form-input" placeholder="Last Name" autocomplete="off">
            </div>
            <div class="form-field">
                <i class="bi bi-person"></i>
                <input type="text" id="firstName" class="form-input" placeholder="First Name" autocomplete="off">
            </div>
        </div>

        <div class="gender-row">
            <span>Gender:</span>
            <label><input type="radio" name="gender" value="male"> Male</label>
            <label><input type="radio" name="gender" value="female"> Female</label>
        </div>

        <div class="position-wrapper">
            <button type="button" class="position-select-btn" id="positionBtn">
                <span id="positionLabel">Position</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="position-dropdown" id="positionDropdown">
                {{-- Options populated dynamically --}}
                <button type="button" class="add-position-row" id="openAddPosition">
                    <i class="bi bi-plus-circle"></i> Add Position
                </button>
            </div>
        </div>

        <div class="status-wrapper">
            <button type="button" class="status-select-btn" id="statusBtn">
                <span id="statusLabel">Status</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="status-dropdown" id="statusDropdown">
                <div class="status-option" data-value="Active">Active</div>
                <div class="status-option" data-value="Inactive">Inactive</div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn-clear" id="clearFormBtn">Clear</button>
            <button class="btn-confirm" id="confirmBtn">Confirm</button>
        </div>

    </div>
</div>

<!-- ADD POSITION MODAL -->
<div class="add-pos-overlay" id="addPosOverlay">
    <div class="add-pos-modal">

        <div class="modal-header">
            <div class="modal-header-icon"><i class="bi bi-person-fill"></i></div>
            <span class="modal-title">Add Position</span>
        </div>

        <button class="modal-close" id="closePosModal"><i class="bi bi-x"></i></button>

        <div class="add-pos-field">
            <input type="text" id="positionInput" class="add-pos-input" placeholder="Type the position" autocomplete="off">
        </div>

        <div class="modal-footer">
            <button class="btn-clear" id="clearPosBtn">Clear</button>
            <button class="btn-confirm" id="confirmPosBtn">Confirm</button>
        </div>

    </div>
</div>

<script>
(function () {

    const API_URL = 'http://192.168.55.184:8000/api/v1/trustees';

    /* ============================================== */
    /* RENDER HELPERS                                 */
    /* ============================================== */

    /**
     * Build a trustee card element from an API record.
     * Expected fields (adjust to match your actual API response):
     *   trustee.id, trustee.first_name, trustee.last_name,
     *   trustee.gender, trustee.position, trustee.status, trustee.photo_url
     */
    function renderCard(trustee) {
        const gender    = (trustee.gender || '').toLowerCase();
        const prefix    = gender === 'female' ? 'Ms.' : 'Mr.';
        const fullName  = `${prefix} ${trustee.first_name || ''} ${trustee.last_name || ''}`.trim();
        const position  = trustee.position  || '';
        const status    = trustee.status    || 'Active';
        const photoUrl  = trustee.photo_url || '';

        const card = document.createElement('div');
        card.className = 'board-card';
        card.dataset.lastname  = trustee.last_name  || '';
        card.dataset.firstname = trustee.first_name || '';
        card.dataset.gender    = gender;
        card.dataset.position  = position;
        card.dataset.status    = status;
        card.dataset.photo     = photoUrl;
        card.dataset.id        = trustee.id || '';

        card.innerHTML = `
            ${photoUrl
                ? `<img src="${photoUrl}" class="card-photo" alt="${fullName}">`
                : `<div class="card-photo-placeholder"><i class="bi bi-person-fill"></i></div>`
            }
            <div class="card-name">${fullName}</div>
            <div class="card-position-pill">${position}</div>
            <div class="card-actions">
                <button class="btn-card btn-view-profile"><i class="bi bi-eye"></i> View Profile</button>
                <button class="btn-card btn-edit"><i class="bi bi-pencil"></i> Edit</button>
            </div>
        `;

        /* Attach edit listener */
        card.querySelector('.btn-edit').addEventListener('click', function () {
            openModal('edit', card);
        });

        /* Attach view-profile listener */
        card.querySelector('.btn-view-profile').addEventListener('click', function () {
            const imgEl  = card.querySelector('.card-photo');
            vpName.textContent     = card.querySelector('.card-name').textContent.trim();
            vpPosition.textContent = card.querySelector('.card-position-pill').textContent.trim();

            if (imgEl && imgEl.src) {
                vpPhoto.src = imgEl.src;
                vpPhoto.style.display = 'block';
                vpPhotoPlaceholder.style.display = 'none';
            } else {
                vpPhoto.style.display = 'none';
                vpPhotoPlaceholder.style.display = 'flex';
            }
            vpOverlay.classList.add('active');
        });

        return card;
    }

    /**
     * Populate the position filter chips from the unique positions in the loaded data.
     */
    function populatePositionChips(trustees) {
        const seen      = new Set();
        const container = document.getElementById('positionChips');
        container.innerHTML = '';

        trustees.forEach(t => {
            if (t.position && !seen.has(t.position)) {
                seen.add(t.position);
                const btn = document.createElement('button');
                btn.className      = 'filter-chip';
                btn.dataset.filter = 'position';
                btn.dataset.value  = t.position;
                btn.textContent    = t.position;
                btn.addEventListener('click', onChipClick);
                container.appendChild(btn);
            }
        });
    }

    /**
     * Populate the position dropdown inside the Add/Edit modal.
     */
    function populatePositionDropdown(positions) {
        const dropdown   = document.getElementById('positionDropdown');
        const addPosRow  = document.getElementById('openAddPosition');

        /* Remove existing options (keep the "Add Position" row) */
        dropdown.querySelectorAll('.position-option').forEach(el => el.remove());

        positions.forEach(pos => {
            const opt = document.createElement('div');
            opt.className    = 'position-option';
            opt.dataset.value = pos;
            opt.textContent  = pos;
            opt.addEventListener('click', () => pickPosition(pos, opt));
            dropdown.insertBefore(opt, addPosRow);
        });
    }

    /* ============================================== */
    /* FETCH TRUSTEES FROM API                        */
    /* ============================================== */
    function loadTrustees() {
        const grid        = document.getElementById('boardGrid');
        const loadingEl   = document.getElementById('loadingState');
        const noResultsEl = document.getElementById('noResults');

        loadingEl.style.display = 'flex';
        noResultsEl.style.display = 'none';

        fetch(API_URL)
            .then(res => {
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                return res.json();
            })
            .then(data => {
                loadingEl.style.display = 'none';

                /*
                 * Adjust the path below to match your actual API response shape.
                 * Common patterns:
                 *   data          — if the API returns an array directly
                 *   data.data     — if wrapped in { data: [...] }
                 *   data.trustees — if wrapped in { trustees: [...] }
                 */
                const trustees = Array.isArray(data) ? data : (data.data || data.trustees || []);

                /* Clear existing cards (keep the loading / no-results sentinels) */
                grid.querySelectorAll('.board-card').forEach(c => c.remove());

                if (trustees.length === 0) {
                    noResultsEl.style.display = 'block';
                    return;
                }

                trustees.forEach(t => grid.insertBefore(renderCard(t), noResultsEl));

                /* Populate filter chips and modal dropdown from live data */
                populatePositionChips(trustees);
                const uniquePositions = [...new Set(trustees.map(t => t.position).filter(Boolean))];
                populatePositionDropdown(uniquePositions);
            })
            .catch(err => {
                loadingEl.style.display = 'none';
                noResultsEl.innerHTML   = '<i class="bi bi-exclamation-circle"></i> Failed to load trustees.';
                noResultsEl.style.display = 'block';
                console.error('Trustees API error:', err);
            });
    }

    /* Initial load */
    loadTrustees();

    /* ============================================== */
    /* SEARCH & FILTER                                */
    /* ============================================== */
    const searchInput  = document.getElementById('searchInput');
    const filterBtn    = document.getElementById('filterBtn');
    const filterPanel  = document.getElementById('filterPanel');
    const filterClear  = document.getElementById('filterClearBtn');
    const noResults    = document.getElementById('noResults');
    const allCards     = () => document.querySelectorAll('.board-card');

    let activeFilters  = { position: null, status: null };

    /* Toggle filter panel */
    filterBtn.addEventListener('click', e => {
        e.stopPropagation();
        filterPanel.classList.toggle('open');
        filterBtn.classList.toggle('filter-active', filterPanel.classList.contains('open'));
    });

    document.addEventListener('click', e => {
        if (!filterPanel.contains(e.target) && e.target !== filterBtn) {
            filterPanel.classList.remove('open');
            filterBtn.classList.remove('filter-active');
        }
    });

    /* Chip toggle */
    function onChipClick(e) {
        const chip     = e.currentTarget;
        const filter   = chip.dataset.filter;
        const value    = chip.dataset.value;
        const isActive = chip.classList.contains('chip-active');

        /* Deactivate sibling chips in the same group */
        filterPanel.querySelectorAll(`.filter-chip[data-filter="${filter}"]`).forEach(c => c.classList.remove('chip-active'));

        if (!isActive) {
            chip.classList.add('chip-active');
            activeFilters[filter] = value;
        } else {
            activeFilters[filter] = null;
        }

        applyFilters();
        updateFilterBtnStyle();
    }

    /* Attach to status chips (static) */
    document.querySelectorAll('.filter-chip[data-filter="status"]').forEach(c => c.addEventListener('click', onChipClick));

    /* Clear all */
    filterClear.addEventListener('click', () => {
        document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('chip-active'));
        activeFilters = { position: null, status: null };
        applyFilters();
        updateFilterBtnStyle();
    });

    /* Search */
    searchInput.addEventListener('input', applyFilters);

    function applyFilters() {
        const query        = searchInput.value.toLowerCase().trim();
        const posFilter    = activeFilters.position ? activeFilters.position.toLowerCase() : null;
        const statusFilter = activeFilters.status   ? activeFilters.status.toLowerCase()   : null;
        let visibleCount   = 0;

        allCards().forEach(card => {
            const name     = ((card.dataset.firstname || '') + ' ' + (card.dataset.lastname || '')).toLowerCase();
            const position = (card.dataset.position || '').toLowerCase();
            const status   = (card.dataset.status   || '').toLowerCase();

            const matchSearch   = !query        || name.includes(query) || position.includes(query);
            const matchPosition = !posFilter    || position === posFilter;
            const matchStatus   = !statusFilter || status   === statusFilter;

            const visible = matchSearch && matchPosition && matchStatus;
            card.style.display = visible ? '' : 'none';
            if (visible) visibleCount++;
        });

        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    function updateFilterBtnStyle() {
        const hasFilter = activeFilters.position || activeFilters.status;
        filterBtn.classList.toggle('filter-active', !!hasFilter);
        filterBtn.innerHTML = hasFilter
            ? `<i class="bi bi-sliders"></i> Filtered`
            : `<i class="bi bi-sliders"></i> Filter`;
    }

    /* ============================================== */
    /* VIEW PROFILE MODAL                             */
    /* ============================================== */
    const vpOverlay          = document.getElementById('viewProfileOverlay');
    const vpPhoto            = document.getElementById('vpPhoto');
    const vpPhotoPlaceholder = document.getElementById('vpPhotoPlaceholder');
    const vpName             = document.getElementById('vpName');
    const vpPosition         = document.getElementById('vpPosition');

    document.getElementById('closeViewProfile').addEventListener('click', () => vpOverlay.classList.remove('active'));
    vpOverlay.addEventListener('click', e => { if (e.target === vpOverlay) vpOverlay.classList.remove('active'); });

    /* ============================================== */
    /* ADD / EDIT BOARD MODAL                         */
    /* ============================================== */
    const overlay      = document.getElementById('addBoardOverlay');
    const modalTitle   = document.getElementById('modalTitle');
    const openBtn      = document.getElementById('openAddBoard');
    const closeBtn     = document.getElementById('closeAddBoard');
    const clearBtn     = document.getElementById('clearFormBtn');
    const confirmBtn   = document.getElementById('confirmBtn');
    const positionBtn  = document.getElementById('positionBtn');
    const positionDrop = document.getElementById('positionDropdown');
    const positionLbl  = document.getElementById('positionLabel');
    const statusBtn    = document.getElementById('statusBtn');
    const statusDrop   = document.getElementById('statusDropdown');
    const statusLbl    = document.getElementById('statusLabel');
    const photoAddBtn  = document.getElementById('photoAddBtn');
    const photoInput   = document.getElementById('photoInput');
    const previewImg   = document.getElementById('previewImg');
    const defaultIcon  = document.getElementById('defaultIcon');

    let selectedPosition = '';
    let selectedStatus   = 'Active';
    let isEditMode       = false;

    /* Reset form to blank state */
    function resetForm() {
        document.getElementById('lastName').value  = '';
        document.getElementById('firstName').value = '';
        document.querySelectorAll('input[name="gender"]').forEach(r => r.checked = false);

        document.querySelectorAll('.position-option').forEach(o => o.classList.remove('selected'));
        selectedPosition = '';
        positionLbl.textContent = 'Position';
        positionBtn.classList.remove('has-value', 'open');
        positionDrop.classList.remove('open');

        document.querySelectorAll('.status-option').forEach(o => o.classList.remove('selected'));
        const activeOpt = statusDrop.querySelector('[data-value="Active"]');
        if (activeOpt) activeOpt.classList.add('selected');
        selectedStatus = 'Active';
        statusLbl.textContent = 'Active';
        statusBtn.classList.add('has-value');
        statusBtn.classList.remove('open');
        statusDrop.classList.remove('open');

        previewImg.style.display = 'none';
        previewImg.src = '';
        defaultIcon.style.display = '';
        photoInput.value = '';
    }

    /* Open modal in add or edit mode */
    function openModal(mode, card) {
        isEditMode = (mode === 'edit');
        modalTitle.textContent = isEditMode ? 'Edit Board' : 'Add Board';
        resetForm();

        if (isEditMode && card) {
            const fn = card.dataset.firstname || '';
            const ln = card.dataset.lastname  || '';            
            const gn = card.dataset.gender    || '';
            const pos = card.dataset.position || '';
            const st  = card.dataset.status   || '';
            const ph  = card.dataset.photo    || '';

            document.getElementById('firstName').value = fn;
            document.getElementById('lastName').value  = ln;

            const gInput = document.querySelector(`input[name="gender"][value="${gn}"]`);
            if (gInput) gInput.checked = true;

            if (ph) {
                previewImg.src = ph;
                previewImg.style.display = 'block';
                defaultIcon.style.display = 'none';
            }

            const pOpt = positionDrop.querySelector(`.position-option[data-value="${pos}"]`);
            if (pOpt) pickPosition(pos, pOpt);

            const sOpt = statusDrop.querySelector(`.status-option[data-value="${st}"]`);
            if (sOpt) pickStatus(st, sOpt);
        }

        overlay.classList.add('active');
    }

    /* ADD button */
    openBtn.addEventListener('click', () => openModal('add'));

    /* Close */
    closeBtn.addEventListener('click', () => overlay.classList.remove('active'));
    overlay.addEventListener('click', e => { if (e.target === overlay) overlay.classList.remove('active'); });

    /* Clear form */
    clearBtn.addEventListener('click', resetForm);

    /* Confirm — wire your POST / PATCH call here */
    confirmBtn.addEventListener('click', () => {
        /* TODO: submit form data to your backend */
        overlay.classList.remove('active');
        loadTrustees(); /* refresh grid after save */
    });

    /* Photo upload */
    photoAddBtn.addEventListener('click', () => photoInput.click());
    photoInput.addEventListener('change', () => {
        const file = photoInput.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            previewImg.style.display = 'block';
            defaultIcon.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    /* Position dropdown */
    positionBtn.addEventListener('click', e => {
        e.stopPropagation();
        positionBtn.classList.toggle('open');
        positionDrop.classList.toggle('open');
        statusBtn.classList.remove('open');
        statusDrop.classList.remove('open');
    });

    function pickPosition(value, el) {
        document.querySelectorAll('.position-option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        selectedPosition = value;
        positionLbl.textContent = value;
        positionBtn.classList.add('has-value');
        positionBtn.classList.remove('open');
        positionDrop.classList.remove('open');
    }

    /* Status dropdown */
    statusBtn.addEventListener('click', e => {
        e.stopPropagation();
        statusBtn.classList.toggle('open');
        statusDrop.classList.toggle('open');
        positionBtn.classList.remove('open');
        positionDrop.classList.remove('open');
    });

    function pickStatus(value, el) {
        document.querySelectorAll('.status-option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        selectedStatus = value;
        statusLbl.textContent = value;
        statusBtn.classList.add('has-value');
        statusBtn.classList.remove('open');
        statusDrop.classList.remove('open');
    }

    document.querySelectorAll('.status-option').forEach(opt => {
        opt.addEventListener('click', () => pickStatus(opt.dataset.value, opt));
    });

    /* Close dropdowns on outside click */
    document.addEventListener('click', e => {
        if (!positionBtn.contains(e.target) && !positionDrop.contains(e.target)) {
            positionBtn.classList.remove('open');
            positionDrop.classList.remove('open');
        }
        if (!statusBtn.contains(e.target) && !statusDrop.contains(e.target)) {
            statusBtn.classList.remove('open');
            statusDrop.classList.remove('open');
        }
    });

    /* ============================================== */
    /* ADD POSITION MODAL                             */
    /* ============================================== */
    const addPosOverlay  = document.getElementById('addPosOverlay');
    const openAddPosBtn  = document.getElementById('openAddPosition');
    const closePosBtn    = document.getElementById('closePosModal');
    const positionInput  = document.getElementById('positionInput');
    const clearPosBtn    = document.getElementById('clearPosBtn');
    const confirmPosBtn  = document.getElementById('confirmPosBtn');

    openAddPosBtn.addEventListener('click', () => {
        positionDrop.classList.remove('open');
        positionBtn.classList.remove('open');
        positionInput.value = '';
        positionInput.classList.remove('error');
        addPosOverlay.classList.add('active');
    });

    closePosBtn.addEventListener('click', () => addPosOverlay.classList.remove('active'));
    addPosOverlay.addEventListener('click', e => { if (e.target === addPosOverlay) addPosOverlay.classList.remove('active'); });
    clearPosBtn.addEventListener('click', () => { positionInput.value = ''; positionInput.classList.remove('error'); });

    confirmPosBtn.addEventListener('click', () => {
        const val = positionInput.value.trim();
        if (!val) { positionInput.classList.add('error'); return; }
        positionInput.classList.remove('error');

        /* TODO: optionally POST new position to your backend */

        /* Add option to the dropdown immediately */
        const opt = document.createElement('div');
        opt.className    = 'position-option';
        opt.dataset.value = val;
        opt.textContent  = val;
        opt.addEventListener('click', () => pickPosition(val, opt));
        positionDrop.insertBefore(opt, openAddPosBtn);

        /* Also add a filter chip */
        const chip = document.createElement('button');
        chip.className      = 'filter-chip';
        chip.dataset.filter = 'position';
        chip.dataset.value  = val;
        chip.textContent    = val;
        chip.addEventListener('click', onChipClick);
        document.getElementById('positionChips').appendChild(chip);

        addPosOverlay.classList.remove('active');
        pickPosition(val, opt);
    });

})();
</script>

@endsection