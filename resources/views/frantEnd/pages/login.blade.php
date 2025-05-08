<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            max-width: 400px;
            width: 100%;
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .login-card:hover {
            box-shadow: 0 25px 35px rgba(0, 0, 0, 0.1);
        }

        .login-card input {
            border-radius: 8px;
            height: 45px;
        }

        .login-title {
            font-family: 'Dancing Script', cursive;
            font-size: 26px;
            color: #222;
        }

        .login-subtitle {
            font-size: 14px;
            color: #555;
            margin-top: -8px;
            margin-bottom: 20px;
        }

        .login-btn {
            background-color: #fbbd04;
            border: none;
            height: 45px;
            font-weight: bold;
            color: #fff;
            border-radius: 8px;
            transition: 0.3s;
        }

        .login-btn:hover {
            background-color: #e6aa00;
        }

        .register-link {
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="text-center mb-4">
            <h2 class="login-title">Welcome Back 👋</h2>
            <p class="login-subtitle">Login to your account</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="m-0 ps-3" style="font-size: 14px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('loging') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="•••••••" required>
            </div>
            <button type="submit" class="btn login-btn w-100">Login</button>
        </form>

        <div class="text-center mt-3 register-link">
            Don’t have an account? <a href="{{ url('rg') }}" class="text-warning">Register here</a>
        </div>
    </div>
</div>

</body>
</html>
