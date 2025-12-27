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

<hr>

<h2>All Modules</h2>
@if($modules->count() > 0)
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Module Name</th>
            <th>Description</th>
            <th>Teacher</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($modules as $module)
        <tr>
            <td>{{ $module->module }}</td>
            <td>{{ $module->description }}</td>
            <td>{{ $module->teacher ? $module->teacher->name : 'N/A' }}</td>
            <td>
                @if($module->is_available)
                    <span style="color:green">Available</span>
                @else
                    <span style="color:red">Unavailable</span>
                @endif
            </td>
            <td>
                <form method="POST" action="{{ route('admin.toggleModuleAvailability', $module->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit">
                        @if($module->is_available)
                            Make Unavailable
                        @else
                            Make Available
                        @endif
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No modules created yet.</p>
@endif

@endsection
