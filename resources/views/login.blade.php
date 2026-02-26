<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PCCI Valenzuela</title>
    
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-red: #be1e38;
            --dark-bg: #222431;
            --card-bg: #2b2d3c; 
            --input-bg: #323545;
            --text-grey: #a0aec0;
            --text-white: #ffffff;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-white);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- MAIN --- */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: var(--card-bg);
            display: flex;
            overflow: hidden;
            border-radius: 20px;
            border: 1px solid rgba(155, 152, 152, 0.63);
            box-shadow: 0px 6px 14.7px rgba(108, 120, 175, 0.47);
        }

        /* LEFT SIDE (FORM) */
        .login-form-side {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(69, 70, 123, 0.58);
            z-index: 2;
        }

        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; }

        .input-wrapper { position: relative; }
        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #d6304d;
            font-size: 1.2rem;
        }

        .input-wrapper input {
            width: 100%;
            padding: 15px 15px 15px 50px;
            background-color: var(--input-bg);
            border: 1px solid #4a4d61;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            outline: none;
            transition: border 0.3s;
        }

        .input-wrapper input:focus { border-color: var(--primary-red); }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 0.9rem;
            color: var(--text-grey);
        }
        .form-options a { color: var(--text-grey); text-decoration: underline; }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-red);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-submit:hover { background-color: #900f24; }
        
        .btn-submit:disabled {
            background-color: #555;
            cursor: not-allowed;
        }

        /* RIGHT SIDE (IMAGE) */
        .login-image-side {
            flex: 1;
            position: relative;
            background-color: #000;
        }
        .login-image-side img.bg-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.7;
        }

        /* UPDATED IMAGE OVERLAY */
        .image-overlay {
            position: absolute;
            top: 25px;
            left: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 10;
        }
        
        /* API Error Message Style */
        #api-error {
            color: #ff6b6b;
            background-color: rgba(255, 107, 107, 0.1);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-align: center;
            display: none; /* Hidden by default */
        }

        @media (max-width: 900px) {
            .login-container { flex-direction: column; }
            .login-image-side { height: 250px; order: -1; }
            .nav-links { display: none; }
        }

        .footer {
            background-color: #A40033 !important;
        }

        .footer a:hover {
            color: #ffffff !important;
            text-decoration: underline;
        }
        
        .footer .rounded {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

    </style>
</head>
<body>

    <main>
        <div class="login-container">
            <div class="login-form-side">
                <div class="form-header">
                    <h1>Sign in</h1>
                    <p>Welcome back! Please enter your details</p>
                </div>

                <div id="api-error"></div>

                <form id="loginForm" onsubmit="handleLogin(event)">
                    @csrf
                    
                    <div class="input-group">
                        <label>Email</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email" id="email" name="email" required placeholder="@gmail.com" autofocus>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock"></i>
                            <input type="password" id="password" name="password" required placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="form-options">
                        <label>
                            <input type="checkbox" name="remember"> Remember for 30 Days
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password</a>
                        @else
                            <a href="#">Forgot password</a>
                        @endif
                    </div>

                    <button type="submit" id="submitBtn" class="btn-submit">Sign In</button>
                    
                    <p style="text-align: center; margin-top: 20px; font-size: 0.9rem; color: var(--text-grey);">
                        Don't have an account? <a href="{{ route('signup') }}" style="color: white; font-weight: bold;">Sign Up</a>
                    </p>
                </form>
            </div>

            <div class="login-image-side">
                <div class="image-overlay">
                    <img src="{{ asset('images/PCCI-Logo.svg') }}" style="height: 35px;" alt="Logo">
                    <div style="color: white; line-height: 1.2;">
                        <strong style="font-family: 'Poppins', sans-serif; font-size: 1.1rem;">PCCI - Valenzuela</strong><br>
                        <span style="font-size: 0.8rem;">Philippine Chamber of Commerce and Industry</span>
                    </div>
                </div>
                
                <img src="{{ asset('images/log in.png') }}" alt="Background" class="bg-img">
            </div>
        </div>
    </main>

    <script>
        async function handleLogin(event) {
            event.preventDefault(); // Prevent standard form submission

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorDiv = document.getElementById('api-error');
            const submitBtn = document.getElementById('submitBtn');

            // Reset UI
            errorDiv.style.display = 'none';
            errorDiv.textContent = '';
            submitBtn.disabled = true;
            submitBtn.textContent = 'Signing In...';

            try {
                // Using the API endpoint provided in your sample
                const response = await fetch('https://pcci-laravel-api.onrender.com/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {
                    // 1. Store the token
                    localStorage.setItem('token', data.token);

                    // 2. Check the user's role and redirect accordingly
                    const roles = data.user.roles || [];

                    if (roles.includes('treasurer')) {
                        window.location.href = '/treasurer-dashboard'; // Redirect to the new treasurer route
                    } else if (roles.includes('superadmin')) {
                        window.location.href = '/dashboard'; // Existing superadmin route
                    } else {
                        window.location.href = '/home'; // Fallback for normal users
                    }
                } else {
                    // Show error message
                    errorDiv.textContent = data.message || 'Login failed. Check credentials.';
                    errorDiv.style.display = 'block';
                }
            } catch (err) {
                console.error(err);
                errorDiv.textContent = 'An error occurred. Please check your connection.';
                errorDiv.style.display = 'block';
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Sign In';
            }
        }
    </script>
</body>
</html>