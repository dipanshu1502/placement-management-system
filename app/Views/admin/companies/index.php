<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center">

        <div>
            <h2>Company Management</h2>
            <p class="text-muted mb-0">
                Manage all recruiting companies
            </p>
        </div>

        <a href="<?= base_url('admin/companies/create') ?>"
            class="btn btn-primary">
            + Add Company
        </a>

    </div>

    <?php if(session()->getFlashdata('success')) : ?>

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
                            <th>Company Name</th>
                            <th>Website</th>
                            <th>Package (LPA)</th>
                            <th>Location</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if(!empty($companies)) : ?>

                            <?php foreach($companies as $company) : ?>

                                <tr>

                                    <td><?= $company['id'] ?></td>

                                    <td>
                                        <?= esc($company['company_name']) ?>
                                    </td>

                                    <td>
                                        <?= esc($company['website']) ?>
                                    </td>

                                    <td>
                                        <?= esc($company['package']) ?>
                                    </td>

                                    <td>
                                        <?= esc($company['location']) ?>
                                    </td>

                                    <td>

                                        <a href="<?= base_url('admin/companies/edit/'.$company['id']) ?>"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <a href="<?= base_url('admin/companies/delete/'.$company['id']) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this company?')">
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="6" class="text-center">
                                    No Companies Found
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