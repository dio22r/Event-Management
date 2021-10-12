@extends('layouts.main')

@section('title', 'Detail Product')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Kategory
        </div>
        <div class="card-body">
            <h5>{{ $category->name }}</h5>
            <p>{{ $category->slug }}</p>
            <p>{{ $category->detail }}</p>
            <a href="{{ url('/category') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


@endsection
