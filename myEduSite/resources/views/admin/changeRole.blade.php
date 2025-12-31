@extends('admin.layout')

@section('content')
<h1>Change User Role</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
        {{ session('error') }}
    </div>
@endif

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Current Role</th>
            <th>Change Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ optional($user->userRole)->role ?? 'No Role' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.changeRole') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select name="role_id" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $user->user_role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->role }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
