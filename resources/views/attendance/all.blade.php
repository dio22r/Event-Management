@extends('layouts.nomenu')

@section('title', 'Daftar Hadir')

@section('content')
<div id="app-vue">
    <div class="container-fluid">
        <h3 class="text-center mt-3 mb-0">{{ $event->name }}</h3>
        <p class="text-center"><strong>{{ $event->location }}</strong> // {{ $event->start_at }} </p>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Daftar Peserta <i class="bi bi-upc-scan"></i>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ url('/attendance/' . $event->key) }}">
                            Kembali
                        </a>
                        <div class="table-responsive my-3">
                            <table class="table table-sm table-bordered table-hover">
                                <tr>
                                    <th class="text-center" width="10%">No.</th>
                                    <th class="text-center" width="30%">Nama</th>
                                    <th class="text-center" width="25%">Alamat</th>
                                    <th class="text-center" width="20%">Waktu Datang</th>
                                    <th class="text-center" width="15%">Status</th>
                                </tr>

                                @foreach($participants as $participant)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <th>{{$participant->name}}</th>
                                    <td>{{$participant->address}}</td>
                                    <td>{{$participant->time_log}}</td>
                                    <td class="text-center">

                                        @if ($participant->mh_participant_type_id == 1)
                                        <span v-if="item.mh_participant_type_id == 1" class="badge bg-warning">Panitia</span>
                                        @elseif ($participant->mh_participant_type_id == 1)
                                        <span v-if="item.mh_participant_type_id == 2" class="badge bg-danger">Tamu</span>
                                        @else
                                        <span v-if="item.mh_participant_type_id == 3" class="badge bg-primary">Peserta</span>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                        <div>
                            {{ $participants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
