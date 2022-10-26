@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class=" col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                            <input type="email"
                                                   class="form-control form-control-user @error('email') is-invalid @enderror "
                                                   id="email"
                                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                                   autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">

                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            <input type="password"
                                                   class="form-control form-control-user @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input"  name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="custom-control-label" for="remember">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>

                                        <a href="index.html" class="btn btn-danger btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn  btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{route('register')}}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

{{--    <section class="d-flex justify-content-center align-items-md-center vh-100  position-relative"--}}
{{--             style="background-image: linear-gradient(to bottom, var(--primary) 0%, var(--secondry) 100%);">--}}

{{--        <form method="POST" action="{{ route('login') }}" class="col-md-6 border rounded p-3">--}}
{{--            @csrf--}}

{{--            <div class=" mb-3">--}}
{{--                <label for="email" class="form-label">{{ __('Email Address') }}</label>--}}

{{--                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"--}}
{{--                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                @error('email')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--                @enderror--}}

{{--            </div>--}}

{{--            <div class=" mb-3">--}}
{{--                <label for="password" class="form-label">{{ __('Password') }}</label>--}}
{{--                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"--}}
{{--                       name="password" required autocomplete="current-password">--}}

{{--                @error('password')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--                @enderror--}}

{{--            </div>--}}

{{--            <div class=" mb-3">--}}
{{--                <div class="">--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="checkbox" name="remember"--}}
{{--                               id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                        <label class="form-check-label" for="remember">--}}
{{--                            {{ __('Remember Me') }}--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class=" mb-0">--}}
{{--                <div class="">--}}
{{--                    <button type="submit" class="btn btn-primary">--}}
{{--                        {{ __('Login') }}--}}
{{--                    </button>--}}

{{--                    @if (Route::has('password.request'))--}}
{{--                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                            {{ __('Forgot Your Password?') }}--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                    <a class="btn btn-primary" href="{{ route('facebook.login') }}">--}}
{{--                        {{ __('login with facebook') }}--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}


{{--    </section>--}}

@endsection
