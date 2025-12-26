<h2>Add Teacher</h2>
<form method="POST" action="{{ route('admin.addTeacher') }}">
    @csrf
    <input name="name" placeholder="Teacher Name" required>
    <button>Add</button>
</form>

<h2>Assign Teacher to Module</h2>
<form method="POST" action="{{ route('admin.assignTeacherSubmit') }}">
    @csrf
    <select name="module_id" required>
        <option value="">Select Module</option>
        @foreach($modules as $module)
            <option value="{{ $module->id }}">{{ $module->module }}</option>
        @endforeach
    </select>

    <select name="user_id" required>
        <option value="">Select Teacher</option>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
        @endforeach
    </select>

    <button>Assign</button>
</form>

<h2>Assigned Teachers</h2>
@foreach($modules as $module)
    <h3>{{ $module->module }}</h3>
    <ul>
        @forelse($module->teachers as $teacher)
            <li>
                {{ $teacher->name }}
                <form method="POST" action="{{ route('admin.removeTeacher', [$module->id, $teacher->id]) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button>Remove</button>
                </form>
            </li>
        @empty
            <li>No teachers assigned</li>
        @endforelse
    </ul>
@endforeach
