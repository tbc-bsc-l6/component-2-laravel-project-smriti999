@extends('admin.layout')

@section('content')
    <h1 style="color: #2c2c2c;">Add New Module</h1>

    <p style="margin-top: 8px; margin-bottom: 20px; color: #555;">
        Use the form below to create a new module and add it to the system.
    </p>

    <!-- Success Message -->
    @if(session('success'))
        <div style="margin-bottom: 15px; padding: 10px; color: #065f46; background-color: #d1fae5; border-radius: 6px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <ul style="margin-bottom: 15px; color: #dc2626;">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.modules.store') }}" method="POST"
          style="max-width: 400px; background-color: rgb(245, 195, 203); padding: 20px; border-radius: 8px;">
        @csrf

        <label for="module" style="display: block; margin-bottom: 6px; font-weight: 500; color: #2c2c2c;">
            Module Name
        </label>

        <input
            type="text"
            name="module"
            id="module"
            required
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 15px;"
        >

        <button
            type="submit"
            style="background-color: #2c2c2c; color: white; padding: 8px 16px; border-radius: 4px; border: none; cursor: pointer;"
        >
            Add Module
        </button>
    </form>

    <a
        href="{{ route('admin.modules.index') }}"
        style="display: inline-block; margin-top: 20px; color: #2c2c2c; text-decoration: underline;"
    >
        ← Back to Module List
    </a>
@endsection
