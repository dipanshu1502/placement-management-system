<?php

$currentUrl = current_url();

?>

<style>
    .sidebar {
        width: 260px;
        height: 100vh;
        background: linear-gradient(180deg, #0f172a 0%, #312e81 55%, #581c87 100%);
        position: fixed;
        left: 0;
        top: 0;
        padding: 20px 0;
        box-shadow: 0 0 25px rgba(0, 0, 0, .20);
        z-index: 999;
        overflow-y: auto;
        overflow-x: hidden;
        scrollbar-width: thin;
        transition: .3s;
    }

    .sidebar-title {
        color: #fff;
        text-align: center;
        margin-bottom: 25px;
        font-size: 24px;
        font-weight: bold;
    }

    .menu-heading {
        color: rgba(255, 255, 255, .65);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 18px 22px 8px;
    }

    .sidebar a {
        display: block;
        color: #fff;
        text-decoration: none;
        padding: 12px 22px;
        margin: 5px 12px;
        border-radius: 12px;
        transition: .25s;
        font-size: 15px;
    }

    .sidebar a:hover {
        background: rgba(255,255,255,.15);
        transform: translateX(5px);
    }

    .sidebar a.active {
        background: rgba(255,255,255,.20);
        border-left: 4px solid #fff;
        font-weight: 600;
    }

    .menu-divider {
        height: 1px;
        background: rgba(255,255,255,.12);
        margin: 0 18px;
    }

    .coming-soon {
        opacity: .75;
    }

    @media(max-width:768px){

        .sidebar{
            left:-280px;
        }

        .sidebar.show{
            left:0;
        }

    }

</style>

<div class="sidebar" id="superAdminSidebar">

    <h3 class="sidebar-title">
        👑 PMS Super Admin
    </h3>

    <div class="menu-heading">
        Dashboard
    </div>

    <a href="<?= base_url('super-admin/dashboard') ?>"
        class="<?= strpos($currentUrl,'super-admin/dashboard') !== false ? 'active' : '' ?>">
        📊 Dashboard
    </a>

    <div class="menu-divider"></div>

    <div class="menu-heading">
        Admin Management
    </div>

    <a href="<?= base_url('super-admin/admins') ?>"
        class="<?= strpos($currentUrl,'super-admin/admins') !== false ? 'active' : '' ?>">
        👨‍💼 Manage Admins
    </a>

    <div class="menu-divider"></div>

    <div class="menu-heading">
        Placement Management
    </div>

    <a href="<?= base_url('admin/departments') ?>"
        class="<?= strpos($currentUrl,'admin/departments') !== false ? 'active' : '' ?>">
        🏢 Departments
    </a>

    <a href="<?= base_url('admin/students') ?>"
        class="<?= strpos($currentUrl,'admin/students') !== false ? 'active' : '' ?>">
        👨‍🎓 Students
    </a>

    <a href="<?= base_url('admin/removed-students') ?>"
        class="<?= strpos($currentUrl,'admin/removed-students') !== false ? 'active' : '' ?>">
        🗑 Removed Students
    </a>

    <a href="<?= base_url('admin/companies') ?>"
        class="<?= strpos($currentUrl,'admin/companies') !== false ? 'active' : '' ?>">
        💼 Companies
    </a>

    <a href="<?= base_url('admin/drives') ?>"
        class="<?= strpos($currentUrl,'admin/drives') !== false ? 'active' : '' ?>">
        🚀 Placement Drives
    </a>

    <a href="<?= base_url('admin/applications') ?>"
        class="<?= strpos($currentUrl,'admin/applications') !== false ? 'active' : '' ?>">
        📝 Applications
    </a>

    <div class="menu-divider"></div>

    <div class="menu-heading">
        Monitoring
    </div>

    <a href="<?= base_url('super-admin/activity-logs') ?>"
        class="<?= strpos($currentUrl,'super-admin/activity-logs') !== false ? 'active' : '' ?>">
        📜 Activity Logs
    </a>

    <div class="menu-divider"></div>

    <div class="menu-heading">
        System
    </div>

    <a href="<?= base_url('logout') ?>">
        🚪 Logout
    </a>

</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const sidebar = document.getElementById("superAdminSidebar");

    // Restore scroll position
    const scrollPosition = localStorage.getItem("superAdminSidebarScroll");

    if (scrollPosition !== null) {
        sidebar.scrollTop = scrollPosition;
    }

    // Save scroll position
    sidebar.addEventListener("scroll", function () {
        localStorage.setItem(
            "superAdminSidebarScroll",
            sidebar.scrollTop
        );
    });

});
</script>