@extends('teacher.layout')

@section('title','Module Students')

@section('content')
<h1>Students in {{ $module->module }}</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($students->count() > 0)
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>PASS/FAIL</th>
                <th>Completed At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->pivot->pass_status ?? '-' }}</td>
                <td>{{ $student->pivot->completed_at ?? '-' }}</td>
                <td>
                    <form method="POST" action="{{ route('teacher.modules.students.status', [$module->id, $student->id]) }}">
                        @csrf
                        <select name="pass_status" required>
                            <option value="">-- Select Status --</option>
                            <option value="PASS">PASS</option>
                            <option value="FAIL">FAIL</option>
                        </select>
                        <button type="submit">Set</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No students enrolled yet.</p>
@endif
@endsection
