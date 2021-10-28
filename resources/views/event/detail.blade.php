@extends('layouts.main')

@section('title', 'Detail Product')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Event
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Nama Kegiatan</dt>
                        <dd class="col-sm-8">{{ $event->name }}</dd>

                        <dt class="col-sm-4">Waktu</dt>
                        <dd class="col-sm-8">
                            {{ $event->start_at }}
                        </dd>

                        <dt class="col-sm-4">Lokasi</dt>
                        <dd class="col-sm-8">
                            {{ $event->location }}
                        </dd>

                        <dt class="col-sm-4">Deskripsi</dt>
                        <dd class="col-sm-8">
                            {{ $event->description }}
                        </dd>

                        <dt class="col-sm-4">Total Kehadiran</dt>
                        <dd class="col-sm-8">
                            -
                        </dd>
                    </dl>
                </div>
            </div>
            <a href="{{ url('/event') }}" class="btn btn-sm btn-light">Kembali</a>
            <a href="{{ url('/attendance/' . $event->key ) }}" class="btn btn-sm btn-primary">Daftar Hadir</a>
        </div>
    </div>
</div>


@endsection
