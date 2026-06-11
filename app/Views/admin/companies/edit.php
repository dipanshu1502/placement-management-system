<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<?php $company = $company ?? []; ?>

<div class="main">

    <div class="page-header">

        <h2>Edit Company</h2>

        <p class="text-muted mb-0">
            Update company information
        </p>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <form action="<?= base_url('admin/companies/update/' . $company['id']) ?>"
                  method="POST">

                <?= csrf_field() ?>

                <div class="mb-3">

                    <label class="form-label">
                        Company Name
                    </label>

                    <input
                        type="text"
                        name="company_name"
                        class="form-control"
                        value="<?= $company['company_name'] ?? '' ?>"
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
                        value="<?= $company['website'] ?? '' ?>">

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
                        value="<?= $company['package'] ?? '' ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Location
                    </label>

                    <input
                        type="text"
                        name="location"
                        class="form-control"
                        value="<?= $company['location'] ?? '' ?>">

                </div>

                <button type="submit"
                        class="btn btn-primary">
                    Update Company
                </button>

                <a href="<?= base_url('admin/companies') ?>"
                    class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>