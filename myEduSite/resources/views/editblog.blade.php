@extends('layouts.app')

@section('pagetitle','Edit Blog Page')
@section('content')

<h1>Edit Blog</h1>

<form method="POST" action="{{ route('blogs.update', $blog) }}">
    @csrf
    @method('PUT')

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required><br>

    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author" value="{{ old('author', $blog->author_name) }}" required><br>

    <label for="content">Content:</label><br>
    <textarea id="content" name="content" required>{{ old('content', $blog->content) }}</textarea><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('blogs.index') }}">Back to Blog List</a>

@endsection
