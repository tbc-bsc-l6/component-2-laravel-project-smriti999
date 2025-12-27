@extends('layouts.app')

@section('pagetitle','Single Blog Page')
@section('content')


<h2>Post Title: {{$blog->title}}  </h2>
<span>Posted By:{{$blog->author_name }}</span>
<hr/>
<p>Post Body:<br/>{{ $blog->content }}</p>


<a href="{{ url('/') }}" class="text-blue-600 hover:underline mt-4 inline-block">
    ← Back to Blog List
</a>

@endsection