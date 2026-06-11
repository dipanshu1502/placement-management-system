<?= $this->include('student/layout/header') ?>
<?= $this->include('student/layout/sidebar') ?>

<div class="main">
    <div class="container mt-4">

        <div class="card shadow">
            <div class="card-header">
                <h4>Resume Management</h4>
            </div>

            <div class="card-body">

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <h5>Upload Resume</h5>

                <form action="<?= base_url('student/resume/upload') ?>"
                      method="post"
                      enctype="multipart/form-data">

                    <div class="mb-3">
                        <label class="form-label">Resume File</label>

                        <input type="file"
                               name="resume"
                               class="form-control"
                               required>

                        <small class="text-muted">
                            PDF, DOC, DOCX allowed
                        </small>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Upload Resume
                    </button>

                </form>

                <hr>

                <?php if(!empty($resume)): ?>

                    <h5>Current Resume</h5>

                    <a href="<?= base_url('uploads/resumes/'.$resume['resume_file']) ?>"
                       target="_blank"
                       class="btn btn-primary">
                        View Resume
                    </a>

                <?php else: ?>

                    <div class="alert alert-warning">
                        No Resume Uploaded Yet.
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<?= $this->include('student/layout/footer') ?>