<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center">

        <div>
            <h2>Students Management</h2>
            <p class="text-muted mb-0">
                View all registered student profiles
            </p>
        </div>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Roll No</th>
                            <th>CGPA</th>
                            <th>Passing Year</th>
                            <th width="120">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($students)) : ?>

                            <?php foreach ($students as $student) : ?>

                                <tr>

                                    <td><?= $student['id'] ?></td>

                                    <td><?= esc($student['name']) ?></td>

                                    <td><?= esc($student['email']) ?></td>

                                    <td>
                                        <?= esc($student['department_name']) ?>
                                    </td>

                                    <td>
                                        <?= esc($student['roll_no']) ?>
                                    </td>

                                    <td>
                                        <?= esc($student['cgpa']) ?>
                                    </td>

                                    <td>
                                        <?= esc($student['passing_year']) ?>
                                    </td>

                                    <td>

                                        <a href="<?= base_url('admin/students/view/' . $student['id']) ?>"
                                            class="btn btn-info btn-sm">
                                            View
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="8" class="text-center">
                                    No Students Found
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