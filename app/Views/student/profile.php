<?= $this->include('student/layout/header') ?>
<?= $this->include('student/layout/sidebar') ?>

<div class="main">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">My Profile</h4>
        </div>

        <div class="card-body">

            <?php if(session()->getFlashdata('success')) : ?>

                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>

            <?php endif; ?>

            <?php if(session()->getFlashdata('errors')) : ?>

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        <?php foreach(session()->getFlashdata('errors') as $error) : ?>

                            <li><?= $error ?></li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>

            <form action="<?= base_url('student/profile/save') ?>" method="POST">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Department
                        </label>

                        <select name="department_id" class="form-control" required>

                            <option value="">
                                Select Department
                            </option>

                            <?php foreach($departments ?? [] as $dept) : ?>

                                <option
                                    value="<?= $dept['id'] ?>"
                                    <?= isset($student['department_id']) && $student['department_id'] == $dept['id'] ? 'selected' : '' ?>>

                                    <?= $dept['department_name'] ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Roll Number
                        </label>

                        <input
                            type="text"
                            name="roll_no"
                            class="form-control"
                            value="<?= $student['roll_no'] ?? '' ?>"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="<?= $student['phone'] ?? '' ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            CGPA
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="cgpa"
                            class="form-control"
                            value="<?= $student['cgpa'] ?? '' ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Backlogs
                        </label>

                        <input
                            type="number"
                            name="backlogs"
                            class="form-control"
                            value="<?= $student['backlogs'] ?? 0 ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Passing Year
                        </label>

                        <input
                            type="number"
                            name="passing_year"
                            class="form-control"
                            value="<?= $student['passing_year'] ?? '' ?>">

                    </div>

                </div>

                <button class="btn btn-success">
                    Save Profile
                </button>

            </form>

        </div>

    </div>

</div>

<?= $this->include('student/layout/footer') ?>