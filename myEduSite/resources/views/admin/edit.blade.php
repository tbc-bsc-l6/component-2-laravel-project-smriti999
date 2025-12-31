@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Module</h1>

@if ($errors->any())
    <ul class="mb-4 text-red-600">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.modules.update', $module->id) }}" method="POST" class="mb-4">
    @csrf
    @method('PUT')
    
    <label for="module" class="block mb-2 font-semibold">Module Name:</label>
    <input 
        type="text" 
        name="module" 
        id="module" 
        value="{{ old('module', $module->module) }}" 
        required
        class="border border-gray-300 rounded px-3 py-2 w-full mb-4"
    >
    
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Update Module
    </button>
</form>

<a href="{{ route('admin.modules.index') }}" class="text-blue-500 hover:underline">
    Back to list
</a>
@endsection
