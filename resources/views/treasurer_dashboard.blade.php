<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasurer Dashboard</title>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #222431;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .dashboard-card {
            background-color: #2b2d3c;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #be1e38;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="dashboard-card">
        <h1 id="welcome-message">Loading...</h1>
        <p>Treasurer Financial Module</p>
        <button onclick="logout()">Logout</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", fetchUserData);

        async function fetchUserData() {
            const token = localStorage.getItem('token');
            
            // If there's no token, boot them back to login immediately
            if (!token) {
                window.location.href = '/login';
                return;
            }

            try {
                const response = await fetch('https://pcci-laravel-api.onrender.com/api/user', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (response.status === 401) {
                    // Token is invalid or expired
                    localStorage.removeItem('token');
                    window.location.href = '/login';
                    return;
                }

                const data = await response.json();
                
                // Double check they are actually a treasurer
                if (!data.data.roles.includes('treasurer')) {
                    alert('Access Denied: You are not a treasurer.');
                    window.location.href = '/login';
                    return;
                }

                // Success! Update the UI
                document.getElementById('welcome-message').textContent = `Welcome, Treasurer ${data.data.name}`;

            } catch (error) {
                console.error("Error fetching user data:", error);
                document.getElementById('welcome-message').textContent = "Error loading user data.";
            }
        }

        async function logout() {
            const token = localStorage.getItem('token');
            if(token) {
                // Optional: Call the backend logout API to invalidate the token
                await fetch('https://pcci-laravel-api.onrender.com/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
            }
            
            // Clear local storage and redirect
            localStorage.removeItem('token');
            window.location.href = '/login';
        }
    </script>
</body>
</html>