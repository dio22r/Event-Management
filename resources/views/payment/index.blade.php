@extends('layouts.main')

@section('title', 'Pembayaran')

@section('content')

<div class="container my-3">

    <div class="card">
        <div class="card-header">
            Daftar Pembayaran
        </div>
        <div class="card-body">


            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/payment/create') }}" class="btn btn-sm btn-primary">Tambah</a>
                </div>
                <div class="col-md-3 offset-3 text-right">

                    <form action="{{ url('/payment') }}" method="GET">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Filter . . ." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('search') }}">
                            <button class="btn btn-success" type="submit" id="button-addon2">Cari!</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table caption-top">
                <caption>Data Pembayaran</caption>
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="30%">Detail</th>
                        <th scope="col" width="20%">Waktu Pembayaran</th>
                        <th scope="col" width="15%">Total</th>
                        <th scope="col" width="20%">Participant</th>
                        <th scope="col" width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td><a href="{{ url("/payment/" . $payment->id) }}">{{ $payment->detail }}</a></td>
                        <td>{{ $payment->created_at }}</td>
                        <td>{{ $payment->formatTotal() }}</td>
                        <td>

                            @foreach ($payment->mh_participants as $participant)
                            <a href="{{ url('/participant/'.$participant->id) }}">{{ $participant->name }}</a><br />
                            @endforeach
                        </td>
                        <td>
                            <form method="POST" action="{{ url('/payment/' . $payment->id) }}">
                                @method('DELETE')
                                @csrf
                                <!-- <a href="{{ url('/payment/' . $payment->id . '/edit') }}" class="btn btn-sm btn-success">Edit</a> -->
                                <button type="submit" onclick="return confirm('Apakah anda ingin menghapus data ini?')" class="btn btn-sm btn-danger ">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


            {{ $payments->links() }}
        </div>
    </div>
</div>

@endsection
