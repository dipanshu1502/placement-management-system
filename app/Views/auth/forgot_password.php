<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - PMS</title>

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

        .card-box {
            width: 100%;
            max-width: 450px;
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
        }

        .title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #6c757d;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-submit {
            border-radius: 12px;
            padding: 12px;
        }
    </style>

</head>

<body>

    <div class="card-box">

        <h3 class="title">
            Forgot Password
        </h3>

        <p class="subtitle">
            Enter your registered email address
        </p>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('reset_link')) : ?>

            <div class="d-grid mb-3">

                <a href="<?= session()->getFlashdata('reset_link') ?>"
                    class="btn btn-success">

                    Open Reset Password Page

                </a>

            </div>

        <?php endif; ?>

        <form action="<?= base_url('send-reset-link') ?>" method="post">

            <?= csrf_field() ?>

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

            <div class="d-grid">

                <button type="submit"
                    class="btn btn-primary btn-submit">

                    Send Reset Link

                </button>

            </div>

        </form>

        <div class="text-center mt-3">

            <a href="<?= base_url('login') ?>">
                Back to Login
            </a>

        </div>

    </div>

</body>

</html>