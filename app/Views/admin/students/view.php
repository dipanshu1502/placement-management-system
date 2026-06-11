<?php $student = $student ?? []; ?>
<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center">

        <div>
            <h2>Student Profile</h2>
            <p class="text-muted mb-0">
                Complete student information
            </p>
        </div>

        <a href="<?= base_url('admin/students') ?>"
            class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Student Name</th>
                    <td><?= esc($student['name']) ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?= esc($student['email']) ?></td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td><?= esc($student['department_name']) ?></td>
                </tr>

                <tr>
                    <th>Roll Number</th>
                    <td><?= esc($student['roll_no']) ?></td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td><?= esc($student['phone']) ?></td>
                </tr>

                <tr>
                    <th>CGPA</th>
                    <td><?= esc($student['cgpa']) ?></td>
                </tr>

                <tr>
                    <th>Backlogs</th>
                    <td><?= esc($student['backlogs']) ?></td>
                </tr>

                <tr>
                    <th>Passing Year</th>
                    <td><?= esc($student['passing_year']) ?></td>
                </tr>

                <tr>
                    <th>User ID</th>
                    <td><?= esc($student['user_id']) ?></td>
                </tr>

                <tr>
                    <th>Profile Created</th>
                    <td><?= esc($student['created_at']) ?></td>
                </tr>

            </table>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>