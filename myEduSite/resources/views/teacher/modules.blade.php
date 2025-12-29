@extends('teacher.layout')

@section('title','Teacher Dashboard')

@section('content')
<h1>Teacher Dashboard</h1>

@if($modules->count())
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Module Name</th>
                <th>Description</th>
                <th>Students</th>
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
