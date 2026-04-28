<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login — Malaysian Forestry Conference 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="icon" href="{{ asset('images/logo-icon.png')}}">
    <style>
        .login-wrapper {
            min-height: 100svh;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                linear-gradient(160deg, rgba(8,20,12,.88) 0%, rgba(26,58,42,.82) 60%, rgba(45,90,61,.60) 100%),
                url('{{ asset('images/niah-caves.webp') }}') center / cover no-repeat;
            background-color: #0e2018;
            padding: 40px 20px;
        }

        .login-card {
            background: rgba(247, 243, 236, 0.97);
            border-radius: 20px;
            box-shadow: 0 8px 48px rgba(26, 58, 42, 0.28);
            padding: 48px 44px;
            width: 100%;
            max-width: 420px;
        }

        .login-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 32px;
            gap: 10px;
        }

        .login-logo img {
            height: 64px;
            width: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--fern);
        }

        .login-logo h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: var(--forest);
            text-align: center;
            line-height: 1.3;
        }

        .login-logo p {
            font-size: 12px;
            color: var(--text-soft);
            text-align: center;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .login-divider {
            height: 1px;
            background: rgba(26,58,42,0.12);
            margin-bottom: 28px;
        }

        .login-field {
            margin-bottom: 18px;
        }

        .login-field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--forest);
            margin-bottom: 6px;
            letter-spacing: 0.02em;
        }

        .login-field input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid rgba(26,58,42,0.2);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text);
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        .login-field input:focus {
            border-color: var(--moss);
            box-shadow: 0 0 0 3px rgba(74,124,89,0.15);
        }

        .login-error {
            font-size: 12px;
            color: #c0392b;
            margin-top: 5px;
        }

        .login-remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .login-remember input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--moss);
            cursor: pointer;
        }

        .login-remember label {
            font-size: 13px;
            color: var(--text-soft);
            cursor: pointer;
        }

        .login-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .login-forgot {
            font-size: 13px;
            text-decoration: none;
            transition: color .18s;
        }

        .login-forgot a{
            color: var(--moss);
        }

        .login-forgot:hover {
            color: var(--forest);
            text-decoration: underline;
        }

        .login-btn {
            background: var(--forest);
            color: #fff;
            border: none;
            padding: 11px 28px;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .15s;
            letter-spacing: 0.03em;
        }

        .login-btn:hover {
            background: var(--canopy);
            transform: translateY(-1px);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-status {
            background: rgba(74,124,89,0.12);
            border: 1px solid var(--fern);
            color: var(--forest);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    
    <div class="login-card">
        

        <div class="login-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'" />
            <h1>Malaysian Forestry<br>Conference 2026</h1>
            <p>Admin Access</p>
        </div>

        <div class="login-divider"></div>

        @if (session('status'))
            <div class="login-status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-field">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                @error('email')
                    <p class="login-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="login-field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" />
                @error('password')
                    <p class="login-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="login-remember">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label>
            </div>

            <div class="login-actions">
                <div class="login-forgot">
                    <a href="/">← Back</a>
                </div>
                <button type="submit" class="login-btn">Log In</button>
            </div>

        </form>
        

    </div>
</div>

</body>
</html>