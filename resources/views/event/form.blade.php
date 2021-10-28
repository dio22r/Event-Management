@extends('layouts.main')

@section('title', 'Form Kegiatan')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Tambah Kegiatan
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $event->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="date" class="col-sm-2 col-form-label">Waktu</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $event->date }}">
                        @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ $event->time }}">
                        @error('time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="location" class="col-sm-2 col-form-label">Lokasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ $event->location }}">
                        @error('location')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Detail</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ $event->description }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ url('/event') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
