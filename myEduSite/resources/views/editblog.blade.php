@extends('layouts.testlayout')

@section('pagetitle','Edit Blog Page')
@section('content')

<h1>Edit this blog</h1>
<form method="POST" action="/blog/{{ $blog->slug }}/edit">
     @csrf  
     @method('PUT')
    <label for="title">Tittle:</label><br>
    <input type="text" id="title" name="title" value="{{ $blog->title }}"><br>
    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author" value="{{ $blog->author_name }}"><br>
    <label for="content">Content:</label><br>
    <textarea id="content"  name="content" >{{ $blog->content }}</textarea><br>
    <input type="submit" value="Submit">
</form>

@endsection