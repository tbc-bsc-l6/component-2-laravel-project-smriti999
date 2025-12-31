@extends('layouts.app')

@section('pagetitle','Create Blog Page')
@section('content')

<h1>Create a New Blog</h1>

<form method="POST" action="{{ route('blogs.store') }}">
    @csrf

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="{{ old('title') }}" required><br>
    @error('title')
        <div style="color:red">{{ $message }}</div>
    @enderror

    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author" value="{{ old('author') }}" required><br>
    @error('author')
        <div style="color:red">{{ $message }}</div>
    @enderror

    <label for="content">Content:</label><br>
    <textarea id="content" name="content" required>{{ old('content') }}</textarea><br>
    @error('content')
        <div style="color:red">{{ $message }}</div>
    @enderror

    <button type="submit">Submit</button>
</form>

<a href="{{ route('blogs.index') }}">Back to Blog List</a>

@endsection
