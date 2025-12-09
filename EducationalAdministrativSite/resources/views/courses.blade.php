@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">Courses</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="p-4 border rounded shadow hover:shadow-lg transition duration-200">
        <h3 class="font-bold text-xl mb-2">Course 1</h3>
        <p class="text-gray-600">This is a brief description of Course 1. Learn amazing things here!</p>
        <a href="#" class="mt-3 inline-block text-blue-500 hover:underline">View Course</a>
    </div>

    <div class="p-4 border rounded shadow hover:shadow-lg transition duration-200">
        <h3 class="font-bold text-xl mb-2">Course 2</h3>
        <p class="text-gray-600">This is a brief description of Course 2. Improve your skills easily!</p>
        <a href="#" class="mt-3 inline-block text-blue-500 hover:underline">View Course</a>
    </div>

    <div class="p-4 border rounded shadow hover:shadow-lg transition duration-200">
        <h3 class="font-bold text-xl mb-2">Course 3</h3>
        <p class="text-gray-600">This is a brief description of Course 3. Explore and learn more!</p>
        <a href="#" class="mt-3 inline-block text-blue-500 hover:underline">View Course</a>
    </div>
</div>

@endsection
