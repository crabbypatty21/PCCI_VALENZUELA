
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
            /* Removed background, border-radius, and blur */
            z-index: 10;
        }

        @media (max-width: 900px) {
            .login-container { flex-direction: column; }
            .login-image-side { height: 250px; order: -1; }
            .nav-links { display: none; }
        }

        /* ADD THIS: Override Footer Background to Red */
    .footer {
        background-color: #A40033 !important; /* PCCI Red */
    }

    /* Adjust hover colors so they are visible on the red background */
    .footer a:hover {
        color: #ffffff !important;
        text-decoration: underline;
    }
    
    /* Adjust the logo box background so it doesn't blend in */
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

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="input-group">
                        <label>Email</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="@gmail.com" autofocus>
                        </div>
                        @error('email')
                            <span style="color: #ff6b6b; font-size: 0.8rem; margin-top: 5px; display:block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock"></i>
                            <input type="password" name="password" required placeholder="Enter your password">
                        </div>
                        @error('password')
                            <span style="color: #ff6b6b; font-size: 0.8rem; margin-top: 5px; display:block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember for 30 Days
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password</a>
                        @else
                            <a href="#">Forgot password</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit">Sign In</button>
                    
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

</body>
</html>
