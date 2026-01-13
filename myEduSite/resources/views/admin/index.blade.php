@extends('admin.layout')

@section('content')
    <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 20px;">Modules</h1>

    <!-- Add Module Button -->
    <a href="{{ route('admin.modules.create') }}" 
       style="background-color: #2c2c2c; color: white; padding: 8px 16px; border-radius: 5px; margin-bottom: 20px; display: inline-block;">
        Add Module
    </a>

    <!-- Success Message -->
    @if(session('success'))
        <div style="margin-bottom: 20px; padding: 10px; background-color: #d1fae5; color: #065f46; border-radius: 6px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Responsive Table Wrapper -->
    <div style="overflow-x: auto; background-color: rgb(245, 195, 203); padding: 15px; border-radius: 10px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 700px;">
            <thead style="background-color: rgba(0,0,0,0.1);">
                <tr>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">ID</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">Module Name</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">Status</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                    <tr style="background-color: rgba(255,255,255,0.6);">
                        <td style="border: 1px solid #ccc; padding: 10px;">{{ $module->id }}</td>
                        <td style="border: 1px solid #ccc; padding: 10px;">{{ $module->module }}</td>
                        <td style="border: 1px solid #ccc; padding: 10px;">
                            @if($module->is_available)
                                <span style="color: #065f46; font-weight: 600;">Available</span>
                            @else
                                <span style="color: #7f1d1d; font-weight: 600;">Unavailable</span>
                            @endif
                        </td>
                        <td style="border: 1px solid #ccc; padding: 10px; display: flex; flex-wrap: wrap; gap: 10px;">
                            <!-- Edit -->
                            <a href="{{ route('admin.modules.edit', $module->id) }}" 
                               style="color: #2563eb; text-decoration: underline; padding: 4px 8px; border-radius: 4px; background-color: #e0e7ff;">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        style="background-color: #dc2626; color: white; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer;" 
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>

                            <!-- Toggle availability -->
                            <form action="{{ route('admin.modules.toggle', $module->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        style="background-color: #2c2c2c; color: white; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer;">
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
    </div>
@endsection
