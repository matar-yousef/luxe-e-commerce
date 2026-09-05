@extends('dashboard.layouts.master')

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Category: {{ $category->name }}</h3>
        </div>
        
        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT') 
            
            <div class="card-body">
                @include('dashboard.categories.form')
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info">Update Category</button>
                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

@endsection