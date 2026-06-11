<?= $this->include('student/layout/header') ?>
<?= $this->include('student/layout/sidebar') ?>

<style>
    .welcome-banner {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 25px;
        border-radius: 18px;
        margin-bottom: 25px;
    }

    .dashboard-link {
        text-decoration: none;
        color: inherit;
    }

    .dashboard-card {
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
        box-shadow: 0 15px 30px rgba(0,0,0,.15) !important;
    }

    .stat-card {
        color: white;
    }

    .bg-drive {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .bg-applied {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .bg-selected {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .bg-profile {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .card-icon {
        font-size: 34px;
    }

    .section-card {
        border: none;
        border-radius: 18px;
        height: fit-content;
    }

    .quick-btn {
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
    }

    .notification-item:last-child {
        border-bottom: none !important;
    }
</style>

<div class="main">

    <?php
    $user = $user ?? session()->get('user') ?? [
        'name'  => 'Student',
        'email' => 'Not Available',
        'role'  => 'student',
        'id'    => 'N/A'
    ];
    ?>

    <!-- Welcome Banner -->

    <div class="welcome-banner shadow">
        <h2 class="mb-2">
            Welcome, <?= esc($user['name']); ?> 👋
        </h2>

        <p class="mb-0">
            Track placement drives, manage your profile, upload resume and monitor your application progress.
        </p>
    </div>

    <!-- Statistics -->

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="<?= base_url('student/drives') ?>" class="dashboard-link">

                <div class="card stat-card bg-drive shadow dashboard-card">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h2><?= $availableDrives ?? 0 ?></h2>
                            <p class="mb-0">Available Drives</p>
                        </div>

                        <div class="card-icon">
                            🚀
                        </div>

                    </div>

                </div>

            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="<?= base_url('student/applications') ?>" class="dashboard-link">

                <div class="card stat-card bg-applied shadow dashboard-card">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h2><?= $appliedDrives ?? 0 ?></h2>
                            <p class="mb-0">Applied Drives</p>
                        </div>

                        <div class="card-icon">
                            📄
                        </div>

                    </div>

                </div>

            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="<?= base_url('student/applications?status=Selected') ?>" class="dashboard-link">

                <div class="card stat-card bg-selected shadow dashboard-card">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h2><?= $interviews ?? 0 ?></h2>
                            <p class="mb-0">Selected</p>
                        </div>

                        <div class="card-icon">
                            🎯
                        </div>

                    </div>

                </div>

            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="<?= base_url('student/profile') ?>" class="dashboard-link">

                <div class="card stat-card bg-profile shadow dashboard-card">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h2><?= $profileCompletion ?? 0 ?>%</h2>
                            <p class="mb-0">Profile Complete</p>
                        </div>

                        <div class="card-icon">
                            👤
                        </div>

                    </div>

                </div>

            </a>
        </div>

    </div>

    <!-- Bottom Section -->

    <div class="row align-items-start">

        <!-- Profile Card -->

        <div class="col-lg-4 mb-4">

            <div class="card section-card shadow">

                <div class="card-header bg-white">
                    <strong>👤 My Account</strong>
                </div>

                <div class="card-body">

                    <p>
                        <strong>Name:</strong><br>
                        <?= esc($user['name']); ?>
                    </p>

                    <p>
                        <strong>Email:</strong><br>
                        <?= esc($user['email']); ?>
                    </p>

                    <p>
                        <strong>Role:</strong><br>
                        <?= ucfirst($user['role']); ?>
                    </p>

                    <p class="mb-0">
                        <strong>User ID:</strong><br>
                        <?= $user['id']; ?>
                    </p>

                </div>

            </div>

        </div>

        <!-- Quick Actions -->

        <div class="col-lg-4 mb-4">

            <div class="card section-card shadow">

                <div class="card-header bg-white">
                    <strong>⚡ Quick Actions</strong>
                </div>

                <div class="card-body d-flex flex-column gap-3">

                    <a href="<?= base_url('student/profile') ?>"
                        class="btn btn-primary w-100 quick-btn">
                        Update Profile
                    </a>

                    <a href="<?= base_url('student/resume') ?>"
                        class="btn btn-success w-100 quick-btn">
                        Upload Resume
                    </a>

                    <a href="<?= base_url('student/drives') ?>"
                        class="btn btn-info w-100 quick-btn">
                        View Placement Drives
                    </a>

                </div>

            </div>

        </div>

        <!-- Notifications -->

        <div class="col-lg-4 mb-4">

            <div class="card section-card shadow">

                <div class="card-header d-flex justify-content-between align-items-center bg-white">

                    <strong>🔔 Notifications</strong>

                    <a href="<?= base_url('student/notifications') ?>"
                        class="btn btn-sm btn-primary">
                        View All
                    </a>

                </div>

                <div class="card-body">

                    <?php if (!empty($notifications)) : ?>

                        <?php foreach ($notifications as $notification) : ?>

                            <div class="notification-item border-bottom pb-2 mb-3">

                                <strong>
                                    <?= esc($notification['title']) ?>
                                </strong>

                                <br>

                                <small class="text-muted">
                                    <?= esc($notification['message']) ?>
                                </small>

                            </div>

                        <?php endforeach; ?>

                    <?php else : ?>

                        <div class="text-center text-muted py-4">
                            No notifications available.
                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('student/layout/footer') ?>