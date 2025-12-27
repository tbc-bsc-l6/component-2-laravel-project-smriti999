@extends('teacher.layout')

@section('title','Teacher Dashboard')

@section('content')
<h1>Teacher Dashboard</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<h2>Modules Assigned</h2>
@if($modules->count() > 0)
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:10px;">
        <thead>
            <tr>
                <th>Module Name</th>
                <th>Description</th>
                <th>Assigned Students</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modules as $module)
            <tr>
                <td>{{ $module->module }}</td>
                <td>{{ $module->description ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('teacher.modules.students', $module->id) }}">
                        View Students ({{ $module->students->count() }})
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No modules assigned yet.</p>
@endif
@endsection
