<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
        }

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            max-width: 420px;
            width: 100%;
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.08);
        }

        .register-card input,
        .register-card select {
            border-radius: 8px;
            height: 45px;
        }

        .register-title {
            font-size: 26px;
            color: #333;
            font-weight: bold;
        }

        .register-btn {
            background-color: #fbbd04;
            border: none;
            height: 45px;
            font-weight: bold;
            color: #fff;
            border-radius: 8px;
        }

        .register-btn:hover {
            background-color: #e6aa00;
        }

        .login-link {
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="register-wrapper">
    <div class="register-card">
        <div class="text-center mb-4">
            <h2 class="register-title">Register 📝</h2>
            <p class="text-muted">Create your account</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="mb-4">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="">-- Select Role --</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn register-btn w-100">Register</button>
        </form>

        <div class="text-center mt-3 login-link">
            Already have an account? <a href="/login" class="text-warning">Login</a>
        </div>
    </div>
</div>

</body>
</html>
