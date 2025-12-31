@extends('layouts.app')

@section('pagetitle','Single Blog Page')
@section('content')

<h1>{{ $blog->title }}</h1>
<p><strong>Author:</strong> {{ $blog->author_name }}</p>
<hr>
<p>{{ $blog->content }}</p>

<a href="{{ route('blogs.index') }}" class="btn btn-secondary">← Back to Blog List</a>

@auth
    <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-primary">Edit</a>
    @can('delete-blog', $blog)
        <form method="POST" action="{{ route('blogs.destroy', $blog) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure?');">Delete</button>
        </form>
    @endcan
@endauth

@endsection
