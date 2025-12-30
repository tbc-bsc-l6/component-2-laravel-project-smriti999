@extends('teacher.layout')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @forelse($modules as $module)
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-700">{{ $module->name }}</h2>
                <span class="text-sm text-gray-500">Module ID: {{ $module->id }}</span>
            </div>

            @if($module->students->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Student</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Enrolled At</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Completed At</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($module->students as $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $student->name }}</td>
                                <td class="px-4 py-2">{{ $student->email }}</td>
                                <td class="px-4 py-2">{{ $student->pivot->created_at->format('d M, Y') }}</td>
                                <td class="px-4 py-2 capitalize">{{ $student->pivot->status ?? 'Not set' }}</td>
                                <td class="px-4 py-2">{{ $student->pivot->completed_at ? $student->pivot->completed_at->format('d M, Y H:i') : '-' }}</td>
                                <td class="px-4 py-2">
                                    <form method="POST" action="{{ route('teacher.student.status', [$module->id, $student->id]) }}" class="flex space-x-2">
                                        @csrf
                                        <select name="status" class="border rounded px-2 py-1">
                                            <option value="pass" @if($student->pivot->status==='pass') selected @endif>Pass</option>
                                            <option value="fail" @if($student->pivot->status==='fail') selected @endif>Fail</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-150">
                                            Set
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 mt-2">No students assigned to this module yet.</p>
            @endif
        </div>
    @empty
        <p class="text-center text-gray-400 text-lg">No modules assigned yet.</p>
    @endforelse
@endsection
