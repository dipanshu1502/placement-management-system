<?= $this->include('student/layout/header') ?>
<?= $this->include('student/layout/sidebar') ?>

<div class="main">

    <div class="page-header">

        <h2>Available Placement Drives</h2>

        <p class="text-muted mb-0">
            Apply for available placement opportunities
        </p>

    </div>

    <?php if (session()->getFlashdata('success')) : ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?= session()->getFlashdata('success') ?>

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <?= session()->getFlashdata('error') ?>

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Job Role</th>
                            <th>Package</th>
                            <th>Min CGPA</th>
                            <th>Last Date</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($drives)) : ?>

                            <?php foreach ($drives as $drive) : ?>

                                <?php

                                $isOpen = strtotime($drive['last_date']) >= strtotime(date('Y-m-d'));

                                $studentCgpa = $studentCgpa ?? 0;

                                $isEligible = $studentCgpa >= $drive['min_cgpa'];

                                $isApplied = in_array(
                                    $drive['id'],
                                    $appliedDrives ?? []
                                );

                                ?>

                                <tr>

                                    <td><?= $drive['id'] ?></td>

                                    <td>
                                        <?= esc($drive['company_name']) ?>
                                    </td>

                                    <td>
                                        <?= esc($drive['job_role']) ?>
                                    </td>

                                    <td>
                                        <?php if (!empty($drive['package_lpa'])) : ?>
                                            <span class="badge bg-success">
                                                <?= esc($drive['package_lpa']) ?> LPA
                                            </span>
                                        <?php else : ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?= esc($drive['min_cgpa']) ?>
                                    </td>

                                    <td>
                                        <?= esc($drive['last_date']) ?>
                                    </td>

                                    <td>

                                        <?php if ($isOpen) : ?>

                                            <span class="badge bg-success">
                                                Open
                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-danger">
                                                Closed
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if ($isApplied) : ?>

                                            <button class="btn btn-success btn-sm" disabled>
                                                Applied
                                            </button>

                                        <?php elseif (!$isOpen) : ?>

                                            <button class="btn btn-secondary btn-sm" disabled>
                                                Closed
                                            </button>

                                        <?php elseif (!$isEligible) : ?>

                                            <button class="btn btn-warning btn-sm" disabled>
                                                Not Eligible
                                            </button>

                                        <?php else : ?>

                                            <a href="<?= base_url('student/drives/apply/' . $drive['id']) ?>"
                                                class="btn btn-primary btn-sm"
                                                onclick="return confirm('Apply for this drive?')">

                                                Apply Now

                                            </a>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="7" class="text-center">
                                    No Placement Drives Available
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