@extends('admin.layout')

@section('content')
<h1>Welcome, Admin!</h1>

@if(session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif

<!-- MODULES TABLE -->
<h3>Modules</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Teacher</th>
        <th>Available</th>
        <th>Toggle</th>
    </tr>
    @foreach($modules as $module)
    <tr>
        <td>{{ $module->name }}</td>
        <td>{{ $module->teacher?->name ?? 'None' }}</td>
        <td>{{ $module->is_available ? 'Yes' : 'No' }}</td>
        <td>
            <form action="{{ route('modules.toggle', $module->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <button type="submit">Toggle</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<!-- CHANGE USER ROLE FORM -->
<h3>Change User Role</h3>
<form action="{{ route('admin.changeRole') }}" method="POST">
    @csrf
    <select name="user_id" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
        @endforeach
    </select>

    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="teacher">Teacher</option>
        <option value="student">Student</option>
        <option value="old_student">Old Student</option>
    </select>

    <button type="submit">Update Role</button>
</form>

<!-- ASSIGN TEACHER TO MODULE FORM -->
<h3>Assign Teacher to Module</h3>
<form action="{{ route('admin.assignTeacher') }}" method="POST">
    @csrf
    <select name="module_id" required>
        @foreach($modules as $module)
            <option value="{{ $module->id }}">{{ $module->name }}</option>
        @endforeach
    </select>

    <select name="teacher_id" required>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
        @endforeach
    </select>

    <button type="submit">Assign Teacher</button>
</form>

@endsection