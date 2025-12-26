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
@if($teachers->count() > 0)
    <ul>
        @foreach($teachers as $teacher)
            <li>{{ $teacher->name }}</li>
        @endforeach
    </ul>
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
                <form method="POST" action="{{ route('admin.removeTeacher', [$module->id, $teacher->id]) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button>Remove</button>
                </form>
            </li>
        @empty
            <li>No teachers assigned</li>
        @endforelse
    </ul>
@endforeach
@endsection
