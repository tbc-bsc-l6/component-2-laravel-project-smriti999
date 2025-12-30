@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md">
        <div class="p-6 text-center border-b">
            <h2 class="text-xl font-bold">Old Student Panel</h2>
        </div>
        <nav class="mt-6">
            <a href="{{ route('oldstudent.dashboard') }}" class="block py-2 px-6 hover:bg-gray-200">Dashboard</a>
            {{-- Add more links if needed --}}
        </nav>
    </aside>

    {{-- Main content --}}
    <main class="flex-1 p-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Welcome, {{ $oldStudent->name }}</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- Completed Modules --}}
        <section>
            <h2 class="text-xl font-semibold mb-4">Completed Modules</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($completedModules as $module)
                    <div class="bg-white shadow rounded p-4">
                        <h3 class="font-bold text-lg">{{ $module->module }}</h3>
                        <p>Status: 
                            @if($module->pivot->pass_status)
                                <span class="text-green-600 font-bold">{{ strtoupper($module->pivot->pass_status) }}</span>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </p>
                        <p>Enrolled at: {{ \Carbon\Carbon::parse($module->pivot->enrolled_at)->format('d M Y') }}</p>
                        @if($module->pivot->completed_at)
                            <p>Completed at: {{ \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y') }}</p>
                        @endif
                    </div>
                @empty
                    <p>No completed modules found.</p>
                @endforelse
            </div>
        </section>
    </main>
</div>
@endsection
