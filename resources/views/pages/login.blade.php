@extends('layout.main')

@section('content')
    <div class="container text-center pt-4">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <img class="img-fluid pb-3" src="{{ asset('logo/Logo.png') }}" alt="" width="240px" height="200px">
        <div class="d-flex justify-content-center mt-4">
            <div class="card bg-light mb-2" style="width: 60%;">
                <div class="card-body mb-3">
                    <div class="card-title"><img src="{{ asset('logo/sign in.png') }}" alt="" width="180px"></div>
                </div>
                <div class="col align-self-center" style="width: 80%">
                    <form action="{{ route('authLogin') }}" method="POST">
                        @csrf

                            <div class="form-floating mb-4">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" name="email">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                    <div class="invalid-feedback" style="text-align: left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-5">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2 mb-2" style="width: 50%">Sign In</button><br>
                            <div class="mb-3">
                                Don't have account? <a href="{{ route('signup') }}">Sign Up</a>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
