@extends('admin.layout')

@section('content')
<h1 style="margin-bottom: 20px;">Assign Teacher</h1>

<!-- Session Messages -->
@if(session('success'))
    <div style="margin-bottom: 15px; padding: 10px; color: #065f46; background-color: #d1fae5; border-radius: 6px;">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div style="margin-bottom: 15px; padding: 10px; color: #7f1d1d; background-color: #fee2e2; border-radius: 6px;">
        {{ session('error') }}
    </div>
@endif

<hr style="margin: 20px 0; border-color: #ccc;">

<!-- Add Teacher Form -->
<h2>Add Teacher</h2>
<form method="POST" action="{{ route('admin.addTeacher') }}" 
      style="display: flex; flex-direction: column; gap: 10px; max-width: 400px; background-color: rgb(245, 195, 203); padding: 20px; border-radius: 10px; margin-bottom: 30px;">
    @csrf
    <input name="name" placeholder="Teacher Name" required style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
    <input type="email" name="email" placeholder="Teacher Email" required style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
    <input type="password" name="password" placeholder="Password" required style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
    <button type="submit" style="background-color: #2c2c2c; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer;">
        Add
    </button>
</form>

<hr style="margin: 20px 0; border-color: #ccc;">

<!-- All Teachers Table -->
<h2>All Teachers</h2>
@if($teachers->count() > 0)
    <div style="overflow-x: auto; margin-bottom: 30px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
            <thead style="background-color: rgba(0,0,0,0.1);">
                <tr>
                    <th style="padding: 10px; text-align: left;">Teacher Name</th>
                    <th style="padding: 10px; text-align: left;">Email</th>
                    <th style="padding: 10px; text-align: left;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                    <tr style="background-color: rgba(255,255,255,0.6);">
                        <td style="padding: 10px;">{{ $teacher->name }}</td>
                        <td style="padding: 10px;">{{ $teacher->email }}</td>
                        <td style="padding: 10px;">
                            <form method="POST" action="{{ route('admin.removeTeacher', $teacher->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Remove this teacher completely?')"
                                        style="background-color: #dc2626; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer;">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No teachers added yet</p>
@endif

<hr style="margin: 20px 0; border-color: #ccc;">

<!-- Assign Teacher to Module Form -->
<h2>Assign Teacher to Module</h2>
<form method="POST" action="{{ route('admin.assignTeacherSubmit') }}" 
      style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 30px;">
    @csrf
    <select name="module_id" required style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="">Select Module</option>
        @foreach($modules as $module)
            <option value="{{ $module->id }}">{{ $module->module }}</option>
        @endforeach
    </select>

    <select name="teacher_id" required style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="">Select Teacher</option>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
        @endforeach
    </select>

    <button type="submit" style="background-color: #2c2c2c; color: white; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;">
        Assign
    </button>
</form>

<hr style="margin: 20px 0; border-color: #ccc;">

<!-- Assigned Teachers and Students Table -->
<h2>Assigned Teachers & Students</h2>
@foreach($modules as $module)
    <h3>{{ $module->module }}</h3>
    <div style="overflow-x: auto; margin-bottom: 30px; background-color: rgb(245, 195, 203); padding: 15px; border-radius: 10px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
            <thead style="background-color: rgba(0,0,0,0.1);">
                <tr>
                    <th style="padding: 10px; text-align: left;">Teacher Name</th>
                    <th style="padding: 10px; text-align: left;">Action</th>
                    <th style="padding: 10px; text-align: left;">Students Assigned</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $teacherCount = max($module->teachers->count(), 1);
                    $studentCount = max($module->students->count(), 1);
                    $rows = max($teacherCount, $studentCount);
                @endphp
                @for($i = 0; $i < $rows; $i++)
                    <tr style="background-color: rgba(255,255,255,0.6);">
                        <td style="padding: 10px;">
                            @isset($module->teachers[$i])
                                {{ $module->teachers[$i]->name }}
                            @endisset
                        </td>
                        <td style="padding: 10px;">
                            @isset($module->teachers[$i])
                                <form method="POST" action="{{ route('admin.removeTeacherFromModule', [$module->id, $module->teachers[$i]->id]) }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Remove this teacher from this module?')" 
                                            style="background-color: #dc2626; color: white; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer;">
                                        Remove
                                    </button>
                                </form>
                            @endisset
                        </td>
                        <td style="padding: 10px;">
                            @isset($module->students[$i])
                                {{ $module->students[$i]->name }}
                                <form method="POST" action="{{ route('admin.modules.students.remove', [$module->id, $module->students[$i]->id]) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Remove this student?')" 
                                            style="background-color: #dc2626; color: white; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer;">
                                        Remove
                                    </button>
                                </form>
                            @endisset
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endforeach
@endsection
