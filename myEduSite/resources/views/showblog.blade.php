@extends('layouts.app')

@section('pagetitle','Single Blog Page')
@section('content')

<h1>{{ $blog->title }}</h1>
<p><strong>Author:</strong> {{ $blog->author_name }}</p>
<hr>
<p>{!! $blog->content !!}</p> <!-- Correct: no semicolon -->

<a href="{{ route('blogs.index') }}" class="btn btn-secondary">← Back to Blog List</a>

@auth
    @if(auth()->user()->user_role_id == 1)
        <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-primary">Edit</a>

        <form method="POST" action="{{ route('blogs.destroy', $blog) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this blog?');" class="btn btn-danger">
                Delete
            </button>
        </form>
    @endif
@endauth

@endsection
