@extends('teacher.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Students in {{ $module->module }}</h1>

    @foreach($students as $student)
        <div class="bg-white p-4 rounded shadow mb-2 flex justify-between items-center">
            <span>{{ $student->name }} ({{ $student->email }})</span>
            <form action="{{ route('teacher.modules.students.status', [$module->id, $student->id]) }}" method="POST">
                @csrf
                <select name="status" class="border rounded p-1">
                    <option value="pass" {{ $student->pivot->status === 'pass' ? 'selected' : '' }}>PASS</option>
                    <option value="fail" {{ $student->pivot->status === 'fail' ? 'selected' : '' }}>FAIL</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">Update</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
