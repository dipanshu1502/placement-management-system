<?= $this->include('layout/header') ?>
<?= $this->include('super_admin/layout/sidebar') ?>

<div class="main">

    <style>
        /* =========================
                Welcome Banner
        ========================= */

        .welcome-banner {
            background: linear-gradient(135deg, #312e81, #6d28d9);
            color: #fff;
            padding: 28px;
            border-radius: 18px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px rgba(49, 46, 129, .20);
        }

        .welcome-banner h2 {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-banner p {
            font-size: 16px;
            margin: 0;
            opacity: .9;
        }

        /* =========================
                Dashboard Stat Cards
        ========================= */

        .stat-card {

            color: #fff;

            border-radius: 16px;

            height: 140px;

            padding: 18px;

            display: flex;

            flex-direction: column;

            justify-content: center;

            align-items: center;

            text-align: center;

            transition: .3s;

            box-shadow: 0 8px 20px rgba(0, 0, 0, .12);

            cursor: pointer;

        }

        .stat-card:hover {

            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, .18);

        }

        .text-decoration-none {
            text-decoration: none !important;
            color: inherit;
        }

        .stat-icon {

            font-size: 32px;

            margin-bottom: 8px;

        }

        .stat-card h2 {

            font-size: 38px;

            font-weight: 700;

            line-height: 1;

            margin: 8px 0;

        }

        .stat-card p {

            margin: 0;

            font-size: 18px;

            font-weight: 600;

        }

        /* =========================
                Card Colors
        ========================= */

        .bg-primary {

            background: linear-gradient(135deg, #2563eb, #4f46e5);

        }

        .bg-success {

            background: linear-gradient(135deg, #16a34a, #22c55e);

        }

        .bg-danger {

            background: linear-gradient(135deg, #dc2626, #ef4444);

        }

        .bg-info {

            background: linear-gradient(135deg, #0891b2, #06b6d4);

        }

        .bg-warning {

            background: linear-gradient(135deg, #f59e0b, #fbbf24);

        }

        .bg-purple {

            background: linear-gradient(135deg, #7c3aed, #9333ea);

        }

        /* =========================
                Common Card
        ========================= */

        .dashboard-card,
        .quick-card {

            border: none;

            border-radius: 18px;

            background: #fff;

            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);

            transition: .3s;

        }

        .dashboard-card:hover,
        .quick-card:hover {

            transform: translateY(-4px);

            box-shadow: 0 12px 28px rgba(0, 0, 0, .12);

        }

        /* =========================
               Section Title
        ========================= */

        .section-title {

            font-size: 24px;

            font-weight: 700;

            color: #1f2937;

            margin-bottom: 20px;

        }

        /* =========================
                Quick Buttons
        ========================= */

        .quick-btn {

            width: 100%;

            padding: 15px;

            border-radius: 14px;

            border: 2px solid #2563eb;

            background: #fff;

            color: #2563eb;

            font-size: 18px;

            font-weight: 600;

            margin-bottom: 15px;

            transition: .3s;

        }

        .quick-btn:hover {

            background: #2563eb;

            color: #fff;

            transform: translateY(-3px);

            box-shadow: 0 8px 20px rgba(37, 99, 235, .25);

        }

        /* =========================
                Tables
        ========================= */

        .table {

            margin-bottom: 0;

        }

        .table th {

            background: #f8fafc;

            font-weight: 600;

        }

        .table td {

            vertical-align: middle;

        }

        /* =========================
                Status
        ========================= */

        .status-online {

            color: #16a34a;

            font-weight: 600;

        }

        .status-offline {

            color: #ef4444;

            font-weight: 600;

        }

        /* =========================
                Badges
        ========================= */

        .badge {

            padding: 8px 12px;

            border-radius: 20px;

            font-size: 13px;

        }

        /* =========================
            Responsive
        ========================= */

        @media(max-width:992px) {

            .stat-card {

                min-height: 155px;

            }

        }

        @media(max-width:768px) {

            .welcome-banner {

                padding: 22px;

            }

            .welcome-banner h2 {

                font-size: 28px;

            }

            .stat-card {

                min-height: 145px;

                padding: 18px;

            }

            .stat-card h2 {

                font-size: 32px;

            }

            .stat-card p {

                font-size: 16px;

            }

            .stat-icon {

                font-size: 34px;

            }

            .section-title {

                font-size: 20px;

            }

            .quick-btn {

                font-size: 16px;

                padding: 13px;

            }

        }
    </style>

    <div class="welcome-banner">

        <h2>👑 Super Admin Control Center</h2>

        <p class="mb-2">
            Welcome back,
            <strong><?= session()->get('name') ?></strong>
        </p>

        <p class="mb-0">
            You have complete access to manage administrators,
            placement operations and future system configuration.
        </p>

    </div>

    <div class="row g-3 mb-4">

        <!-- Total Admins -->
        <div class="col-lg-4 col-md-6">
            <a href="<?= base_url('super-admin/admins') ?>" class="text-decoration-none">
                <div class="stat-card bg-primary">
                    <div class="stat-icon">👨‍💼</div>
                    <h2><?= $admins ?></h2>
                    <p>Total Admins</p>
                </div>
            </a>
        </div>

        <!-- Active Admins -->
        <div class="col-lg-4 col-md-6">
            <a href="<?= base_url('super-admin/admins?status=active') ?>" class="text-decoration-none">
                <div class="stat-card bg-success">
                    <div class="stat-icon">🟢</div>
                    <h2><?= $activeAdmins ?></h2>
                    <p>Active Admins</p>
                </div>
            </a>
        </div>

        <!-- Inactive Admins -->
        <div class="col-lg-4 col-md-6">
            <a href="<?= base_url('super-admin/admins?status=inactive') ?>" class="text-decoration-none">
                <div class="stat-card bg-danger">
                    <div class="stat-icon">🔴</div>
                    <h2><?= $inactiveAdmins ?></h2>
                    <p>Inactive Admins</p>
                </div>
            </a>
        </div>

        <!-- Students -->
        <div class="col-lg-4 col-md-6">
            <a href="<?= base_url('admin/students') ?>" class="text-decoration-none">
                <div class="stat-card bg-info">
                    <div class="stat-icon">🎓</div>
                    <h2><?= $students ?></h2>
                    <p>Total Students</p>
                </div>
            </a>
        </div>

        <!-- Companies -->
        <div class="col-lg-4 col-md-6">
            <a href="<?= base_url('admin/companies') ?>" class="text-decoration-none">
                <div class="stat-card bg-warning">
                    <div class="stat-icon">💼</div>
                    <h2><?= $companies ?></h2>
                    <p>Companies</p>
                </div>
            </a>
        </div>

        <!-- Placement Drives -->
        <div class="col-lg-4 col-md-6">
            <a href="<?= base_url('admin/drives') ?>" class="text-decoration-none">
                <div class="stat-card bg-purple">
                    <div class="stat-icon">🚀</div>
                    <h2><?= $drives ?></h2>
                    <p>Placement Drives</p>
                </div>
            </a>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-lg-7">

            <div class="card quick-card">

                <div class="card-body">

                    <h4 class="section-title">
                        ⚡ Quick Actions
                    </h4>

                    <div class="row">

                        <div class="col-md-6">

                            <a href="<?= base_url('super-admin/admins') ?>" class="btn btn-primary quick-btn">

                                👨‍💼 Manage Admins

                            </a>

                        </div>

                        <div class="col-md-6">

                            <a href="<?= base_url('admin/departments') ?>" class="btn btn-outline-primary quick-btn">

                                🏢 Departments

                            </a>

                        </div>

                        <div class="col-md-6">

                            <a href="<?= base_url('admin/students') ?>" class="btn btn-outline-primary quick-btn">

                                👨‍🎓 Students

                            </a>

                        </div>

                        <div class="col-md-6">

                            <a href="<?= base_url('admin/companies') ?>" class="btn btn-outline-primary quick-btn">

                                💼 Companies

                            </a>

                        </div>

                        <div class="col-md-6">

                            <a href="<?= base_url('admin/drives') ?>" class="btn btn-outline-primary quick-btn">

                                🚀 Placement Drives

                            </a>

                        </div>

                        <div class="col-md-6">

                            <a href="<?= base_url('admin/applications') ?>" class="btn btn-outline-primary quick-btn">

                                📝 Applications

                            </a>

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-5">

            <div class="card quick-card">

                <div class="card-body">

                    <h4 class="section-title">
                        🟢 System Status
                    </h4>

                    <table class="table table-borderless mb-0">

                        <tr>
                            <td>Total Admins</td>
                            <td class="text-end">
                                <?= $admins ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Total Students</td>
                            <td class="text-end">
                                <?= $students ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Total Companies</td>
                            <td class="text-end">
                                <?= $companies ?>
                            </td>
                            
                        <tr>
                            <td>Login User</td>
                            <td class="text-end">
                                <?= session()->get('name') ?>
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-lg-7">

            <div class="card dashboard-card">

                <div class="card-body">

                    <h4 class="section-title">
                        📊 System Overview
                    </h4>

                    <div class="row text-center">

                        <div class="col-md-4 mb-4">
                            <h2 class="text-primary">
                                <?= $students ?>
                            </h2>
                            <p>Total Students</p>
                        </div>

                        <div class="col-md-4 mb-4">
                            <h2 class="text-success">
                                <?= $companies ?>
                            </h2>
                            <p>Companies</p>
                        </div>

                        <div class="col-md-4 mb-4">
                            <h2 class="text-danger">
                                <?= $departments ?>
                            </h2>
                            <p>Departments</p>
                        </div>

                        <div class="col-md-6">
                            <h2 class="text-warning">
                                <?= $drives ?>
                            </h2>
                            <p>Placement Drives</p>
                        </div>

                        <div class="col-md-6">
                            <h2 style="color:#6d28d9;">
                                <?= $admins ?>
                            </h2>
                            <p>System Admins</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-5">

            <div class="card dashboard-card">

                <div class="card-body">

                    <h4 class="section-title">
                        📜 Recent Activities
                    </h4>

<?php if (!empty($recentActivities)) : ?>

                        <?php foreach ($recentActivities as $activity) : ?>

                            <?php
                            $icon='📌';
                            switch($activity['module']){
                                case 'Company': $icon='💼'; break;
                                case 'Department': $icon='🏢'; break;
                                case 'Placement Drive': $icon='🚀'; break;
                                case 'Student': $icon='👨‍🎓'; break;
                                case 'Application': $icon='📝'; break;
                                case 'Admin': $icon='👨‍💼'; break;
                            }
                            ?>

                            <div class="alert alert-light border mb-3">
                                <strong><?= $icon ?> <?= esc($activity['name']) ?></strong><br>
                                <span class="badge bg-primary"><?= esc($activity['action']) ?></span>
                                <?= esc($activity['description']) ?>
                                <br>
                                <small class="text-muted">
                                    <?= date('d M Y h:i A', strtotime($activity['created_at'])) ?>
                                </small>
                            </div>

                        <?php endforeach; ?>

                        <div class="text-end mt-3">
                            <a href="<?= base_url('super-admin/activity-logs') ?>" class="btn btn-primary btn-sm">
                                View All Activities →
                            </a>
                        </div>

                    <?php else : ?>

                        <div class="alert alert-warning">
                            No recent activities found.
                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('layout/footer') ?>