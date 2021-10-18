@extends('layouts.main')

@section('title', 'Pembayaran')

@section('content')

<div class="container my-3">

    <div class="card">
        <div class="card-header">
            Daftar Pembayaran
        </div>
        <div class="card-body">



            <a href="{{ url('/payment/create') }}" class="btn btn-sm btn-primary">Tambah</a>

            <table class="table caption-top">
                <caption>Data Pembayaran</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Detail</th>
                        <th scope="col">Total</th>
                        <th scope="col">Participant</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td><a href="{{ url("/payment/" . $payment->id) }}">{{ $payment->detail }}</a></td>
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


        </div>
    </div>
</div>

@endsection
