<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PCCI Valenzuela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        }
        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .brand-logo { width: 80px; margin-bottom: 1.5rem; }
        h1 { font-family: 'Poppins', sans-serif; font-size: 1.75rem; color: #1a1a2e; margin-bottom: 0.5rem; }
        p.subtitle { color: #6b7280; font-size: 0.9rem; margin-bottom: 2rem; }
        
        .form-group { text-align: left; margin-bottom: 1.2rem; }
        label { display: block; font-size: 0.85rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem; }
        input {
            width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 10px;
            font-size: 0.95rem; box-sizing: border-box; outline: none; transition: border 0.3s;
        }
        input:focus { border-color: #A40033; }
        
        .btn-login {
            width: 100%; background-color: #A40033; color: white; padding: 0.85rem;
            border: none; border-radius: 10px; font-weight: 600; cursor: pointer;
            transition: background 0.3s; margin-top: 1rem;
        }
        .btn-login:hover { background-color: #8a002b; }     
        .links { margin-top: 1.5rem; font-size: 0.9rem; color: #6b7280; }
        .links a { color: #A40033; text-decoration: none; font-weight: 600; }
        .links a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="btn btn-outline-dark">
    <i class="bi bi-arrow-left"></i> Home
</a>
    <div class="login-card">
        <img src="{{ asset('images/PCCI-Logo.svg') }}" alt="Logo" class="brand-logo">
        <h1>Welcome Back</h1>
        <p class="subtitle">Sign in to access your dashboard</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="member@pcci.org">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">Sign In</button>
            <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>


        </form>
</body>
</html>