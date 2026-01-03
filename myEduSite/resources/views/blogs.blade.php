@extends('layouts.app')

@section('content')

<h1>All Blogs</h1>

@auth
    @if(auth()->user()->user_role_id == 1)
        <a href="{{ route('blogs.create') }}" class="btn btn-primary">
            Create New Blog
        </a>
    @endif
@endauth

<hr>

@foreach($blogs as $blog)
    <h2>
        <a href="{{ route('blogs.show', $blog) }}">
            {{ $blog->title }}
        </a>
    </h2>

    <p>Author: {{ $blog->author_name }}</p>
    <p>{{ Str::limit($blog->content, 100) }}</p>

    <a href="{{ route('blogs.show', $blog) }}">Read More</a>

    @auth
        @if(auth()->user()->user_role_id == 1)
            | <a href="{{ route('blogs.edit', $blog) }}">Edit</a>

            <form method="POST"
                  action="{{ route('blogs.destroy', $blog) }}"
                  style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete?')">
                    Delete
                </button>
            </form>
        @endif
    @endauth

    <hr>
@endforeach

@endsection
