<?php

$currentUrl = current_url();

?>

<style>
    .sidebar {
        width: 260px;
        min-height: 100vh;
        background: linear-gradient(180deg, #111827, #2563eb);
        position: fixed;
        left: 0;
        top: 0;
        padding: 25px 0;
        box-shadow: 0 0 25px rgba(0, 0, 0, .20);
        z-index: 999;
        transition: all .3s ease;
    }

    .sidebar-title {
        color: #fff;
        text-align: center;
        margin-bottom: 35px;
        font-size: 26px;
        font-weight: 700;
        white-space: nowrap;
    }

    .sidebar a {
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

    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(5px);
    }

    .sidebar a.active {
        background: rgba(255, 255, 255, 0.20);
        border-left: 4px solid #fff;
    }

    @media (max-width: 768px) {

        .sidebar {
            left: -280px;
            width: 260px;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar-title {
            font-size: 22px;
        }
    }
</style>

<div class="sidebar" id="adminSidebar">

    <h3 class="sidebar-title">🛠 PMS Admin</h3>

    <a href="<?= base_url('admin/dashboard') ?>"
        class="<?= strpos($currentUrl, 'admin/dashboard') !== false ? 'active' : '' ?>">
        📊 Dashboard
    </a>

    <a href="<?= base_url('admin/departments') ?>"
        class="<?= strpos($currentUrl, 'admin/departments') !== false ? 'active' : '' ?>">
        🏢 Departments
    </a>

    <a href="<?= base_url('admin/students') ?>"
        class="<?= strpos($currentUrl, 'admin/students') !== false ? 'active' : '' ?>">
        👨‍🎓 Students
    </a>

    <a href="<?= base_url('admin/companies') ?>"
        class="<?= strpos($currentUrl, 'admin/companies') !== false ? 'active' : '' ?>">
        💼 Companies
    </a>

    <a href="<?= base_url('admin/drives') ?>"
        class="<?= strpos($currentUrl, 'admin/drives') !== false ? 'active' : '' ?>">
        🚀 Placement Drives
    </a>

    <a href="<?= base_url('admin/applications') ?>"
        class="<?= strpos($currentUrl, 'admin/applications') !== false ? 'active' : '' ?>">
        📝 Applications
    </a>

    <a href="<?= base_url('logout') ?>">
        🚪 Logout
    </a>

</div>