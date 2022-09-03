@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-4 mx-auto">
                    <b>Available Roles u can login with: </b>
                    <div class="d-flex flex-column align-items-center mb-4 fs-6">
                        <div class="d-flex flex-column mt-2">
                            <div>Student:</div>
                            <div class="ml-4">
                                <div>
                                    <b class="mr-2">email:</b> student@school.com
                                </div>
                                <div>
                                    <b class="mr-2">password:</b> password
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-2">
                            <div>Teacher:</div>
                            <div class="ml-4">
                                <div>
                                    <b class="mr-2">email:</b> teacher@school.com
                                </div>
                                <div>
                                    <b class="mr-2">password:</b> password
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-2">
                            <div>Director:</div>
                            <div class="ml-4">
                                <div>
                                    <b class="mr-2">email:</b> director@school.com
                                </div>
                                <div>
                                    <b class="mr-2">password:</b> password
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection