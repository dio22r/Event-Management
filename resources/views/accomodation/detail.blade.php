@extends('layouts.main')

@section('css')

@endsection

@section('title', 'Detail Akomodasi')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Akomodasi
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Lokasi / Hotel</dt>
                        <dd class="col-sm-8">{{ $accomodation->location }}</dd>

                        <dt class="col-sm-4">Kamar</dt>
                        <dd class="col-sm-8">
                            <strong>{{ $accomodation->room }}</strong>
                        </dd>
                    </dl>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accomodation->mh_participants as $participant)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <a href="{{ url('/participant/'. $participant->id) }}">{{ $participant->name }}</a>
                                </td>
                                <td>{{ $participant->address }}</td>
                                <td>{{ $participant->contact }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-light">Kembali</a>
                    <a href="{{ url('/payment') }}" class="btn btn-sm btn-success">Print</a>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
