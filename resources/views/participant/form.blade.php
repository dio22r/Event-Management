@extends('layouts.main')

@section('title', 'Form Product')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Tambah Participant
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)


                <div class="row mb-3">
                    <label for="category_id" class="col-sm-2 col-form-label">Tipe</label>
                    <div class="col-sm-3">
                        <select name="mh_participant_type_id" class="form-select" aria-label="Default select example">
                            @foreach ($participant_types as $type)
                            @if ($type->id == $participant->mh_participant_type_id)
                            <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                            @else
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('mh_participant_type_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $participant->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $participant->address }}">
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="contact" class="col-sm-2 col-form-label">Kontak</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ $participant->contact }}">
                        @error('contact')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="detail" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ $participant->description }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="detail" class="col-sm-2 col-form-label">Custom Title</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('custom_title') is-invalid @enderror" name="custom_title" id="custom_title" value="{{ $participant->custom_title }}">
                        @error('custom_title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ url('/participant') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
