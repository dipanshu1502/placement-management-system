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

        <h2>Add Company</h2>

        <p class="text-muted mb-0">
            Add a new recruiting company
        </p>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <form action="<?= base_url('admin/companies/store') ?>" method="POST">

                <?= csrf_field() ?>

                <div class="mb-3">

                    <label class="form-label">
                        Company Name
                    </label>

                    <input
                        type="text"
                        name="company_name"
                        class="form-control"
                        placeholder="Enter Company Name"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Website
                    </label>

                    <input
                        type="text"
                        name="website"
                        class="form-control"
                        placeholder="https://company.com">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Package (LPA)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="package"
                        class="form-control"
                        placeholder="10.50">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Location
                    </label>

                    <input
                        type="text"
                        name="location"
                        class="form-control"
                        placeholder="Bangalore">

                </div>

                <button type="submit" class="btn btn-success">
                    Save Company
                </button>

                <a href="<?= base_url('admin/companies') ?>"
                    class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

<?= $this->include('layout/footer') ?>