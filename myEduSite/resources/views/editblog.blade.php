@extends('layouts.app')

@section('pagetitle','Edit Blog Page')
@section('content')

<h1>Edit this blog</h1>

<form method="POST" action="{{ route('blogs.update', $blog) }}">
    @csrf
    @method('PUT')

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="{{ $blog->title }}"><br>

    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author" value="{{ $blog->author_name }}"><br>

    <label for="content">Content:</label><br>
    <textarea id="content" name="content">{{ $blog->content }}</textarea><br>

    <input type="submit" value="Update">
</form>

@endsection
