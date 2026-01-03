<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - MyEduSite</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- CSS ADDED ONLY -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        nav {
            width: 220px;
            background-color: rgb(245, 195, 203); /* YOUR COLOR */
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        nav a {
            color: #2c2c2c;
            text-decoration: none;
            padding: 10px 0;
            font-weight: 500;
        }

        nav a:hover {
            background-color: rgba(0, 0, 0, 0.1);
            padding-left: 10px;
            transition: 0.3s;
        }

        /* Push logout link to bottom */
        nav a:last-of-type {
            margin-top: auto;
        }

        hr {
            display: none;
        }

        .container {
            flex: 1;
            padding: 30px;
            background-color: #f4f6f8;
        }
    </style>
    <!-- CSS END -->
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a> 
        <a href="{{ route('admin.modules.create') }}">Add Module</a> 
        <a href="{{ route('admin.assignTeacher') }}">Assign Teacher</a> 
        <a href="{{ route('admin.changeRole') }}">Change User Role</a> 
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </nav>
    <hr>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
