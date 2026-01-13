@extends('student.layout')

@section('content')
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Welcome, {{ $student->name }}</h1>
    </div>

    {{-- SEARCH BAR (SMALL BOX WITH Q BUTTON) --}}
    <div class="mb-6 flex justify-end">
        <div class="relative">
            <input
                type="text"
                id="moduleSearch"
                placeholder="Search modules..."
                class="w-64 pl-10 pr-10 py-2 border rounded shadow focus:outline-none focus:ring"
            >
            {{-- Q BUTTON --}}
            <button
                id="searchButton"
                type="button"
                class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-2 py-1 rounded"
            >Q</button>
        </div>
    </div>

    {{-- API SEARCH RESULTS --}}
    <div id="moduleResults" class="mb-6"></div>

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
            <div class="module-item bg-white shadow rounded p-4 mb-2">
                <h3 class="font-bold text-lg module-name">{{ $module->module }}</h3>
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
            <div class="module-item bg-white shadow rounded p-4 mb-2">
                <h3 class="font-bold text-lg module-name">
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
            <form method="POST"
                  action="{{ route('student.enroll', $module->id) }}"
                  class="module-item mb-2 flex justify-between items-center bg-white shadow p-4 rounded">
                @csrf
                <div>
                    <p class="font-bold module-name">{{ $module->module }}</p>
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

    {{-- SEARCH SCRIPT (API BASED) --}}
    <script>
        const searchInput = document.getElementById('moduleSearch');
        const resultsDiv = document.getElementById('moduleResults');
        const searchButton = document.getElementById('searchButton');

        function searchModules() {
            const query = searchInput.value;

            fetch(`/api/modules/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(modules => {
                    resultsDiv.innerHTML = '';

                    if (modules.length === 0) {
                        resultsDiv.innerHTML = '<p class="text-gray-500">No modules found.</p>';
                        return;
                    }

                    modules.forEach(module => {
                        const div = document.createElement('div');
                        div.className = 'module-item bg-white shadow rounded p-4 mb-2 flex justify-between items-center';

                        div.innerHTML = `
                            <div>
                                <p class="font-bold">${module.module}</p>
                                <p class="text-sm text-gray-500">Students: ${module.active_students_count} / 10</p>
                            </div>
                        `;
                        resultsDiv.appendChild(div);
                    });
                });
        }

        // Live search while typing
        searchInput.addEventListener('keyup', searchModules);

        // Search when Q button clicked
        searchButton.addEventListener('click', searchModules);
    </script>
@endsection
