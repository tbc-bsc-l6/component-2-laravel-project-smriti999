@extends('layouts.app')

@section('title','Teacher Dashboard')

@section('content')
<h1>Teacher Dashboard</h1>

<h2>Modules Assigned</h2>
@foreach($modules as $module)
    <div>
        <p>{{ $module->name }}</p>
        <a href="{{ route('teacher.students', $module->id) }}">View Students</a>
    </div>
@endforeach
@endsection
