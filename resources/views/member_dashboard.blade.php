<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>

    @include('partials.api-config')
    
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-red: #be1e38;
            --dark-bg: #222431;
            --card-bg: #2b2d3c; 
            --text-grey: #a0aec0;
            --text-white: #ffffff;
            --border-color: #4a4d61;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-white);
        }

        /* --- TOPBAR --- */
        .topbar {
            background-color: var(--card-bg);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .logout-btn {
            background: transparent;
            border: 1px solid var(--primary-red);
            color: var(--primary-red);
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        .logout-btn:hover { background: var(--primary-red); color: white; }

        /* --- CONTAINER --- */
        .container {
            max-width: 800px;
            margin: 60px auto;
            padding: 40px;
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            text-align: center;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            margin-bottom: 10px;
        }

        p {
            color: var(--text-grey);
        }
    </style>
</head>
<body>

    <nav class="topbar">
        <div class="brand">
            <img src="{{ asset('images/PCCI-Logo.svg') }}" style="height: 30px;" alt="Logo" onerror="this.style.display='none'">
            PCCI Member
        </div>
        <button onclick="logout()" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </nav>

    <div class="container">
        <h1>Welcome, <span id="member-name-display" style="color: #28a745;">Member</span>!</h1>
        <p>This is your member dashboard test page.</p>
    </div>

    <script>
        // 1. Check if user is logged in
        const token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/login';
        }

        // 2. Retrieve the user's name from localStorage and display it
        const userName = localStorage.getItem('userName');
        if (userName) {
            document.getElementById('member-name-display').textContent = userName;
        }

        // 3. Logout function
        function logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('userName'); // Clear the name as well
            window.location.href = '/login';
        }
    </script>
    
</body>
</html>