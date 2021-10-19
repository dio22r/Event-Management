@extends('layouts.main')

@section('css')

@endsection

@section('title', 'Detail Pembayaran')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Pembayaran
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Deskripsi</dt>
                        <dd class="col-sm-8">{{ $payment->detail }}</dd>

                        <dt class="col-sm-4">Total</dt>
                        <dd class="col-sm-8">
                            <strong>{{ $payment->formatTotal() }}</strong>
                        </dd>

                        <dt class="col-sm-4">Bank</dt>
                        <dd class="col-sm-8">{{ $payment->bank }}</dd>

                        <dt class="col-sm-4">No. Rek</dt>
                        <dd class="col-sm-8">{{ $payment->account }}</dd>
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
                            @foreach($payment->mh_participants as $participant)
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



                    <a href="{{ url('/payment') }}" class="btn btn-sm btn-light">Kembali</a>
                    <a href="{{ url('/payment') }}" class="btn btn-sm btn-success">Print</a>

                </div>
                <div class="col-md-6 my-3 m-md-0">
                    <img width="100%" src="{{ url('/storage/'.$payment->file) }}" />
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
