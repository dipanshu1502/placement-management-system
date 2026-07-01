<?= $this->include('layout/header') ?>
<?php

if(session()->get('role') == 'super_admin'){

    echo view('super_admin/layout/sidebar');

}else{

    echo view('admin/layout/sidebar');

}

?>

<style>
    .welcome-banner {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 25px;
        border-radius: 18px;
        margin-bottom: 25px;
    }

    .dashboard-card {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: all .3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-8px);
    }

    .dashboard-card .card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
    }

    .dashboard-card:hover .card {
        box-shadow: 0 15px 30px rgba(0, 0, 0, .15) !important;
    }

    .card-icon {
        font-size: 35px;
        opacity: .9;
    }

    .stat-card {
        color: #fff;
    }

    .bg-students {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .bg-departments {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .bg-companies {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .bg-drives {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .quick-action .btn {
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
    }

    .section-card {
        border: none;
        border-radius: 18px;
    }
</style>

<div class="main">

    <!-- Welcome Banner -->
    <div class="welcome-banner shadow">
        <h2 class="mb-2">🎓 Placement Management System</h2>
        <p class="mb-0">
            Welcome back, Admin. Manage students, companies, placement drives and applications from one place.
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="<?= base_url('admin/students') ?>" class="dashboard-card">
                <div class="card stat-card bg-students shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2><?= $students ?? 0 ?></h2>
                            <p class="mb-0">Total Students</p>
                        </div>
                        <div class="card-icon">
                            👨‍🎓
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="<?= base_url('admin/departments') ?>" class="dashboard-card">
                <div class="card stat-card bg-departments shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2><?= $departments ?? 0 ?></h2>
                            <p class="mb-0">Departments</p>
                        </div>
                        <div class="card-icon">
                            🏢
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="<?= base_url('admin/companies') ?>" class="dashboard-card">
                <div class="card stat-card bg-companies shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2><?= $companies ?? 0 ?></h2>
                            <p class="mb-0">Companies</p>
                        </div>
                        <div class="card-icon">
                            💼
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="<?= base_url('admin/drives') ?>" class="dashboard-card">
                <div class="card stat-card bg-drives shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2><?= $drives ?? 0 ?></h2>
                            <p class="mb-0">Placement Drives</p>
                        </div>
                        <div class="card-icon">
                            🚀
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="card section-card shadow mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">⚡ Quick Actions</h5>
        </div>

        <div class="card-body">
            <div class="row quick-action">

                <div class="col-md-3 mb-3">
                    <a href="<?= base_url('admin/companies/create') ?>" class="btn btn-primary w-100">
                        Add Company
                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="<?= base_url('admin/drives/create') ?>" class="btn btn-success w-100">
                        Create Drive
                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="<?= base_url('admin/students') ?>" class="btn btn-warning w-100">
                        Manage Students
                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="<?= base_url('admin/applications') ?>" class="btn btn-danger w-100">
                        View Applications
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- System Overview -->
    <div class="card section-card shadow">
        <div class="card-header bg-white">
            <h5 class="mb-0">📊 System Overview</h5>
        </div>

        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-3">
                    <h3><?= $students ?? 0 ?></h3>
                    <small class="text-muted">Registered Students</small>
                </div>

                <div class="col-md-3">
                    <h3><?= $departments ?? 0 ?></h3>
                    <small class="text-muted">Departments</small>
                </div>

                <div class="col-md-3">
                    <h3><?= $companies ?? 0 ?></h3>
                    <small class="text-muted">Partner Companies</small>
                </div>

                <div class="col-md-3">
                    <h3><?= $drives ?? 0 ?></h3>
                    <small class="text-muted">Placement Drives</small>
                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->include('layout/footer') ?>