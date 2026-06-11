<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
        }

        .logo {
            text-align: center;
            font-size: 60px;
            margin-bottom: 10px;
        }

        .title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-login {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
        }

        .btn-login:hover {
            opacity: .9;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            text-decoration: none;
            font-weight: 600;
        }
    </style>

</head>

<body>

    <div class="login-card">

        <div class="logo">
            🎓
        </div>

        <h2 class="title">
            Placement Management System
        </h2>

        <p class="subtitle">
            Login to continue
        </p>

        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>

        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>

        <?php endif; ?>

        <form action="<?= base_url('check-login') ?>" method="post">

            <div class="mb-3">

                <label class="form-label">
                    Email Address
                </label>

                <input type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Password
                </label>

                <input type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter your password"
                    required>

            </div>
            <div class="text-end mb-3">

                <a href="<?= base_url('forgot-password') ?>"
                    class="text-decoration-none">

                    Forgot Password?

                </a>

            </div>

            <div class="d-grid">

                <button type="submit" class="btn btn-primary btn-login">
                    Login
                </button>

            </div>

        </form>

        <div class="register-link">

            Don't have an account?

            <a href="<?= base_url('register') ?>">
                Register
            </a>

        </div>

    </div>

</body>

</html>