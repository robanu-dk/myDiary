@extends('layout.main')

@section('content')
    <div class="container text-center pt-4">

        <img class="img-fluid pb-3" src="{{ asset('logo/Logo.png') }}" alt="" width="240px" height="200px">
        <div class="d-flex justify-content-center mt-4">
            <div class="card bg-light mb-2" style="width: 60%;">
                <div class="card-body mb-3">
                    <div class="card-title"><img src="{{ asset('logo/sign up.png') }}" alt="" width="180px"></div>
                </div>
                <div class="col align-self-center" style="width: 80%">
                    <form action="{{ route('createAccount') }}" method="POST">
                        @csrf

                            <div class="form-floating mb-4">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName" placeholder="name" name="name" value="{{ old('name') }}">
                                <label for="floatingName">Full name</label>
                                @error('name')
                                    <div class="invalid-feedback" style="text-align: left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                    <div class="invalid-feedback" style="text-align: left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                    <div class="invalid-feedback" style="text-align: left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2 mb-2" style="width: 50%">Sign Up</button>

                            <div class="mb-3">
                                Already have account? <a href="{{ route('signin') }}">Sign In</a>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
