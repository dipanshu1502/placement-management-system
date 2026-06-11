<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }

        .register-card {
            width: 100%;
            max-width: 500px;
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

        .btn-register {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            color: white;
        }

        .btn-register:hover {
            opacity: .9;
            color: white;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            text-decoration: none;
            font-weight: 600;
        }
    </style>

</head>

<body>

    <div class="register-card">

        <div class="logo">
            🎓
        </div>

        <h2 class="title">
            Student Registration
        </h2>

        <p class="subtitle">
            Create your Placement Management System account
        </p>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('save-register') ?>" method="post">

            <div class="mb-3">

                <label class="form-label">
                    Full Name
                </label>

                <input type="text"
                    name="name"
                    class="form-control"
                    placeholder="Enter your full name"
                    value="<?= old('name') ?>"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Email Address
                </label>

                <input type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                    value="<?= old('email') ?>"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Password
                </label>

                <input type="password"
                    name="password"
                    class="form-control"
                    placeholder="Create a password"
                    required>

            </div>

            <div class="d-grid">

                <button type="submit" class="btn btn-register">
                    Create Account
                </button>

            </div>

        </form>

        <div class="login-link">

            Already have an account?

            <a href="<?= base_url('login') ?>">
                Login
            </a>

        </div>

    </div>

</body>

</html>