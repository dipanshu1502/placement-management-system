<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="main">

    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h4>Student Resumes</h4>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Department</th>
                            <th>Roll Number</th>
                            <th>Resume</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if(!empty($resumes)): ?>
                            <?php $i = 1; ?>

                            <?php foreach($resumes as $resume): ?>

                                <tr>
                                    <td><?= $i++ ?></td>

                                    <td><?= esc($resume['name']) ?></td>

                                    <td>
                                        <?= esc($resume['department_name'] ?? '-') ?>
                                    </td>

                                    <td>
                                        <?= esc($resume['roll_number']) ?>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('uploads/resumes/' . $resume['resume_file']) ?>"
                                           target="_blank"
                                           class="btn btn-sm btn-success">
                                            View Resume
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="5" class="text-center">
                                    No resumes found.
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