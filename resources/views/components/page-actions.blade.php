@use('App\Enums\UserRole')
@props([
'trashRoute',
'createRoute',
'createLabel' => 'Add New'
])

<div class="card-tools d-flex justify-content-end" style="flex: 1;">
    @if(auth()->user()->role === UserRole::ADMIN || auth()->user()->role === UserRole::EDITOR)
    <a href="{{ $trashRoute }}" class="btn btn-warning btn-sm mr-2">
        <i class="fas fa-trash-restore"></i> Trash
    </a>

    <a href="{{ $createRoute }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> {{ $createLabel }}
    </a>
    @endif
</div>