@use('App\Enums\UserRole')

@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div style="flex: 1;">
                        <h3 class="card-title">Products List</h3>
                    </div>
                    <div class="d-flex justify-content-center" style="flex: 2;">
                        <x-search-bar placeholder="Search products..." />
                    </div>

                    <x-page-actions
                        :trashRoute="route('dashboard.products.trash')"
                        :createRoute="route('dashboard.products.create')"
                        createLabel="Add New Product" />

                </div>
            </div>
            <div class="card-body table-responsive p-0">
                @if($products->count() > 0)
                <x-table :headers="['ID', 'Name', 'Description', 'Price', 'Stock', 'Created At', 'Actions']">

                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ Str::limit($product->description, 30) }}</td> {{-- عرض جزء بسيط من الوصف --}}
                        <td><span class="badge badge-success">{{ $product->price }} $</span></td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->created_at->format('Y-m-d') }}</td>
                        <td>
                            <x-action-buttons
                                :editRoute="route('dashboard.products.edit', $product->id)"
                                :deleteRoute="route('dashboard.products.destroy', $product->id)" />
                        </td>
                    </tr>
                    @endforeach

                </x-table>
                @else
                <div class="text-center p-5">
                    <i class="fas fa-box-open fa-5x text-gray-200 mb-3"></i>
                    <h4 class="text-muted">No products found!</h4>
                    <p>It seems your inventory is empty. Start by adding your first product.</p>
                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary btn-lg">
                        Add Product Now
                    </a>
                </div>
                @endif
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $products->links() }}
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