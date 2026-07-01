<?= $this->include('layout/header') ?>
<?php

if(session()->get('role') == 'super_admin'){

    echo view('super_admin/layout/sidebar');

}else{

    echo view('admin/layout/sidebar');

}

?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Department Management</h2>
            <p class="text-muted mb-0">
                Manage all university departments
            </p>
        </div>

        <a href="<?= base_url('admin/departments/create') ?>"
            class="btn btn-primary">
            + Add Department
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
                            <th width="80">ID</th>
                            <th>Department Name</th>
                            <th>Department Code</th>
                            <th>Created At</th>
                            <th width="220">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($departments)) : ?>

                            <?php foreach ($departments as $department) : ?>

                                <tr>

                                    <td><?= $department['id'] ?></td>

                                    <td>
                                        <?= esc($department['department_name']) ?>
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            <?= esc($department['department_code']) ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?= $department['created_at'] ?? '-' ?>
                                    </td>

                                    <td>

                                        <a href="<?= base_url('admin/departments/edit/' . $department['id']) ?>"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <a href="<?= base_url('admin/departments/delete/' . $department['id']) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this department?')">
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>
                                <td colspan="5" class="text-center">
                                    No Departments Found
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