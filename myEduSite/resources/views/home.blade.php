@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="bg-blue-600 text-white py-10 text-center">
    <h1 class="text-4xl font-bold">Welcome to EduSite</h1>
    <p class="mt-3 text-lg">Learn anytime, anywhere with top instructors.</p>
    <a href="/courses" class="mt-5 inline-block bg-white text-blue-600 px-6 py-3 rounded">
        Browse Courses
    </a>
</section>

<!-- Featured Courses Section (Static) -->
<section class="container mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Featured Courses</h2>

    <div class="grid grid-cols-3 gap-6">
        <!-- Example static courses -->
        <div class="p-4 border rounded shadow">
            <h3 class="font-bold">Laravel Basics</h3>
            <p>Learn Laravel from scratch with hands-on examples.</p>
        </div>

        <div class="p-4 border rounded shadow">
            <h3 class="font-bold">PHP OOP</h3>
            <p>Master object-oriented programming in PHP for modern applications.</p>
        </div>

        <div class="p-4 border rounded shadow">
            <h3 class="font-bold">JavaScript Essentials</h3>
            <p>Get started with JavaScript and learn to create dynamic web pages.</p>
        </div>
    </div>
</section>

@endsection
