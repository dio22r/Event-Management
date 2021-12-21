@extends('layouts.nomenu')

@section('title', 'Daftar Hadir')

@section('content')
<div class="container">
    <h3 class="text-center my-3">Halo! {{ $participant->name }}</h3>
    <!-- <p class="text-center"><strong>{{ $participant->location }}</strong></p> -->
    <p class="text-center">Berikut Daftar Kegiatan yang anda ikuti selama event ini</p>

    <div class=" row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Daftar Kegiatan <i class="bi bi-upc-scan"></i>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <a class="btn btn-warning" target="_blank" href="{{ url('/idcard/'.$participant->key.'/print') }}">
                            Print Idcard
                        </a>
                    </div>
                    <div class="table-responsive my-3">
                        <table class="table table-sm table-bordered table-hover">
                            <tr>
                                <th class="text-center" width="5%">No.</th>
                                <th class="text-center" width="30%">Nama</th>
                                <th class="text-center" width="25%">Lokasi</th>
                                <th class="text-center" width="20%">Waktu</th>
                                <th class="text-center" width="20%">Tiba</th>
                            </tr>
                            @foreach($events as $event)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <th>{{$event->name}}</th>
                                <td>{{$event->location}}</td>
                                <td>{{$event->start_at}}</td>
                                <td>{{$event->time_log}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                    <div>
                        {{ $events->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
