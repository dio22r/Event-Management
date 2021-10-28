@extends('layouts.main')

@section('title', 'Daftar Kegiatan')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Kegiatan
        </div>
        <div class="card-body">
            <a href="{{ url('/event/create') }}" class="btn btn-sm btn-primary">Tambah</a>
            <table class="table caption-top">
                <caption>List of Event</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td><a href="{{ url("/event/" . $event->id) }}">{{ $event->name }}</a></td>
                        <td>{{ $event->start_at }}</td>
                        <td>{{ $event->location }}</td>
                        <td>
                            <form method="POST" action="{{ url('/event/' . $event->id) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ url('/event/' . $event->id . '/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                <button onClick="return confirm('Anda yakin akan menghapus data ini?')" type="submit" class="btn btn-sm btn-danger ">Delete</button>
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
