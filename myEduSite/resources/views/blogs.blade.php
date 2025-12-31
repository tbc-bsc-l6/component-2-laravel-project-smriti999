@extends('layouts.app')

@section('pagetitle', 'Blog List Page')
@section('content')

<h1>All Blogs</h1>

<a href="{{ route('blogs.create') }}" class="btn btn-primary">Create New Blog</a>

@foreach($blogs as $blog)
    <div class="blog-post" style="border-bottom:1px solid #ccc; margin-bottom:10px; padding:10px 0;">
        <h2>
            <a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a>
        </h2>
        <p>By: {{ $blog->author_name }}</p>
        <p>{{ Str::limit($blog->content, 100) }}...</p>

        <a href="{{ route('blogs.show', $blog) }}">Read More</a>

        @auth
            <a href="{{ route('blogs.edit', $blog) }}">Edit</a>

            @can('delete-blog', $blog)
                <form method="POST" action="{{ route('blogs.destroy', $blog) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            @endcan
        @endauth
    </div>
@endforeach

@endsection
