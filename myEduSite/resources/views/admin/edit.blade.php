@extends('admin.layout')

@section('content')
    <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 20px;">Edit Module</h1>

    <!-- Display Errors -->
    @if ($errors->any())
        <ul style="margin-bottom: 20px; color: #dc2626;">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Edit Module Form -->
    <form action="{{ route('admin.modules.update', $module->id) }}" method="POST" 
          style="max-width: 400px; background-color: rgb(245, 195, 203); padding: 20px; border-radius: 10px; margin-bottom: 20px;">
        @csrf
        @method('PUT')
        
        <label for="module" style="display: block; font-weight: 600; margin-bottom: 6px; color: #2c2c2c;">
            Module Name:
        </label>
        <input 
            type="text" 
            name="module" 
            id="module" 
            value="{{ old('module', $module->module) }}" 
            required
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;"
        >
        
        <button type="submit" 
                style="background-color: #2c2c2c; color: white; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;">
            Update Module
        </button>
    </form>

    <!-- Back to list -->
    <a href="{{ route('admin.modules.index') }}" 
       style="color: #2c2c2c; text-decoration: underline; display: inline-block;">
        ← Back to Module List
    </a>
@endsection
