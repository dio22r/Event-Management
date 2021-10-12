@extends('layouts.main')

@section('title', 'Daftar Product')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Produk
        </div>
        <div class="card-body">
            <a href="{{ url('/product/form') }}" class="btn btn-sm btn-primary">Tambah</a>
            <table class="table caption-top">
                <caption>List of Product</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kategory</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td><a href="{{ url("/product/" . $product->id) }}">{{ $product->name }}</a></td>
                        <td>{{ $product->formatPrice() }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <form method="POST" action="{{ url('/product/' . $product->id) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ url('/product/form/' . $product->id) }}" class="btn btn-sm btn-success">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger ">Delete</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
