@extends('admin.layout')

@section('content')
<h1>Users & Roles</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role ? $user->role->name : 'No Role' }}</td>
                <td>
                    <form action="{{ route('admin.changeRole') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select name="role" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->role && $user->role->name == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit">Change Role</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
