<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff & Admin Login - Siya's Kitchen</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #c44d2d;
            --primary-hover: #b03e20;
            --dark: #16151a;
            --bg: #0f0e13;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .login-card {
            background: #1a1921;
            border: 1px solid #2d2b38;
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .login-logo {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--primary), #e67e22);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.5rem;
            color: #ffffff;
            margin-bottom: 1.25rem;
            box-shadow: 0 8px 16px rgba(196, 77, 45, 0.3);
        }

        .login-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }

        .login-subtitle {
            font-size: 0.85rem;
            color: #9ca3af;
            margin-bottom: 2rem;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 0.45rem;
        }

        .form-input {
            width: 100%;
            padding: 0.85rem 1rem;
            background: #111016;
            border: 1px solid #333140;
            border-radius: 8px;
            color: #ffffff;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(196, 77, 45, 0.2);
        }

        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            background-color: var(--primary);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            text-align: left;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            text-align: left;
        }

        .login-hint {
            margin-top: 1.75rem;
            padding-top: 1.25rem;
            border-top: 1px solid #262431;
            font-size: 0.78rem;
            color: #6b7280;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-logo">SK</div>
        <h1 class="login-title">Siya's Kitchen</h1>
        <p class="login-subtitle">Restaurant Management & Kitchen Portal</p>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="password">Management Passcode / Master PIN</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Enter passcode..." required autofocus>
            </div>

            <button type="submit" class="btn-submit">Sign In to Dashboard &rarr;</button>
        </form>

        <div class="login-hint">
            Authorized Siya's Kitchen staff only &bull; London, UK
        </div>
    </div>

</body>
</html>
