@extends('admin.layout')

@section('content')
    <h1>Welcome to the Admin Dashboard</h1>

    <p style="margin-top: 10px;">
        Hello Admin 👋 Welcome back!
    </p>

    <p style="margin-top: 8px;">
        From here, you can manage modules, assign teachers, and control user roles.
        
    </p>

    @if(session('success'))
        <div style="margin-top: 15px; color: green;">
            {{ session('success') }}
        </div>
    @endif
@endsection
