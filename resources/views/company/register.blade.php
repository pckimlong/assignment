@extends('layouts.auth')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 px-0">
            <div class="login-container">
                <div class="login-header mb-3">
                    <h3><img src="{{asset('images/logo/JobPosting.png')}}" width="50px;" alt="">Create your free company account</h3>
                    <p class="text-muted">Register with basic information, Complete your company profile and start post a job!</p>
                </div>
                <div class="login-form">
                    <form action="{{route('company.register')}}" method="POST">
                        @csrf
                        {{-- email --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                            <input id="email" type="email" placeholder="E-mail address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        {{-- password --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                            <input id="password_confirmation" type="password" placeholder="Password(Repeat)" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn primary-btn btn-block">Company Register</button>
                    </form>
                    <div class="my-3">
                        <p>Already have an account? <a href="{{ route('company.login') }}">Login now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
.login-poster {
    /* fallback */
   background-image: url('{{asset("images/login-background.png")}}');
    background-image: linear-gradient(
            to bottom,
            rgba(0, 0, 0, 0.5),
            rgba(0, 0, 0, 0.35)
        ),
        url('{{asset("images/login-background.png")}}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}
</style>
@endpush
