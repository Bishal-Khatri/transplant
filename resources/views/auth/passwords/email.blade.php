@extends('layouts.guest')

@section('content')

    <div class="container-center animated slideInDown">


        <div class="view-header">
            <div class="header-icon">
                <i class="pe page-header-icon pe-7s-id"></i>
            </div>
            <div class="header-title">
                <h3>{{ __('Reset Password') }}</h3>
                <small>
                    Please enter your email to rest your password.
                </small>
            </div>
        </div>

        <div class="panel panel-filled">
            <div class="panel-body">
                <form method="POST" action="{{ route('password.email') }}" id="loginForm" novalidate>
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label" for="email">{{ __('Email Address') }}</label>
                        <input type="text" placeholder="example@gmail.com"
                               title="Please enter you username" id="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="form-text small text-danger">{{ $message }}</span>
                        @else
                            <span class="form-text small">Your address email to sent new password</span>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-accent" type="submit">{{ __('Send Password Reset Link') }}</button>
                        <a class="btn btn-default" href="{{ route('login') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
