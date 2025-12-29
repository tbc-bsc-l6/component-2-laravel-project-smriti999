@extends('layouts.app')

@section('content')
<h1>Welcome, {{ $teacher->name }}</h1>

@foreach($modules as $module)
    <h3>{{ $module->name }}</h3>
    <table border="1">
        <tr>
            <th>Student</th>
            <th>Result</th>
            <th>Action</th>
        </tr>
        @foreach($module->students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->pivot->result ?? 'Not Set' }}</td>
            <td>
                <form method="POST" action="{{ route('teacher.setResult', ['module' => $module->id, 'student' => $student->id]) }}">
                    @csrf
                    <select name="result">
                        <option value="PASS">PASS</option>
                        <option value="FAIL">FAIL</option>
                    </select>
                    <button type="submit">Set</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endforeach
@endsection
