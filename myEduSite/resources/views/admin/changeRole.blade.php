@extends('admin.layout')

@section('content')
<h1>Change User Role</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Current Role</th>
        <th>Change Role</th>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name ?? 'No Role' }}</td>
            <td>
                <form method="POST" action="{{ route('admin.changeRole') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <select name="role_id" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
