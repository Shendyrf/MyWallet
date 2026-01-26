<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0f0f0f;
            color: #eaeaea;
        }

        .login-card {
            background-color: #ffffff;
            color: #111;
            border-radius: 8px;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #000;
        }

        .btn-dark {
            border-radius: 6px;
            background-color: #000;
            border: none;
        }

        .btn-dark:hover {
            background-color: #222;
        }

        .login-title {
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="login-card shadow p-4" style="width: 400px;">

        <h4 class="text-center fw-semibold mb-4 login-title">
            LOGIN
        </h4>

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="alert alert-dark text-center py-2">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required
                >
            </div>

            <button class="btn btn-dark w-100 py-2">
                Login
            </button>
        </form>

    </div>
</div>

</body>
</html>
