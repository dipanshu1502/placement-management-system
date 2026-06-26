<?php

use App\Models\NotificationModel;
use App\Models\StudentModel;

$unreadCount = 0;

$userId = session()->get('id');

$studentModel = new StudentModel();
$notificationModel = new NotificationModel();

$student = $studentModel
    ->where('user_id', $userId)
    ->first();

if ($student) {

    $unreadCount = $notificationModel
        ->where('student_id', $student['id'])
        ->where('is_read', 0)
        ->countAllResults();
}

$currentUrl = current_url();

?>

<style>
    .student-sidebar {
        width: 260px;
        min-height: 100vh;
        background: linear-gradient(180deg, #4f46e5, #7c3aed);
        position: fixed;
        left: 0;
        top: 0;
        padding: 25px 0;
        box-shadow: 0 0 25px rgba(0, 0, 0, .15);
        z-index: 999;
        transition: all .3s ease;
    }

    .student-sidebar-title {
        color: #fff;
        text-align: center;
        margin-bottom: 35px;
        font-size: 24px;
        font-weight: 700;
        white-space: nowrap;
    }

    .student-sidebar a {
        display: block;
        color: #fff;
        text-decoration: none;
        padding: 14px 25px;
        margin: 6px 12px;
        border-radius: 12px;
        transition: all .3s ease;
        font-size: 17px;
        font-weight: 500;
    }

    .student-sidebar a:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(5px);
    }

    .student-sidebar a.active {
        background: rgba(255, 255, 255, 0.20);
        border-left: 4px solid #fff;
    }

    .student-sidebar .badge {
        float: right;
        margin-top: 2px;
    }

    @media (max-width: 768px) {

        .student-sidebar {
            left: -280px;
            width: 260px;
        }

        .student-sidebar.show {
            left: 0;
        }

        .student-sidebar-title {
            font-size: 20px;
        }
    }
</style>

<div class="student-sidebar" id="studentSidebar">

    <h3 class="student-sidebar-title">🎓 Student Panel</h3>

    <a href="<?= base_url('student/dashboard') ?>"
        class="<?= strpos($currentUrl, 'student/dashboard') !== false ? 'active' : '' ?>">
        📊 Dashboard
    </a>

    <a href="<?= base_url('student/profile') ?>"
        class="<?= strpos($currentUrl, 'student/profile') !== false ? 'active' : '' ?>">
        👤 My Profile
    </a>

    <a href="<?= base_url('student/resume') ?>"
        class="<?= strpos($currentUrl, 'student/resume') !== false ? 'active' : '' ?>">
        📄 Resume
    </a>

    <a href="<?= base_url('student/drives') ?>"
        class="<?= strpos($currentUrl, 'student/drives') !== false ? 'active' : '' ?>">
        🚀 Placement Drives
    </a>

    <a href="<?= base_url('student/applications') ?>"
        class="<?= strpos($currentUrl, 'student/applications') !== false ? 'active' : '' ?>">
        📝 My Applications
    </a>

    <a href="<?= base_url('student/notifications') ?>"
        class="<?= strpos($currentUrl, 'student/notifications') !== false ? 'active' : '' ?>">
        🔔 Notifications

        <?php if ($unreadCount > 0): ?>
            <span class="badge bg-danger">
                <?= $unreadCount ?>
            </span>
        <?php endif; ?>
    </a>

    <a href="<?= base_url('logout') ?>">
        🚪 Logout
    </a>

</div>

<script>
    function toggleStudentSidebar() {

        const sidebar = document.getElementById('studentSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (sidebar) {
            sidebar.classList.toggle('show');
        }

        if (overlay) {
            overlay.classList.toggle('show');
        }
    }
</script>