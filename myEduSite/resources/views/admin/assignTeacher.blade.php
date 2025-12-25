@extends('admin.layout')

@section('content')

<h2>Assign Teacher</h2>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

{{-- Module selector (GET request) --}}
<form method="GET" action="{{ route('admin.assignTeacher') }}">
    <label>Select Module:</label>
    <select name="module_id" onchange="this.form.submit()">
        <option value="">-- Select Module --</option>
        @foreach($modules as $module)
            <option value="{{ $module->id }}" {{ isset($selectedModule) && $selectedModule->id == $module->id ? 'selected' : '' }}>
                {{ $module->module }}
            </option>
        @endforeach
    </select>
</form>

@if(isset($selectedModule))
    <h3>Module: {{ $selectedModule->module }}</h3>

    {{-- Attach teacher (POST request) --}}
    <form action="{{ route('admin.assignTeacherSubmit') }}" method="POST">
        @csrf
        <input type="hidden" name="module_id" value="{{ $selectedModule->id }}">
        <select name="teacher_id" required>
            <option value="">-- Select Teacher --</option>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
        <button type="submit">Attach Teacher</button>
    </form>

    <h4>Attached Teachers</h4>
    <ul>
        @forelse($selectedModule->teachers as $teacher)
            <li>
                {{ $teacher->name }}
                <form action="{{ route('admin.removeTeacher', [$selectedModule->id, $teacher->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Remove this teacher?')">Remove</button>
                </form>
            </li>
        @empty
            <li>No teachers attached yet.</li>
        @endforelse
    </ul>
@endif

@endsection
