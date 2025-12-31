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
            <form action="{{ route('admin.modules.toggle', $module->id) }}" method="POST">
                @csrf
                @method('PATCH')
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



@endsection