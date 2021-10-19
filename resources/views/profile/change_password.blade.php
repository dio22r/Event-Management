@extends('layouts.main')

@section('title', 'Form User')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Ganti Password
        </div>
        <div class="card-body">
            <form method="post" action="">
                @csrf

                <div class="row mb-3">
                    <label for="old_password" class="col-sm-2 col-form-label">Password Lama</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" value="">
                        @error('old_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="re_password" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('re_password') is-invalid @enderror" id="re_password" name="re_password" value="">
                        @error('re_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ url('/profile') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
