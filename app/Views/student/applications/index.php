<?= $this->include('student/layout/header') ?>
<?= $this->include('student/layout/sidebar') ?>

<div class="main">

    <div class="page-header">

        <h2>My Applications</h2>

        <p class="text-muted mb-0">
            View all placement drives you have applied for
        </p>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Job Role</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if(!empty($applications)) : ?>

                            <?php foreach($applications as $application) : ?>

                                <tr>

                                    <td>
                                        <?= $application['id'] ?>
                                    </td>

                                    <td>
                                        <?= esc($application['company_name']) ?>
                                    </td>

                                    <td>
                                        <?= esc($application['job_role']) ?>
                                    </td>

                                    <td>
                                        <?= $application['applied_at'] ?? '-' ?>
                                    </td>

                                    <td>

                                        <?php if($application['status'] == 'Applied') : ?>

                                            <span class="badge bg-primary">
                                                Applied
                                            </span>

                                        <?php elseif($application['status'] == 'Selected') : ?>

                                            <span class="badge bg-success">
                                                Selected
                                            </span>

                                        <?php elseif($application['status'] == 'Rejected') : ?>

                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-secondary">
                                                <?= esc($application['status']) ?>
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="5" class="text-center">
                                    No Applications Found
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->include('student/layout/footer') ?>