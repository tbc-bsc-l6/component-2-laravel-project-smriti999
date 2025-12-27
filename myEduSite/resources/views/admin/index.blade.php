@extends('admin.layout')

@section('content')
<h1>Modules</h1>
<a href="{{ route('admin.modules.create') }}">Add Module</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Module Name</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    @foreach($modules as $module)
    <tr>
        <td>{{ $module->id }}</td>
        <td>{{ $module->module }}</td>
        <td>
            @if($module->is_available)
                <span style="color:green">Available</span>
            @else
                <span style="color:red">Unavailable</span>
            @endif
        </td>
        <td>
            <a href="{{ route('admin.edit', $module->id) }}">Edit</a>

            <form action="{{ route('admin.destroy', $module->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>

            <!-- Toggle availability form -->
            <form action="{{ route('admin.toggleModuleAvailability', $module->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit">
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
</table>
@endsection
