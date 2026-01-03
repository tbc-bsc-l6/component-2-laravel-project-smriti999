@extends('teacher.layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Your Modules</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($modules as $module)
        <div class="p-4 border rounded shadow hover:shadow-lg">
            <h2 class="text-xl font-semibold">{{ $module->name }}</h2>
            <p>{{ $module->description }}</p>
            <a href="{{ route('teacher.modules.students', $module->id) }}" class="text-blue-500 mt-2 inline-block">View Students</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
