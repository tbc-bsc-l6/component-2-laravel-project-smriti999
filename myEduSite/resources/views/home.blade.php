@extends('layouts.app')

@section('content')

<!-- FULL SCREEN IMAGE -->
<section class="w-full h-screen">
    <img src="{{ asset('images/home1.png') }}" alt="Rose School" class="w-full h-full object-cover">
</section>
<!-- ABOUT PREVIEW -->
<!-- ABOUT PREVIEW -->
<section class="about-preview">
    <div class="container">
        <!-- Text Content -->
        <div class="about-text">
            <h1 class="about-title">The Rose College</h1>
            <p class="about-paragraph">
                The Rose College stands out for its exceptional academic programs, highly qualified faculty, 
                and a nurturing environment that fosters growth, creativity, and leadership in every student.
            </p>
            <a href="{{ route('about') }}" class="learn-more-btn">
                Learn More
            </a> 
        </div>
</section>


<!-- BLOG SECTION -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto max-w-6xl">
        <h2 class="text-3xl font-bold text-center text-rose-600 mb-10">
            Latest Blogs
        </h2>

        <div class="blog-grid grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogs as $blog)
                <div class="blog-card p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-2xl font-semibold mb-3 text-rose-600">
                        {{ $blog->title }}
                    </h3>
                    <p class="text-gray-700 mb-4">
                        {{ Str::limit($blog->content, 120) }} <!-- short preview -->
                    </p>
                    <a href="{{ url('/blog/'.$blog->id) }}" 
                       class="text-white bg-rose-600 px-4 py-2 rounded hover:bg-rose-700 transition inline-block">
                        Read More →
                    </a>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">
                    No blogs available.
                </p>
            @endforelse
        </div>

        <!-- ADD BLOG FORM -->
        @auth
        <div class="mt-12">
            <h3 class="text-xl font-semibold mb-4 text-rose-600">Add Blog</h3>

            @if(session('success'))
                <p class="text-green-600 mb-3">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('blogs.store') }}">
                @csrf

                <input type="text" name="title"
                       class="w-full mb-4 p-2 border rounded"
                       placeholder="Blog Title">

                <textarea name="content" rows="4"
                          class="w-full mb-4 p-2 border rounded"
                          placeholder="Blog Content"></textarea>

                <button class="bg-rose-600 text-white px-4 py-2 rounded hover:bg-rose-700 transition">
                    Publish Blog
                </button>
            </form>
        </div>
        @endauth
    </div>
</section>
<br><br>

<!-- CALL TO ACTION -->
<section class="bg-rose-600 text-white py-16 text-center">
    <h2 class="text-3xl font-bold mb-4">
        Enroll Your Child at The Rose School
    </h2>
    <p class="mb-6">
        Building a strong foundation for lifelong learning.
    </p>
    <a href="{{ route('contact') }}"
       class="bg-rose text-rose-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
        Contact Us
    </a>
</section>

@endsection
