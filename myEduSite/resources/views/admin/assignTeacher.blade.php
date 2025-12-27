@extends('admin.layout')

@section('content')
<h1>Assign Teacher</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<hr>

<h2>Add Teacher</h2>
<form method="POST" action="{{ route('admin.addTeacher') }}">
    @csrf
    <input name="name" placeholder="Teacher Name" required>
    <button type="submit">Add</button>
</form>


<h2>All Teachers</h2>
@if($users->count() > 0)
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Teacher Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form method="POST" action="{{ route('admin.removeTeacher', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Remove this teacher completely?')">Remove</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No teachers added yet</p>
@endif
<hr>


<hr>

<h2>Assign Teacher to Module</h2>
<form method="POST" action="{{ route('admin.assignTeacherSubmit') }}">
    @csrf
    <select name="module_id" required>
        <option value="">Select Module</option>
        @foreach($modules as $module)
            <option value="{{ $module->id }}">{{ $module->module }}</option>
        @endforeach
    </select>

    <select name="user_id" required>
        <option value="">Select Teacher</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <button type="submit">Assign</button>
</form>

<hr>

<h2>Assigned Teachers</h2>
@foreach($modules as $module)
    <h3>{{ $module->module }}</h3>
    <ul>
        @forelse($module->teachers as $teacher)
            <li>
                {{ $teacher->name }}
                <!-- CORRECT ROUTE NAME -->
                <form method="POST" action="{{ route('admin.removeTeacherFromModule', [$module->id, $teacher->id]) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Remove this teacher from this module?')">Remove</button>
                </form>
            </li>
        @empty
            <li>No teachers assigned</li>
        @endforelse
    </ul>
@endforeach

@endsection
