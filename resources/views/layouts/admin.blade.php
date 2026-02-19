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

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
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
        }

        /* Main Content */
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
            <a href="#" class="nav-link"><i class="bi bi-people-fill"></i> MEMBERS</a>
            <a href="#" class="nav-link"><i class="bi bi-person-fill"></i> APPLICANT</a>
            <a href="#" class="nav-link"><i class="bi bi-person-gear"></i> ADMIN USERS</a>
            <a href="#" class="nav-link">
                <i class="bi bi-collection-play"></i> CONTENT 
                <i class="bi bi-chevron-down" style="margin-left:auto"></i>
            </a>
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
</body>
</html>