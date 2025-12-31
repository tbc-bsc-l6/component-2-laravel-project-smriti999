@extends('admin.layout')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    {{-- CREATE MODULE --}}
    <h2 class="text-2xl font-bold mb-4">Create New Module</h2>

    <form action="{{ route('modules.store') }}" method="POST" class="bg-white p-4 shadow rounded mb-8">
        @csrf

        <div class="mb-3">
            <label class="block font-semibold">Module Name:</label>
            <input type="text" name="name" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Description:</label>
            <textarea name="description" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Teacher:</label>
            <select name="teacher_id" required class="w-full border p-2 rounded">
                <option value="">-- Select Teacher --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_available" value="1" checked>
                <span class="ml-2">Available</span>
            </label>
        </div>

        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Create Module
        </button>
    </form>

    {{-- ALL MODULES LIST --}}
    <h2 class="text-2xl font-bold mb-4">All Modules</h2>

    @foreach($modules as $module)
        <div class="bg-white p-4 shadow mb-3 rounded">
            <h3 class="font-bold text-lg">{{ $module->module }}</h3>

            <p>Students: {{ $module->students_count }} / 10</p>

            <p>Status:
                @if($module->is_available)
                    <span class="text-green-600 font-semibold">Active</span>
                @else
                    <span class="text-gray-500 font-semibold">Archived</span>
                @endif
            </p>
        </div>
    @endforeach

</div>
@endsection
