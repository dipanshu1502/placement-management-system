<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2>Removed Students</h2>
            <p class="text-muted mb-0">
                View all removed student accounts
            </p>
        </div>

        <a href="<?= base_url('admin/students') ?>" class="btn btn-primary">
            Active Students
        </a>
    </div>

    <br>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-danger">

                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Roll No</th>
                            <th>Removed By</th>
                            <th>Removed At</th>
                            <th width="130">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($students)) : ?>

                            <?php foreach ($students as $student) : ?>

                                <tr>

                                    <td><?= $student['user_id'] ?></td>

                                    <td><?= esc($student['name']) ?></td>

                                    <td><?= esc($student['email']) ?></td>

                                    <td>
                                        <?= !empty($student['department_name']) ? esc($student['department_name']) : '-' ?>
                                    </td>

                                    <td>
                                        <?= !empty($student['roll_no']) ? esc($student['roll_no']) : '-' ?>
                                    </td>

                                    <td>
                                        <?= esc($student['removed_by_name']) ?>
                                    </td>

                                    <td>
                                        <?= date('d M Y h:i A', strtotime($student['removed_at'])) ?>
                                    </td>

                                    <td>

                                        <a href="<?= base_url('admin/restore-student/' . $student['user_id']) ?>"
                                            class="btn btn-success btn-sm"
                                            onclick="return confirm('Restore this student account?');">

                                            Restore

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="8" class="text-center">

                                    No Removed Students Found

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>