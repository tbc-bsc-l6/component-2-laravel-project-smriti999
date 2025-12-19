@extends('layouts.app')

@section('pagetitle','Create Blog Page')
@section('content')

<h1>Create a new blog</h1>
<form method="POST" action="/blogs">
     @csrf  
    <label for="title">Tittle:</label><br>
    <input type="text" id="title" name="title"required><br>

    @error('title')
    <div>{{ $message }}</div>
    @enderror

    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author"required><br>

     @error('author')
    <div>{{ $message }}</div>
    @enderror

    <label for="content">Content:</label><br>
    <textarea id="content"  name="content"></textarea><br>

     @error('content')
    <div>{{ $message }}</div>
    @enderror
    <input type="submit" value="Submit">
</form>

@endsection