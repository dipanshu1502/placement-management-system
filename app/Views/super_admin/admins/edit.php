<?= $this->include('layout/header') ?>
<?= $this->include('super_admin/layout/sidebar') ?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>✏️ Edit Admin</h2>

            <p class="text-muted mb-0">
                Update administrator details.
            </p>

        </div>

        <a href="<?= base_url('super-admin/admins') ?>" class="btn btn-secondary">
            ← Back
        </a>

    </div>

    <!-- Error Message -->
    <?php if (session()->getFlashdata('error')) : ?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <?= session()->getFlashdata('error') ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>

    <!-- Validation Errors -->
    <?php if (session()->getFlashdata('errors')) : ?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <ul class="mb-0">

                <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                    <li><?= esc($error) ?></li>

                <?php endforeach; ?>

            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>

    <div class="card shadow">

        <div class="card-body">

            <form action="<?= base_url('super-admin/admins/update/' . $admin['id']) ?>" method="post">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="<?= old('name', $admin['name']) ?>"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?= old('email', $admin['email']) ?>"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control">

                        <small class="text-muted">
                            Leave blank to keep the current password.
                        </small>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="confirm_password"
                            class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="active"
                                <?= old('status', $admin['status']) == 'active' ? 'selected' : '' ?>>

                                Active

                            </option>

                            <option value="inactive"
                                <?= old('status', $admin['status']) == 'inactive' ? 'selected' : '' ?>>

                                Inactive

                            </option>

                        </select>

                    </div>

                </div>

                <hr>

                <button
                    type="submit"
                    class="btn btn-primary">

                    💾 Update Admin

                </button>

                <a
                    href="<?= base_url('super-admin/admins') ?>"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

<?= $this->include('layout/footer') ?>