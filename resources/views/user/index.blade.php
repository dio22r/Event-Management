@extends('layouts.main')

@section('title', 'Daftar User')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar User
        </div>
        <div class="card-body">
            <a href="{{ url('/user/form') }}" class="btn btn-sm btn-primary">Tambah</a>
            <table class="table caption-top">
                <caption>List of User</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td><a href="{{ url("/user/" . $user->id) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                            {{ $role->name }},
                            @endforeach
                        </td>
                        <td>
                            <form method="POST" action="{{ url('/user/' . $user->id) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ url('/user/form/' . $user->id) }}" class="btn btn-sm btn-success">Edit</a>
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
