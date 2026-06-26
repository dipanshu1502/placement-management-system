<!DOCTYPE html>
<html>

<head>

    <title>Student Portal</title>

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
            margin-bottom: 20px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.08);
        }

        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1101;
            border: none;
            background: #4f46e5;
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,.2);
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 768px) {

            .main {
                margin-left: 0 !important;
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

    <button class="mobile-menu-btn"
        onclick="toggleStudentSidebar()">
        ☰
    </button>

    <div class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="toggleStudentSidebar()">
    </div>