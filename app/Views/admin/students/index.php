<?= $this->include('layout/header') ?>
<?php

if(session()->get('role') == 'super_admin'){

    echo view('super_admin/layout/sidebar');

}else{

    echo view('admin/layout/sidebar');

}

?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2>Students Management</h2>
            <p class="text-muted mb-0">
                View all registered students
            </p>
        </div>
    </div>

    <br>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow">

        <div class="card-body">

            <form method="get" class="row g-2 mb-3">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search Student Name..."
                        value="<?= esc($search ?? '') ?>">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">

                        <option value="all" <?= ($status == 'all') ? 'selected' : '' ?>>
                            All Students
                        </option>

                        <option value="complete" <?= ($status == 'complete') ? 'selected' : '' ?>>
                            Complete Profile
                        </option>

                        <option value="incomplete" <?= ($status == 'incomplete') ? 'selected' : '' ?>>
                            Incomplete Profile
                        </option>

                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        Search
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="<?= base_url('admin/students') ?>" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Roll No</th>
                            <th>CGPA</th>
                            <th>Passing Year</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($students)): ?>

                            <?php foreach ($students as $student): ?>

                                <?php $isComplete = !empty($student['student_id']); ?>

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
                                        <?= !empty($student['cgpa']) ? esc($student['cgpa']) : '-' ?>
                                    </td>

                                    <td>
                                        <?= !empty($student['passing_year']) ? esc($student['passing_year']) : '-' ?>
                                    </td>

                                    <td>

                                        <?php if ($isComplete): ?>

                                            <span class="badge bg-success">
                                                Complete
                                            </span>

                                        <?php else: ?>

                                            <span class="badge bg-warning text-dark">
                                                Incomplete
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if ($isComplete): ?>

                                            <a href="<?= base_url('admin/students/view/' . $student['student_id']) ?>"
                                                class="btn btn-info btn-sm mb-1">
                                                View
                                            </a>

                                        <?php endif; ?>

                                        <a href="<?= base_url('admin/students/delete/' . ($isComplete ? $student['student_id'] : $student['user_id'])) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to permanently delete this student account? This action cannot be undone.');">
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="9" class="text-center">
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

<?= $this->include('layout/footer') ?>