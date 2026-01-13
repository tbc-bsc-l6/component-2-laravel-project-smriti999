<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        aside::-webkit-scrollbar {
            width: 6px;
        }
        aside::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,0.2);
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-pink-100">

<!-- Mobile Header -->
<header class="bg-white shadow-md p-4 flex justify-between items-center md:hidden">
    <h1 class="font-bold text-lg">Student Panel</h1>
    <button id="menuBtn" class="text-gray-700 text-xl">☰</button>
</header>

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="bg-white shadow flex flex-col fixed inset-y-0 left-0 w-64 z-50
               transform -translate-x-full md:translate-x-0
               transition-transform duration-300">

        <!-- Header -->
        <div class="p-6 font-bold text-xl border-b hidden md:block">
            Student
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="{{ route('student.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-gray-200 font-semibold">
                Dashboard
            </a>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600 font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay (Mobile) -->
    <div id="overlay"
         class="fixed inset-0 bg-black bg-opacity-40 hidden z-40 md:hidden"></div>

    <!-- Main Content -->
    <main class="flex-1 p-6 md:ml-64 overflow-y-auto min-h-screen"
          style="background-color: rgb(245,195,203);">
        @yield('content')
    </main>

</div>

<!-- Toggle Script -->
<script>
    const menuBtn = document.getElementById('menuBtn');
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
