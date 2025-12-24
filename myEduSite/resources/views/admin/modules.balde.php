@extends('admin.layout')

@section('content')
<h2>Create New Module</h2>

<form action="{{ route('modules.store') }}" method="POST">
    @csrf
    <div>
        <label>Module Name:</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Description:</label>
        <textarea name="description"></textarea>
    </div>

    <div>
        <label>Teacher:</label>
        <select name="teacher_id" required>
            <option value="">-- Select Teacher --</option>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Available:</label>
        <input type="checkbox" name="is_available" value="1" checked>
    </div>

    <button type="submit">Create Module</button>
</form>
@endsection