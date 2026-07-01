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

        <h2>Create Placement Drive</h2>

        <p class="text-muted mb-0">
            Create a new placement drive
        </p>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <form action="<?= base_url('admin/drives/store') ?>" method="POST">

                <?= csrf_field() ?>

                <div class="mb-3">

                    <label class="form-label">
                        Company
                    </label>

                    <select name="company_id"
                        class="form-control"
                        required>

                        <option value="">
                            Select Company
                        </option>

                        <?php foreach ($companies as $company) : ?>

                            <option value="<?= $company['id'] ?>">
                                <?= esc($company['company_name']) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Job Role
                    </label>

                    <input
                        type="text"
                        name="job_role"
                        class="form-control"
                        placeholder="Software Developer"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Minimum CGPA
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="min_cgpa"
                        class="form-control"
                        placeholder="7.00">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Package (LPA)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="package_lpa"
                        class="form-control"
                        placeholder="6.50">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Last Date
                    </label>

                    <input
                        type="date"
                        name="last_date"
                        class="form-control">

                </div>

                <!-- <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-control">

                        <option value="Open">
                            Open
                        </option>

                        <option value="Closed">
                            Closed
                        </option>

                    </select>

                </div> -->

                <button type="submit"
                    class="btn btn-success">
                    Create Drive
                </button>

                <a href="<?= base_url('admin/drives') ?>"
                    class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

<?= $this->include('layout/footer') ?>