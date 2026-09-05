@use('App\Enums\UserRole')

@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">

                <div style="flex: 1;">
                    <h3 class="card-title">Categories List</h3>
                </div>

                <div class="d-flex justify-content-center" style="flex: 2;">
                    <x-search-bar placeholder="Search categories..." />
                </div>

                <x-page-actions
                    :trashRoute="route('dashboard.categories.trash')"
                    :createRoute="route('dashboard.categories.create')"
                    createLabel="Add New Category" />
            </div>

            <div class="card-body table-responsive p-0">
                @if($categories->count() > 0)
                <x-table :headers="['ID', 'Category Name', 'Slug', 'Created At', 'Actions']">
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at->format('Y-m-d') }}</td>
                        <td>
                            <x-action-buttons
                                :editRoute="route('dashboard.categories.edit', $category->id)"
                                :deleteRoute="route('dashboard.categories.destroy', $category->id)" />
                        </td>
                    </tr>
                    @endforeach
                </x-table>
                @else
                <div class="text-center p-5">
                    <i class="fas fa-folder-open fa-5x text-gray-200 mb-3"></i>
                    <h4 class="text-muted">No categories found!</h4>
                    <p>Start by creating your first category to organize your products.</p>
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">
                        Add Category Now
                    </a>
                </div>
                @endif
            </div>

            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $categories->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    window.onload = function() {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'OK',
            timer: 2000,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    };
</script>
@endif
@endsection