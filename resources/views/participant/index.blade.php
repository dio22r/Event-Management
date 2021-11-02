@extends('layouts.main')

@section('title', 'Daftar Product')

@section('content')

<div class="container my-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-3" aria-label="Eleventh navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url("/participant/?paid_status=0") }}">Belum Lunas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url("/participant/?type=3&paid_status=1") }}">Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url("/participant/?type=2&paid_status=1") }}">Tamu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url("/participant/?type=1&paid_status=1") }}">Panitia</a>
                    </li>
                </ul>
                <form action="{{ url("/participant") }}" method="GET">
                    <input class="form-control" type="hidden" name="type" value={{ request("type") }}>
                    <input class="form-control" type="hidden" name="paid_status" value={{ request("paid_status") }}>
                    <input class="form-control" type="text" placeholder="Search" name="search" aria-label="Search" value={{ request("search") }}>
                </form>
            </div>
        </div>
    </nav>

    <div class="card">
        <div class="card-header">
            Daftar Participant
        </div>
        <div class="card-body">


            @can('create', new App\MhParticipant())
            <a href="{{ url('/participant/create') }}" class="btn btn-sm btn-primary">Tambah</a>
            @endcan

            <table class="table caption-top">
                <caption>Data Seluruh Peserta</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kontak</th>
                        <th scope="col">Lunas</th>
                        <th scope="col">Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td><a href="{{ url("/participant/" . $participant->id) }}">{{ $participant->name }}</a></td>
                        <td>{{ $participant->address }}</td>
                        <td>{{ $participant->contact }}</td>
                        <td>{{ $participant->formatStatusLunas() }}</td>
                        <td>{{ $participant->mh_participant_type->name }}</td>
                        <td>
                            <form method="POST" action="{{ url('/participant/' . $participant->id) }}">
                                @method('DELETE')
                                @csrf
                                @can('update', $participant)
                                <a href="{{ url('/participant/' . $participant->id . '/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                @endcan
                                @can('delete', $participant)
                                <button type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini?')" class="btn btn-sm btn-danger ">Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $participants->links() }}
        </div>
    </div>
</div>

@endsection
