@extends('student.layout')

@section('content')
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Welcome, {{ $student->name }}</h1>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-4 p-4 text-green-700 rounded" style="background-color: rgb(220, 245, 220);">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 text-red-700 rounded" style="background-color: rgb(255, 220, 220);">
            {{ session('error') }}
        </div>
    @endif

    {{-- CURRENT MODULES --}}
    <section class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Current Modules</h2>
        @forelse($currentModules as $module)
            <div class="bg-white shadow rounded p-4 mb-2">
                <h3 class="font-bold text-lg">{{ $module->module }}</h3>
                <p>Enrolled at: {{ \Carbon\Carbon::parse($module->pivot->enrolled_at)->format('d M Y') }}</p>
                <p>Status: <span class="text-gray-500">In Progress</span></p>
            </div>
        @empty
            <p>No current modules enrolled.</p>
        @endforelse
    </section>

    {{-- COMPLETED MODULES --}}
    <section class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Completed Modules</h2>
        @forelse($completedModules as $module)
            <div class="bg-white shadow rounded p-4 mb-2">
                <h3 class="font-bold text-lg">
                    {{ $module->module }}
                    @if(!$module->is_available)
                        <span class="text-sm text-gray-500">(Archived)</span>
                    @endif
                </h3>
                <p>Completed at: {{ \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y') }}</p>
                <p>Status:
                    @if($module->pivot->status === 'passed')
                        <span class="text-green-600 font-bold">PASSED</span>
                    @else
                        <span class="text-red-600 font-bold">FAILED</span>
                    @endif
                </p>
            </div>
        @empty
            <p>No completed modules yet.</p>
        @endforelse
    </section>

    {{-- AVAILABLE MODULES --}}
    <section>
        <h2 class="text-xl font-semibold mb-4">Available Modules</h2>
        @forelse($availableModules as $module)
            <form method="POST" action="{{ route('student.enroll', $module->id) }}"
                  class="mb-2 flex justify-between items-center bg-white shadow p-4 rounded">
                @csrf
                <div>
                    <p class="font-bold">{{ $module->module }}</p>
                    <p class="text-sm text-gray-500">Students: {{ $module->active_students_count }} / 10</p>
                </div>

                @if($module->active_students_count >= 10)
                    <span class="text-red-600 font-bold">Module Full</span>
                @elseif($student->modules()->wherePivot('completed_at', null)->count() >= 4)
                    <span class="text-red-600 font-bold">Max 4 Modules Reached</span>
                @else
                    <button type="submit"
                            class="px-3 py-1 bg-black text-white rounded hover:bg-gray-800">
                        Enroll
                    </button>
                @endif
            </form>
        @empty
            <p>No available modules for enrollment.</p>
        @endforelse
    </section>
@endsection
