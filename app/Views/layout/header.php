<!DOCTYPE html>
<html>

<head>

    <title>Placement Management System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            overflow-x: hidden;
        }

        .main {
            margin-left: 260px;
            padding: 20px;
            transition: all .3s ease;
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .page-header {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .table th {
            vertical-align: middle;
        }

        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1101;
            border: none;
            background: #2563eb;
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 20px;
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 768px) {

            .main {
                margin-left: 0;
                padding: 70px 15px 15px;
            }

            .mobile-menu-btn {
                display: block;
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .5);
                z-index: 998;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>

</head>

<body>

    <button class="mobile-menu-btn" onclick="toggleSidebar()">
        ☰
    </button>

    <div class="sidebar-overlay" id="sidebarOverlay"
        onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {

            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
    </script>