@extends('layouts.main')

@section('title', 'Form Product')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Tambah Produk
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $product->price }}">
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="detail" class="col-sm-2 col-form-label">Detail</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" id="detail">{{ $product->detail }}</textarea>
                        @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="category_id" class="col-sm-2 col-form-label">Kategory</label>
                    <div class="col-sm-10">
                        <select name="category_id" class="form-select" aria-label="Default select example">
                            @foreach ($categories as $category)
                            @if ($category->id == $product->category_id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ url('/product') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
