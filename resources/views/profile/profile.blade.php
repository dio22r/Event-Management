@extends('layouts.main')

@section('title', 'Profile')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">Nama</dt>
                <dd class="col-sm-10">
                    <h5>{{ Auth::user()->name }}</h5>
                </dd>

                <dt class="col-sm-2">Email</dt>
                <dd class="col-sm-10">{{ Auth::user()->email }}</dd>

                <dt class="col-sm-2">User Role</dt>
                <dd class="col-sm-10">
                    <ul>
                        @foreach (Auth::user()->roles as $role)
                        <li>{{ $role->name }}</li>
                        @endforeach
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
</div>


@endsection
