@extends('oldstudent.layout')

@section('content')
<div class="max-w-5xl mx-auto py-6">
    <!-- Welcome Message -->
    <div class="mb-6 text-gray-700 text-lg">
        Welcome, <span class="font-semibold">{{ auth()->guard('oldstudent')->user()->name }}</span>!
    </div>

    <!-- Completed Modules Card -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Completed Modules & Results</h2>

        @php
            $oldStudent = auth()->guard('oldstudent')->user();
            $modules = $oldStudent->completedModules()->get();
        @endphp

        @if($modules->count())
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 border text-left">Module</th>
                            <th class="p-3 border text-left">Status</th>
                            <th class="p-3 border text-left">Completed On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modules as $module)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border">{{ $module->module }}</td>
                                <td class="p-3 border font-semibold
                                    {{ $module->pivot->status === 'passed' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ strtoupper($module->pivot->status) }}
                                </td>
                                <td class="p-3 border">
                                    {{ $module->pivot->completed_at
                                        ? \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y')
                                        : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600">No completed modules found.</p>
        @endif
    </div>
</div>
@endsection
