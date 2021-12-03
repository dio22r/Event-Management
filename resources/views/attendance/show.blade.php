@extends('layouts.nomenu')

@section('title', 'Daftar Hadir')

@section('content')

<div class="container-fluid">
    <h3 class="text-center mt-3 mb-0">{{ $event->name }}</h3>
    <p class="text-center"><strong>{{ $event->location }}</strong> // {{ $event->start_at }} </p>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Scan Barcode <i class="bi bi-upc-scan"></i>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Daftar Peserta <i class="bi bi-upc-scan"></i>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
