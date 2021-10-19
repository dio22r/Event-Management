@extends('layouts.main')

@section('title', 'Akomodasi')

@section('content')

<div class="container my-3">

    <div class="card">
        <div class="card-header">
            Data Akomodasi
        </div>
        <div class="card-body">



            <a href="{{ url('/accomodation/create') }}" class="btn btn-sm btn-primary">Tambah</a>

            <table class="table caption-top">
                <caption>Data Akomodasi</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Kamar</th>
                        <th scope="col">Participant</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accomodations as $accomodation)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td><a href="{{ url("/accomodation/" . $accomodation->id) }}">{{ $accomodation->location }}</a></td>
                        <td>{{ $accomodation->room }}</td>
                        <td>

                            @foreach ($accomodation->mh_participants as $participant)
                            - <a href="{{ url('/participant/'.$participant->id) }}">{{ $participant->name }}</a> ( {{ $participant->mh_participant_type->name }} )<br />
                            @endforeach
                        </td>
                        <td>
                            <form method="POST" action="{{ url('/accomodation/' . $accomodation->id) }}">
                                @method('DELETE')
                                @csrf
                                <!-- <a href="{{ url('/payment/' . $accomodation->id . '/edit') }}" class="btn btn-sm btn-success">Edit</a> -->
                                <button type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini?')" class="btn btn-sm btn-danger ">Delete</button>
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
