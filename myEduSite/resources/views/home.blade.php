@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="bg-rose-600 text-white py-20">
    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-bold mb-4">
            The Rose School
        </h1>
        <p class="text-xl mb-6">
            Nurturing Minds • Shaping Futures
        </p>
        <a href="{{ route('about') }}"
           class="bg-white text-rose-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
            Learn More
        </a>
    </div>
</section>

<!-- ABOUT PREVIEW -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h2 class="text-3xl font-bold mb-4 text-rose-600">
                About The Rose School
            </h2>
            <p class="text-gray-700 mb-4">
                The Rose School is dedicated to providing quality education
                in a caring and disciplined environment that supports
                academic excellence and character development.
            </p>
            <a href="{{ route('about') }}" class="text-rose-600 font-semibold">
                Read More →
            </a>
        </div>

        <div class="bg-white p-8 rounded-xl shadow">
            <ul class="space-y-3 text-gray-700">
                <li>✔ Qualified & Experienced Teachers</li>
                <li>✔ Safe and Supportive Environment</li>
                <li>✔ Modern Classrooms</li>
                <li>✔ Focus on Moral Values</li>
            </ul>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="py-16">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-10 text-rose-600">
            Why Choose The Rose School
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-xl font-semibold mb-2">Academic Excellence</h3>
                <p class="text-gray-600">
                    A well-structured curriculum focused on conceptual learning.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-xl font-semibold mb-2">Holistic Development</h3>
                <p class="text-gray-600">
                    Encouraging creativity, leadership, and confidence.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-xl font-semibold mb-2">Co-Curricular Activities</h3>
                <p class="text-gray-600">
                    Sports, arts, and extracurricular programs for growth.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SCHOOL HIGHLIGHTS -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto grid md:grid-cols-4 gap-8 text-center">
        <div>
            <h3 class="text-4xl font-bold text-rose-600">500+</h3>
            <p class="text-gray-600">Students</p>
        </div>
        <div>
            <h3 class="text-4xl font-bold text-rose-600">40+</h3>
            <p class="text-gray-600">Teachers</p>
        </div>
        <div>
            <h3 class="text-4xl font-bold text-rose-600">20+</h3>
            <p class="text-gray-600">Years of Excellence</p>
        </div>
        <div>
            <h3 class="text-4xl font-bold text-rose-600">100%</h3>
            <p class="text-gray-600">Student Care</p>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="bg-rose-600 text-white py-16 text-center">
    <h2 class="text-3xl font-bold mb-4">
        Enroll Your Child at The Rose School
    </h2>
    <p class="mb-6">
        Building a strong foundation for lifelong learning.
    </p>
    <a href="{{ route('contact') }}"
       class="bg-white text-rose-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
        Contact Us
    </a>
</section>

@endsection
