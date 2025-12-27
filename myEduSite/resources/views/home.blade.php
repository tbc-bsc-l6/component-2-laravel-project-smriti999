@extends('layouts.app')
@section('content')

<!-- FULL SCREEN IMAGE -->
<section class="w-full h-screen">
    <img src="{{ asset('images/home1.png') }}" alt="Rose School" class="w-full h-full object-cover">
</section>

<!-- ABOUT PREVIEW -->
<section class="about-preview">
    <div class="container">
        <div class="about-text">
            <h1 class="about-title" style="color: rgb(245, 195, 203);">The Rose College</h1>
            <p class="about-paragraph" style="color: rgb(245, 195, 203);">
                The Rose College stands out for its exceptional academic programs, highly qualified faculty, 
                and a nurturing environment that fosters growth, creativity, and leadership in every student.
            </p>
            <a href="{{ route('about') }}" style="color: white; background-color: rgb(245, 195, 203); padding: 8px 16px; border-radius: 6px; display: inline-block; text-decoration: none;">
                Learn More
            </a> 
        </div>
    </div>
</section>

<!-- BLOG SECTION -->
<section class="py-16" style="background-color: #f5f5f5;">
    <div class="container mx-auto max-w-6xl">
        <h2 class="text-3xl font-bold text-center mb-10" style="color: rgba(246, 182, 192, 1);">
            Latest Blogs
        </h2>

        <div class="blog-grid grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogs as $blog)
                <div class="blog-card p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold mb-3" style="color: rgba(243, 169, 181, 1);">
                        {{ $blog->title }}
                    </h3>
                    <p class="mb-4" style="color: rgba(249, 211, 217, 1);">
                        {{ Str::limit($blog->content, 120) }}
                    </p>
                    <a href="{{ route('blogs.show', $blog) }}" style="color: white; background-color: rgb(245, 195, 203); padding: 8px 16px; border-radius: 6px; display: inline-block; text-decoration: none;">
                        Read More →
                    </a>
                </div>
            @empty
                <p class="text-center col-span-full" style="color: rgba(247, 169, 182, 1);">
                    No blogs available.
                </p>
            @endforelse
        </div>

        <!-- ADD BLOG FORM -->
        @auth
        <div class="mt-12">
            <a href="{{ route('blogs.create') }}" style="color: white; background-color: rgba(247, 177, 189, 1); padding: 10px 20px; border-radius: 6px; display: inline-block; text-decoration: none; transition: 0.3s;">
                + Add Blog
            </a>
        </div>
        @endauth
    </div>
</section>
<br><br>

<!-- CALL TO ACTION -->
<section style="background-color: rgba(246, 168, 181, 1); color: white; text-align: center; padding: 4rem 0;">
    <h2 class="text-3xl font-bold mb-4" style="color: white;">
        Enroll Your Child at The Rose School
    </h2>
    <p class="mb-6" style="color: white;">
        Building a strong foundation for lifelong learning.
    </p>
    <a href="{{ route('contact') }}" style="color: rgba(246, 184, 194, 1); background-color: white; padding: 12px 24px; border-radius: 8px; display: inline-block; text-decoration: none; font-weight: 600;">
        Contact Us
    </a>
</section>

@endsection
