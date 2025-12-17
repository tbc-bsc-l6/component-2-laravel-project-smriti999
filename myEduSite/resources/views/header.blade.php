<header class="bg-blue-600 text-white p-4">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="font-bold text-xl">EduSite</a>
        <nav>
            <a href="{{ route('home') }}" class="mr-4">Home</a>
            <a href="{{ route('courses') }}" class="mr-4">Courses</a>
            <a href="{{ route('about') }}" class="mr-4">About</a>
            <a href="{{ route('contact') }}" class="mr-4">Contact</a>
        </nav>
    </div>
</header>
