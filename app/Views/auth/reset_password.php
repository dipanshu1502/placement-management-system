<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - PMS</title>

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
            box-shadow: 0 20px 40px rgba(0,0,0,.15);
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
        Reset Password
    </h3>

    <p class="subtitle">
        Enter your new password
    </p>

    <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('update-password') ?>" method="post">

        <?= csrf_field() ?>

        <input type="hidden"
               name="token"
               value="<?= esc($token) ?>">

        <div class="mb-3">

            <label class="form-label">
                New Password
            </label>

            <input type="password"
                   name="password"
                   class="form-control"
                   required>

        </div>

        <div class="d-grid">

            <button type="submit"
                    class="btn btn-primary btn-submit">

                Update Password

            </button>

        </div>

    </form>

</div>

</body>
</html>