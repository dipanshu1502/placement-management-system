<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center">

        <div>
            <h2>Placement Drive Management</h2>
            <p class="text-muted mb-0">
                Manage all placement drives
            </p>
        </div>

        <a href="<?= base_url('admin/drives/create') ?>"
            class="btn btn-primary">
            + Create Drive
        </a>

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
                            <th width="150">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($drives)) : ?>

                            <?php foreach ($drives as $drive) : ?>

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
                                            <?= esc($drive['package_lpa']) ?> LPA
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

                                        <!-- <?php if ($drive['status'] == 'Open') : ?>

                                            <span class="badge bg-success">
                                                Open
                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-danger">
                                                Closed
                                            </span>

                                        <?php endif; ?> -->
                                        <?php

                                        $isOpen = strtotime($drive['last_date']) >= strtotime(date('Y-m-d'));

                                        ?>

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

                                        <div class="d-flex gap-2">

                                            <a href="<?= base_url('admin/drives/export-applicants/' . $drive['id']) ?>"
                                                class="btn btn-success btn-sm">
                                                CSV
                                            </a>

                                            <a href="<?= base_url('admin/drives/delete/' . $drive['id']) ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this drive?')">
                                                Delete
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="7" class="text-center">
                                    No Placement Drives Found
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