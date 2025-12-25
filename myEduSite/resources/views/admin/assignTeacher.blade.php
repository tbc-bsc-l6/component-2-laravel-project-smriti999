@extends('admin.layout')

@section('content')

<h1>Assign Teacher</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<h2>Add Teacher</h2>
<form method="POST" action="{{ route('admin.addTeacher') }}">
    @csrf
    <input name="name" placeholder="Name" required>
    <input name="email" placeholder="Email" required>
    <button>Add</button>
</form>

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

    <button>Assign</button>
</form>

<hr>

<h2>Assigned Teachers</h2>
@foreach($modules as $module)
    <h3>{{ $module->module }}</h3>
    <ul>
        @forelse($module->teachers as $teacher)
            <li>
                {{ $teacher->name }}
                <form method="POST"
                      action="{{ route('admin.removeTeacher', [$module->id, $teacher->id]) }}"
                      style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button>Remove</button>
                </form>
            </li>
        @empty
            <li>No teachers</li>
        @endforelse
    </ul>
@endforeach

@endsection
