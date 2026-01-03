@extends('oldstudent.layout')

@section('content')
<div class="max-w-5xl mx-auto">

    <!-- Show logged-in old student name above the box -->
    <div class="mb-4 text-gray-700 text-lg md:text-xl">
        Welcome, <span class="font-semibold">{{ auth()->guard('oldstudent')->user()->name }}</span>!
    </div>

    <!-- Content Box -->
    <div class="bg-white shadow rounded p-4 md:p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Completed Modules & Results</h2>

        @if(isset($modules) && $modules->count())
            <div class="overflow-x-auto">
                <table class="w-full border-collapse min-w-[400px] md:min-w-[500px]">
                    <thead>
                        <tr class="bg-gray-100 text-left text-sm md:text-base">
                            <th class="p-2 md:p-3 border">Module</th>
                            <th class="p-2 md:p-3 border">Status</th>
                            <th class="p-2 md:p-3 border">Completed On</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm md:text-base">
                        @foreach($modules as $module)
                            <tr class="hover:bg-gray-50">
                                <td class="p-2 md:p-3 border">{{ $module->module }}</td>
                                <td class="p-2 md:p-3 border font-semibold {{ $module->pivot->status === 'passed' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ strtoupper($module->pivot->status) }}
                                </td>
                                <td class="p-2 md:p-3 border">{{ $module->pivot->completed_at ?? '—' }}</td>
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
