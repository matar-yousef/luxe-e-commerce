@extends('dashboard.layouts.master')

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Product: {{ $product->name }}</h3>
    </div>
    
    <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <div class="card-body">
            @include('dashboard.products.form')     
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Update Product</button>
            <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>
@endsection