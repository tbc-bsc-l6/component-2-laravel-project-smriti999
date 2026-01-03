<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Old Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Sidebar scrollbar */
        aside::-webkit-scrollbar {
            width: 6px;
        }
        aside::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,0.2);
            border-radius: 3px;
        }

        /* Sidebar fixed bottom logout */
        .sidebar-footer { margin-top: auto; }
    </style>
</head>
<body class="bg-pink-100 font-sans">

<!-- Mobile header -->
<div class="flex items-center justify-between bg-white shadow-md p-4 fixed w-full z-50 md:hidden">
    <span class="font-bold text-xl">Old Student Panel</span>
    <button id="menu-btn" class="text-2xl font-bold">&#9776;</button>
</div>

<div class="flex min-h-screen pt-16 md:pt-0">

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 w-64 bg-white shadow-md h-full flex flex-col z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300">
        <div class="p-6 font-bold text-xl border-b hidden md:block">
            Old Student Panel
        </div>

        <!-- Nav -->
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="{{ route('oldstudent.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 font-semibold">
                Dashboard
            </a>
        </nav>

        <!-- Logout -->
        <div class="sidebar-footer p-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600 font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden z-40 md:hidden"></div>

    <!-- Main Content -->
    <main class="flex-1 ml-0 md:ml-64 p-4 md:p-6 overflow-auto" style="min-height: 100vh;">
        @yield('content')
    </main>
</div>

<script>
    // Toggle sidebar on mobile
    const menuBtn = document.getElementById('menu-btn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    menuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>

</body>
</html>
