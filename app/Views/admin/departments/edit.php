<?= $this->include('layout/header') ?>
<?php

if(session()->get('role') == 'super_admin'){

    echo view('super_admin/layout/sidebar');

}else{

    echo view('admin/layout/sidebar');

}

?>

<?php $department = $department ?? []; ?>

<div class="main">

    <div class="page-header">
        <h2>Edit Department</h2>
        <p class="text-muted mb-0">
            Update department information
        </p>
    </div>

    <div class="card shadow">

        <div class="card-body">

            <?php if(session()->getFlashdata('errors')) : ?>

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        <?php foreach(session()->getFlashdata('errors') as $error) : ?>

                            <li><?= $error ?></li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>

            <form action="<?= base_url('admin/departments/update/' . ($department['id'] ?? '')) ?>" method="POST">

                <?= csrf_field() ?>

                <div class="mb-3">

                    <label class="form-label">
                        Department Name
                    </label>

                    <input
                        type="text"
                        name="department_name"
                        class="form-control"
                        value="<?= old('department_name', $department['department_name'] ?? '') ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Department Code
                    </label>

                    <input
                        type="text"
                        name="department_code"
                        class="form-control"
                        value="<?= old('department_code', $department['department_code'] ?? '') ?>"
                        required>

                </div>

                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Update Department
                    </button>

                    <a href="<?= base_url('admin/departments') ?>"
                        class="btn btn-secondary">
                        Back
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->include('layout/footer') ?>