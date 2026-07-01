<?= $this->include('layout/header') ?>
<?= $this->include('super_admin/layout/sidebar') ?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>👨‍💼 Admin Management</h2>
            <p class="text-muted mb-0">
                Manage all system administrators.
            </p>
        </div>

        <a href="<?= base_url('super-admin/admins/create') ?>" class="btn btn-primary">

            ➕ Add Admin

        </a>

    </div>

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

    <div class="card shadow-sm">

        <div class="card-body">

            <form method="get" action="<?= current_url() ?>" class="row mb-4">

                <div class="col-md-4">

                    <input type="text" name="search" class="form-control" placeholder="Search by name or email..."
                        value="<?= esc($_GET['search'] ?? '') ?>">

                </div>

                <div class="col-md-2">

                    <button type="submit" class="btn btn-primary w-100">

                        🔍 Search

                    </button>

                </div>

                <div class="col-md-2">

                    <a href="<?= base_url('super-admin/admins') ?>" class="btn btn-secondary w-100">

                        🔄 Show All

                    </a>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">ID</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th width="120">Status</th>

                            <th width="180">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($admins)): ?>

                            <?php foreach ($admins as $admin): ?>

                                <tr>

                                    <td>

                                        <?= $admin['id'] ?>

                                    </td>

                                    <td>

                                        <?= esc($admin['name']) ?>

                                    </td>

                                    <td>

                                        <?= esc($admin['email']) ?>

                                    </td>

                                    <td>

                                        <?php if ($admin['status'] == 'active'): ?>

                                            <span class="badge bg-success">

                                                Active

                                            </span>

                                        <?php else: ?>

                                            <span class="badge bg-danger">

                                                Inactive

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <a href="<?= base_url('super-admin/admins/edit/' . $admin['id']) ?>"
                                            class="btn btn-warning btn-sm">

                                            Edit

                                        </a>

                                        <a href="<?= base_url('super-admin/admins/toggle-status/' . $admin['id']) ?>"
                                            class="btn btn-secondary btn-sm">

                                            <?= $admin['status'] == 'active'
                                                ? 'Deactivate'
                                                : 'Activate' ?>

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="5" class="text-center">

                                    No Admin Found.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>



        </div>

    </div>

</div>

<?= $this->include('layout/footer') ?>