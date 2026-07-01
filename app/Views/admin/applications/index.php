<?= $this->include('layout/header') ?>
<?php

if(session()->get('role') == 'super_admin'){

    echo view('super_admin/layout/sidebar');

}else{

    echo view('admin/layout/sidebar');

}

?>

<div class="main">

    <div class="page-header">

        <h2>Applications Management</h2>

        <p class="text-muted mb-0">
            Manage student applications
        </p>

    </div>

    <br>

    <?php
    $companyQuery = '';

    if (!empty($currentCompany)) {
        $companyQuery = '&company=' . $currentCompany;
    }
    ?>

    <!-- Status Filters -->

    <div class="mb-3">

        <a href="<?= base_url('admin/applications' . (!empty($currentCompany) ? '?company=' . $currentCompany : '')) ?>"
            class="btn <?= empty($currentStatus) ? 'btn-dark' : 'btn-outline-dark' ?>">
            All
        </a>

        <a href="<?= base_url('admin/applications?status=Applied' . $companyQuery) ?>"
            class="btn <?= ($currentStatus ?? '') == 'Applied' ? 'btn-primary' : 'btn-outline-primary' ?>">
            Applied
        </a>

        <a href="<?= base_url('admin/applications?status=Selected' . $companyQuery) ?>"
            class="btn <?= ($currentStatus ?? '') == 'Selected' ? 'btn-success' : 'btn-outline-success' ?>">
            Selected
        </a>

        <a href="<?= base_url('admin/applications?status=Rejected' . $companyQuery) ?>"
            class="btn <?= ($currentStatus ?? '') == 'Rejected' ? 'btn-danger' : 'btn-outline-danger' ?>">
            Rejected
        </a>

    </div>

    <!-- Filters -->

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <form method="GET"
            action="<?= base_url('admin/applications') ?>">

            <?php if (!empty($currentStatus)) : ?>

                <input type="hidden"
                    name="status"
                    value="<?= esc($currentStatus) ?>">

            <?php endif; ?>

            <div class="row g-3">

                <div class="col-md-5">

                    <label class="form-label fw-semibold">
                        Company
                    </label>

                    <select name="company"
                        class="form-select">

                        <option value="">
                            All Companies
                        </option>

                        <?php foreach ($companies as $company) : ?>

                            <option value="<?= $company['id'] ?>"
                                <?= ($currentCompany ?? '') == $company['id']
                                    ? 'selected'
                                    : '' ?>>

                                <?= esc($company['company_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-5">

                    <label class="form-label fw-semibold">
                        Student Name
                    </label>

                    <input type="text"
                        name="student_name"
                        class="form-control"
                        placeholder="Search student name..."
                        value="<?= esc($currentStudent ?? '') ?>">

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button type="submit"
                        class="btn btn-primary w-100">

                        Filter

                    </button>

                </div>

            </div>

            <div class="mt-3">

                <a href="<?= base_url('admin/applications') ?>"
                    class="btn btn-outline-secondary btn-sm">

                    Reset Filters

                </a>

            </div>

        </form>

    </div>

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

                            <th>Company ID</th>
                            <th>Student</th>
                            <th>Company</th>
                            <th>Job Role</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th width="250">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($applications)) : ?>

                            <?php foreach ($applications as $application) : ?>

                                <tr>

                                    <td>
                                        <?= $application['id'] ?>
                                    </td>

                                    <td>
                                        <?= esc($application['name']) ?>
                                    </td>

                                    <td>
                                        <?= esc($application['company_name']) ?>
                                    </td>

                                    <td>
                                        <?= esc($application['job_role']) ?>
                                    </td>

                                    <td>

                                        <?php if (!empty($application['resume_file'])) : ?>

                                            <a href="<?= base_url('uploads/resumes/' . $application['resume_file']) ?>"
                                                target="_blank"
                                                class="btn btn-sm btn-primary">

                                                View Resume

                                            </a>

                                        <?php else : ?>

                                            <span class="text-danger">
                                                No Resume
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if ($application['status'] == 'Applied') : ?>

                                            <span class="badge bg-primary">
                                                Applied
                                            </span>

                                        <?php elseif ($application['status'] == 'Selected') : ?>

                                            <span class="badge bg-success">
                                                Selected
                                            </span>

                                        <?php elseif ($application['status'] == 'Rejected') : ?>

                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <form action="<?= base_url('admin/applications/update-status/' . $application['id']) ?>"
                                            method="POST"
                                            class="d-flex gap-2">

                                            <?= csrf_field() ?>

                                            <select name="status"
                                                class="form-select">

                                                <option value="Applied"
                                                    <?= $application['status'] == 'Applied' ? 'selected' : '' ?>>
                                                    Applied
                                                </option>

                                                <option value="Selected"
                                                    <?= $application['status'] == 'Selected' ? 'selected' : '' ?>>
                                                    Selected
                                                </option>

                                                <option value="Rejected"
                                                    <?= $application['status'] == 'Rejected' ? 'selected' : '' ?>>
                                                    Rejected
                                                </option>

                                            </select>

                                            <button type="submit"
                                                class="btn btn-success btn-sm">
                                                Update
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="7"
                                    class="text-center">

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

<?= $this->include('layout/footer') ?>