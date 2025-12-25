
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - MyEduSite</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
        <a href="{{ route('admin.modules.create') }}">Add Module</a> |
        <a href="{{ route('admin.assignTeacher') }}">Assign Teacher</a> |
        <a href="{{ route('admin.changeRole') }}">Change User Role</a> |
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
