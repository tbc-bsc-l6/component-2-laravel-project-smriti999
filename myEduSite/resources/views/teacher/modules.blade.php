@extends('student.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">My Modules</h1>

    @foreach($modules as $module)
        <div class="bg-white p-4 rounded shadow mb-4">
            <h2 class="font-semibold text-xl">{{ $module->module }}</h2>
            <a href="{{ route('teacher.modules.students', $module->id) }}" class="text-blue-500 mt-2 inline-block">View Students</a>
        </div>
    @endforeach
</div>
@endsection
