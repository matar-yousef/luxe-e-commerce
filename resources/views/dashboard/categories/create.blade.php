@extends('dashboard.layouts.master')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Category</h3>
    </div>
    
    <form action="{{ route('dashboard.categories.store') }}" method="POST">
        @csrf
        <div class="card-body">
            @include('dashboard.categories.form')
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save Category</button>
            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection