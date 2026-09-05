@extends('dashboard.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Users Management</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined Date</th>
                    @if(auth()->user()->role === UserRole::ADMIN)
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role === UserRole::ADMIN)
                        <span class="badge badge-danger">Admin</span>
                        @elseif($user->role === UserRole::EDITOR)
                        <span class="badge badge-info">Editor</span>
                        @else
                        <span class="badge badge-secondary">User</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    @if(auth()->user()->role === UserRole::ADMIN)
                    <td>
                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-user-edit"></i> Edit
                        </a>

                        @if($user->id !== auth()->id())
                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="fas fa-user-times"></i> Delete
                            </button>
                        </form>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection