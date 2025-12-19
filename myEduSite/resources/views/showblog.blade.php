@extends('layouts.testlayout')

@section('pagetitle','Single Blog Page')
@section('content')


<h2>Post Title: {{$blog->title}}  </h2>
<span>Posted By:{{$blog->author_name }}</span>
<hr/>
<p>Post Body:<br/>{{ $blog->content }}</p>

<a href="/blogs" >Back to Blog List</a>

@endsection