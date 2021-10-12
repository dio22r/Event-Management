@extends('layouts.main')

@section('title', 'Daftar Kategori')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Kategory
        </div>
        <div class="card-body">
            <a href="{{ url('/category/form') }}" class="btn btn-sm btn-primary">Tambah</a>
            <table class="table caption-top">
                <caption>List of Category</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td><a href="{{ url("/category/" . $category->id) }}">{{ $category->name }}</a></td>
                        <td>{{ $category->detail }}</td>
                        <td>
                            <form method="POST" action="{{ url('/category/' . $category->id) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ url('/category/form/' . $category->id) }}" class="btn btn-sm btn-success">Edit</a>
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
