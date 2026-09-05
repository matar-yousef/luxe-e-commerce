@use('App\Enums\UserRole')
@props(['editRoute', 'deleteRoute'])

<div class="d-flex justify-content-center align-items-center">
    @if(auth()->user()->role->isAdmin() || auth()->user()->role->isEditor())
    <a href="{{ $editRoute }}" class="btn btn-info btn-sm mr-1" title="Edit">
        <i class="fas fa-edit"></i> Edit
    </a>
    @endif

    @if(auth()->user()->role === UserRole::ADMIN)
    <form action="{{ $deleteRoute }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm"
            onclick="return confirm('Are you sure you want to delete this?')">
            <i class="fas fa-trash"></i> Delete
        </button>
    </form>
    @endif
</div>