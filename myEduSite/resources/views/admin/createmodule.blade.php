@extends('layouts.app')

@section('title','Create Module')

@section('content')
<h1>Create New Module</h1>

<form action="{{ route('modules.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>
    
    <label>Description:</label>
    <textarea name="description"></textarea>
    
    <button type="submit">Create Module</button>
</form>
@endsection
