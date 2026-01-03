@extends('admin.layout')

@section('content')
    <h1 style="margin-bottom: 15px;">Change User Role</h1>

    <p style="margin-bottom: 20px; color: #555;">
        Manage user access by updating their assigned roles. Changes take effect immediately.
    </p>

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

    <!-- Responsive Table Wrapper -->
    <div style="overflow-x: auto; background-color: rgb(245, 195, 203); padding: 20px; border-radius: 10px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 700px;">
            <thead>
                <tr style="background-color: rgba(0,0,0,0.1);">
                    <th style="padding: 10px; text-align: left;">Name</th>
                    <th style="padding: 10px; text-align: left;">Email</th>
                    <th style="padding: 10px; text-align: left;">Current Role</th>
                    <th style="padding: 10px; text-align: left;">Change Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr style="background-color: rgba(255,255,255,0.6);">
                        <td style="padding: 10px;">{{ $user->name }}</td>
                        <td style="padding: 10px;">{{ $user->email }}</td>
                        <td style="padding: 10px;">
                            {{ optional($user->userRole)->role ?? 'No Role' }}
                        </td>
                        <td style="padding: 10px;">
                            <form method="POST" action="{{ route('admin.changeRole') }}"
                                  style="display: flex; gap: 8px; flex-wrap: wrap;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <select name="role_id" required
                                        style="padding: 6px; border-radius: 4px; border: 1px solid #ccc;">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->user_role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->role }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit"
                                        style="background-color: #2c2c2c; color: white; padding: 6px 14px; border-radius: 4px; border: none; cursor: pointer;">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
