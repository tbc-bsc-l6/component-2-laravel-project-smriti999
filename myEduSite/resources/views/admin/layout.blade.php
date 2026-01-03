<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MyEduSite</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background-color: rgb(245,195,203);
        }

        /* ===== Sidebar ===== */
        nav {
            width: 240px;
            background-color: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        nav.active {
            transform: translateX(0);
        }

        nav h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        nav a {
            color: #2c2c2c;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            font-weight: 500;
        }

        nav a:hover {
            background-color: #f1f1f1;
        }

        nav a.logout {
            margin-top: auto;
            color: #c0392b;
        }

        /* ===== Mobile Header ===== */
        .mobile-header {
            background-color: #ffffff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .menu-btn {
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
        }

        /* ===== Overlay ===== */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 900;
        }

        .overlay.active {
            display: block;
        }

        /* ===== Content ===== */
        .container {
            padding: 20px;
            min-height: 100vh;
        }

        /* ===== Desktop ===== */
        @media (min-width: 768px) {
            nav {
                transform: translateX(0);
            }

            .mobile-header {
                display: none;
            }

            .container {
                margin-left: 240px;
                padding: 30px;
            }

            .overlay {
                display: none !important;
            }
        }
    </style>
</head>

<body>

<!-- Mobile Header -->
<div class="mobile-header">
    <strong>Admin Panel</strong>
    <button class="menu-btn" onclick="toggleMenu()">☰</button>
</div>

<!-- Sidebar -->
<nav id="sidebar">
    <h2>Admin Panel</h2>

    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.modules.create') }}">Add Module</a>
    <a href="{{ route('admin.assignTeacher') }}">Assign Teacher</a>
    <a href="{{ route('admin.changeRole') }}">Change User Role</a>

    <a href="{{ route('logout') }}"
       class="logout"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</nav>

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<!-- Content -->
<div class="container">
    @yield('content')
</div>

<script>
    function toggleMenu() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('overlay').classList.toggle('active');
    }
</script>

</body>
</html>
