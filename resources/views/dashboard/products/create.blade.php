@extends('dashboard.layouts.master')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Product</h3>
    </div>
    
    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @include('dashboard.products.form')
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Product</button>
            <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary float-right">Back</a>
        </div>
    </form>
</div>
@endsection