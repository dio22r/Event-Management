@extends('layouts.main')

@section('css')

@endsection

@section('title', 'Detail Participant')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Participant
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8">{{ $participant->name }}</dd>

                        <dt class="col-sm-4">Tipe / Status</dt>
                        <dd class="col-sm-8">
                            {{ $participant->mh_participant_type->name }} /
                            <strong class="@if($participant->paid_status == 1) text-success @else text-danger @endif">
                                {{ $participant->formatStatusLunas() }}
                            </strong>
                        </dd>

                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">{{ $participant->address }}</dd>

                        <dt class="col-sm-4">Kontak</dt>
                        <dd class="col-sm-8">{{ $participant->contact }}</dd>

                        <dt class="col-sm-4">Deskripsi</dt>
                        <dd class="col-sm-8">{{ $participant->description }}</dd>

                        <dt class="col-sm-4">Kostum Title</dt>
                        <dd class="col-sm-8">{{ $participant->custom_title }} <i>(Khusus Untuk Tipe Tamu)</i></dd>


                        <dt class="col-sm-4">Akomodasi</dt>
                        <dd class="col-sm-8">
                            @if (count($participant->th_accomodations) > 0)
                            <a href="{{ url('/accomodation/' . $participant->th_accomodations[0]->id ) }}">
                                {{ $participant->th_accomodations[0]->location }}
                                <i>(Kamar: {{ $participant->th_accomodations[0]->room }})</i>
                            </a>
                            @else
                            -
                            @endif
                        </dd>
                    </dl>

                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-light">Kembali</a>


                    @if ($participant->paid_status == 1)

                    @can("update", $participant)
                    <div class="btn-group " role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Print ID Card
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item" target="_blank" href="{{ url('participant/'.$participant->id.'/print_idcard?align=left') }}">Rata Kiri</a></li>
                            <li><a class="dropdown-item" target="_blank" href="{{ url('participant/'.$participant->id.'/print_idcard') }}">Tengah</a></li>
                            <li><a class="dropdown-item" target="_blank" href="{{ url('participant/'.$participant->id.'/print_idcard?align=right') }}">Rata Kanan</a></li>
                        </ul>
                    </div>
                    @endcan

                    @else

                    @can("create", App\ThPayment)
                    <a href="{{ url('/payment/create?mh_participant_id[]=' . $participant->id ) }}" class="btn btn-sm btn-warning">Bayar</a>
                    @endcan

                    @endif

                    @if (count($participant->th_payments) > 0)
                    <a href="{{ url('/payment/' . $participant->th_payments[0]->id ) }}" class="btn btn-sm btn-warning">Lihat Pembayaran</a>
                    @endif

                </div>
                <div class="col-md-6 my-3 m-md-0">
                    <style>
                        .container-amplop {
                            display: flex;
                            justify-content: center;
                        }

                        .warper-amplop {
                            position: relative;
                        }

                        .qrcode-img {
                            position: absolute;
                            top: 270px;
                            left: 118px;
                            width: 115px;
                        }

                        .logo-img {
                            position: absolute;
                            width: 12px;
                            transform: rotate(-90deg);
                            top: 172px;
                            left: 301px;
                        }

                        .amplop-label {
                            position: absolute;
                            bottom: 30px;
                            font-size: 20px;
                            font-weight: bold;
                            width: 100%;
                            text-align: center;
                        }

                        .amplop-label-type {
                            position: absolute;
                            top: 105px;
                            font-size: 20px;
                            font-weight: bold;
                            width: 100%;
                            text-align: center;
                            font-family: sans-serif;
                        }

                        .amplop-label-id {
                            position: absolute;
                            bottom: -4px;
                            font-size: 10px;
                            width: 100%;
                            text-align: center;
                            font-family: sans-serif;
                        }

                        .amplop-label-ket {
                            position: absolute;
                            bottom: 15px;
                            font-size: 15px;
                            width: 100%;
                            text-align: center;
                            font-family: sans-serif;
                        }
                    </style>

                    <div class="container-amplop">
                        <div class="warper-amplop">
                            <img class="amplop-img" width="350px" src="{{ url("/assets/img/template-idcard/".$participant->mh_participant_type->template) }}" />
                            <img class="qrcode-img" width="147px" src="{{ $qrcode->render(url("/idcard/".$participant->key)) }}" alt="QR Code" />
                            <p class="amplop-label">{{ $participant->name }}</p>
                            <?php if ($participant->mh_participant_type->id == 2) { ?>
                                <p class="amplop-label-type">{{ strtoupper($participant->custom_title) }}</p>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
