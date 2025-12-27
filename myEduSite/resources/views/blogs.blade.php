@extends('layouts.app')

@section('pagetitle','Blog ListPage')
@section('content')

@foreach($blogs as $blog)

   <h2> Post Title:
   <a href="/blog/{{ $blog->slug }}"> {{ $blog-> title}} </a>
   </h2>
   <p>Post Content:{{ $blog->content }}</p>
    <a href="/blog/{{ $blog->slug }}">Read More</a>
    <a href="/blog/{{ $blog->slug }}/edit">Edit this Post</a>
    @can('delete-blog',$blog)
    <form method="POST" action="/blog/{{ $blog->slug }}/delete" style="display:inline;">
    @csrf
    @method("DELETE")
    <button type="submit" onclick="return confirm('Are you sure?');">Delete this Post</button>
    </form>
    @endcan
   <hr>
@endforeach

@endsection