@extends('admin.layout')

@section('content')
<h1>Add Module</h1>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.store') }}" method="POST">
    @csrf
    <label>Module Name:</label>
    <input type="text" name="module" required>
    <button type="submit">Add</button>
</form>

<a href="{{ route('admin.index') }}">Back to list</a>
@endsection
