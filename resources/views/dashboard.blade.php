@extends('layouts.admin')

@section('title', 'Dashboard - PCCI')

@section('content')
    <div class="dashboard-header">
        Dashboard
    </div>

    <div class="stats-container">
        {{-- Members Card --}}
        <div class="stat-card">
            <div class="title">Members</div>
            <div class="value">
                <i class="bi bi-person-fill"></i> <span>4</span>
            </div>
        </div>

        {{-- Applicants Card --}}
        <div class="stat-card">
            <div class="title">Applicants</div>
            <div class="value">
                <i class="bi bi-person-fill"></i> <span>6</span>
            </div>
        </div>
    </div>
@endsection