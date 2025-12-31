<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Teacher Portal</h2>
            <nav class="space-y-2">
                <a href="{{ route('teacher.dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600 font-medium">Logout</button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Welcome, {{ auth()->user()->name }}</h1>
            <span class="text-gray-500">{{ now()->format('d M, Y') }}</span>
        </div>

        @yield('content')
    </main>
<a href="{{ route('about') }}
</div>

</body>
</html>
