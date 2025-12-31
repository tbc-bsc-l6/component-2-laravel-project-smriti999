@extends('admin.layout')

@section('content')
<h1>Add Module</h1>

@if ($errors->any())
    <ul class="text-red-600">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.modules.store') }}" method="POST" class="space-y-4 mt-4">
    @csrf
    <label for="module" class="block font-medium">Module Name:</label>
    <input type="text" name="module" id="module" required
           class="border p-2 w-full rounded">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Module</button>
</form>

<a href="{{ route('admin.modules.index') }}" class="inline-block mt-4 text-blue-600 underline">
    Back to list
</a>
@endsection
