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
    <input type="email" name="email" placeholder="Teacher Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <button type="submit">Add</button>
</form>

<hr>

<h2>All Teachers</h2>
@if($teachers->count() > 0)
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Teacher Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
        <tr>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->email }}</td>
            <td>
                <form method="POST" action="{{ route('admin.removeTeacher', $teacher->id) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Remove this teacher completely?')">Remove</button>
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

<h2>Assign Teacher to Module</h2>
<form method="POST" action="{{ route('admin.assignTeacherSubmit') }}">
    @csrf
    <select name="module_id" required>
        <option value="">Select Module</option>
        @foreach($modules as $module)
            <option value="{{ $module->id }}">{{ $module->module }}</option>
        @endforeach
    </select>

    <select name="teacher_id" required>
        <option value="">Select Teacher</option>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
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
