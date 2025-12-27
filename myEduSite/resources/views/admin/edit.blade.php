@extends('admin.layout')

@section('content')
<h1>Edit Module</h1>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.update', $module->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="module" value="{{ old('module', $module->module) }}">
    <button type="submit">Update</button>
</form>

<a href="{{ route('admin.index') }}">Back to list</a>
@endsection
