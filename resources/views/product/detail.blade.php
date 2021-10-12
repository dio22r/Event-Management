@extends('layouts.main')

@section('title', 'Detail Product')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Produk
        </div>
        <div class="card-body">
            <h5>{{ $product->name }}</h5>
            <h3>{{ $product->formatPrice() }}</h3>
            <p>{{ $product->detail }}</p>
            <a href="{{ url('/product') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


@endsection
