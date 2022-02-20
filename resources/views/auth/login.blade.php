@extends('layouts.nomenu')

@section('css')

<link href="{{ url("/assets/css/login.css") }}" rel="stylesheet">

@endsection

@section('title', 'Login')

@section('content')


<div class="container my-3">

    <main class="form-signin">

        <form class="text-center" method="post" action="{{ $action_url }}">
            @csrf
            <img class="mb-4" src="{{ url("/assets/svg/bootstrap-logo.svg") }}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" placeholder="email@email.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

        </form>
    </main>
</div>


@endsection
