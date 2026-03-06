<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PCCI Admin')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --pcci-red: #be1e38;
            --pcci-light-red: #e35d5d;
            --sidebar-width: 280px;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #fff;
        }

        /* ============================================== */
        /* SIDEBAR                                        */
        /* ============================================== */

        .sidebar {
            width: var(--sidebar-width);
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
            flex-shrink: 0;
        }

        .admin-profile {
            padding: 0 25px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: 2px solid var(--pcci-red);
            object-fit: cover;
        }

        .admin-info span { display: block; }
        .role { font-size: 11px; color: #888; text-transform: uppercase; font-weight: 600; }
        .name { font-size: 1.2rem; font-weight: 700; color: var(--pcci-red); }

        .menu-label {
            padding: 25px 25px 10px;
            font-size: 11px;
            font-weight: 700;
            color: #999;
            text-transform: uppercase;
        }

        /* --- Nav Links --- */
        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 0.95rem;
            gap: 12px;
            transition: 0.2s;
        }

        .nav-link.active {
            background-color: var(--pcci-red);
            color: white;
        }

        .nav-link:hover:not(.active) {
            background-color: #fff1f3;
            color: var(--pcci-red);
        }

        /* --- Content Dropdown --- */
        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-toggle {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 0.95rem;
            gap: 12px;
            transition: 0.2s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .nav-dropdown-toggle.active {
            background-color: var(--pcci-red);
            color: white;
        }

        .nav-dropdown-toggle:hover:not(.active) {
            background-color: #fff1f3;
            color: var(--pcci-red);
        }

        .nav-dropdown-toggle .chevron {
            margin-left: auto;
            font-size: 0.75rem;
            transition: transform 0.3s ease;
        }

        .nav-dropdown-toggle.open .chevron {
            transform: rotate(180deg);
        }

        /* Sub-menu */
        .nav-dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
            background: #fafafa;
        }

        .nav-dropdown-menu.open {
            max-height: 300px;
        }

        .nav-dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 10px 25px 10px 62px;
            text-decoration: none;
            color: #555;
            font-weight: 500;
            font-size: 0.88rem;
            gap: 10px;
            transition: 0.2s;
            position: relative;
        }

        .nav-dropdown-menu a::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #ccc;
            position: absolute;
            left: 42px;
            transition: background 0.2s;
        }

        .nav-dropdown-menu a:hover {
            background-color: #fff1f3;
            color: var(--pcci-red);
        }

        .nav-dropdown-menu a:hover::before {
            background: var(--pcci-red);
        }

        .nav-dropdown-menu a.active {
            color: var(--pcci-red);
            font-weight: 700;
            background: #fff1f3;
        }

        .nav-dropdown-menu a.active::before {
            background: var(--pcci-red);
        }

        /* --- Logout --- */
        .logout-box { padding: 20px; margin-top: auto; }
        .btn-logout {
            width: 100%;
            background-color: var(--pcci-light-red);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background-color: var(--pcci-red);
        }

        /* ============================================== */
        /* MAIN CONTENT                                   */
        /* ============================================== */

        .main { flex: 1; overflow-y: auto; padding: 40px; }

        .dashboard-header {
            background-color: var(--pcci-red);
            color: white;
            padding: 25px 35px;
            border-radius: 10px;
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .stats-container { display: flex; gap: 20px; }
        .stat-card {
            flex: 1;
            border: 1px solid var(--pcci-red);
            border-radius: 10px;
            padding: 20px;
            max-width: 250px;
        }

        .stat-card .title { font-weight: 800; text-transform: uppercase; font-size: 0.9rem; }
        .stat-card .value {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            font-size: 1.4rem;
            margin-top: 15px;
            font-weight: 600;
        }
        .stat-card i { color: var(--pcci-red); }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="admin-profile">
            <img src="https://i.pravatar.cc/150?u=maui" class="avatar" alt="Maui">
            <div class="admin-info">
                <span class="role">Admin</span>
                <span class="name">MAUI G.</span>
            </div>
        </div>

        <div class="menu-label">Admin Panel</div>
        <nav>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> DASHBOARD
            </a>
            
            <a href="{{ route('members') }}" class="nav-link {{ request()->routeIs('members') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> MEMBERS
            </a>
            
            <a href="{{ route('applicants') }}" class="nav-link {{ request()->routeIs('applicants') || request()->routeIs('applicant.profile') ? 'active' : '' }}">
                <i class="bi bi-person-fill"></i> APPLICANT
            </a>

            <a href="#" class="nav-link">
                <i class="bi bi-person-gear"></i> ADMIN USERS
            </a>

            {{-- CONTENT DROPDOWN --}}
            <div class="nav-dropdown">
                <button class="nav-dropdown-toggle {{ request()->routeIs('content.*') ? 'active open' : '' }}" id="contentDropdownToggle">
                    <i class="bi bi-collection-play"></i> CONTENT
                    <i class="bi bi-chevron-down chevron"></i>
                </button>
                <div class="nav-dropdown-menu {{ request()->routeIs('content.*') ? 'open' : '' }}" id="contentDropdownMenu">
                    <a href="{{ route('content.trustees') }}" class="{{ request()->routeIs('content.trustees') ? 'active' : '' }}">Board of Trustees</a>
                    <a href="{{ route('content.activities') }}" class="{{ request()->routeIs('content.activities') ? 'active' : '' }}"> PCCI Activities</a>
                    <a href="{{ route('content.event-admin') }}" class="{{ request()->routeIs('content.event-admin') ? 'active' : '' }}">Event</a>
                </div>
            </div>
        </nav>

        <div class="logout-box">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">LOG OUT</button>
            </form>
        </div>
    </aside>

    <main class="main">
        @yield('content')
    </main>

    <script>
        // Content dropdown toggle
        const toggle = document.getElementById('contentDropdownToggle');
        const menu = document.getElementById('contentDropdownMenu');

        toggle.addEventListener('click', function() {
            this.classList.toggle('open');
            menu.classList.toggle('open');
        });
    </script>
</body>
</html>