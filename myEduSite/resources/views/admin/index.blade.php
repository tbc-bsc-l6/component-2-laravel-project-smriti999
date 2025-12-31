@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Modules</h1>

<a href="{{ route('admin.modules.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
    Add Module
</a>

@if(session('success'))
    <p class="text-green-600 mb-4">{{ session('success') }}</p>
@endif

<table class="min-w-full border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2 text-left">ID</th>
            <th class="border px-4 py-2 text-left">Module Name</th>
            <th class="border px-4 py-2 text-left">Status</th>
            <th class="border px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($modules as $module)
        <tr>
            <td class="border px-4 py-2">{{ $module->id }}</td>
            <td class="border px-4 py-2">{{ $module->module }}</td>
            <td class="border px-4 py-2">
                @if($module->is_available)
                    <span class="text-green-600 font-semibold">Available</span>
                @else
                    <span class="text-red-600 font-semibold">Unavailable</span>
                @endif
            </td>
            <td class="border px-4 py-2 space-x-2">
                <!-- Edit -->
                <a href="{{ route('admin.modules.edit', $module->id) }}" class="text-blue-600 underline">Edit</a>

                <!-- Delete -->
                <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                </form>

                <!-- Toggle availability -->
                <form action="{{ route('admin.modules.toggle', $module->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-gray-700 underline">
                        @if($module->is_available)
                            Make Unavailable
                        @else
                            Make Available
                        @endif
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
