@extends('layouts.admin.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <b>Sign</b>In
        </div>
        
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-board mb-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="brand-logo">
                </div>
                <p class="login-box-msg text-center">Sign in to continue</p>

                <form id="loginfrm" name="loginfrm" action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @else
                            <span class="text-danger invalid-feedback" role="alert"></span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @else
                            <span class="text-danger invalid-feedback" role="alert"></span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Sign In') }}
                            </button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 d-none">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection
    @push('script')
    <script type="text/javascript">
        $(document).ready(function(e){
            $('#loginfrm').validate({
                rules:{
                    email:{
                        required:true,
                        email:true
                    },
                    password:{
                        required:true,
                        minlength : 6,
                        maxlength : 20
                    }
                },
                errorPlacement: function (error, element) {
                    error.appendTo(element.parent().find("span.text-danger"));
                }
            })
        })
    </script>
@endpush
