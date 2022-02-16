@extends('layouts.guest')

@section('content')
    <div class="container-center animated slideInDown">
        <div class="view-header">
            <div class="header-icon">
                <i class="pe page-header-icon pe-7s-unlock"></i>
            </div>
            <div class="header-title">
                <h3>Login</h3>
                <small>
                    Please enter your credentials to login.
                </small>
            </div>
        </div>

        <div class="panel panel-filled">
            <div class="panel-body">
                <form  method="POST" action="{{ route('login') }}" novalidate>
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label" for="username">{{ __('Email Address') }}</label>
                        <input type="email" placeholder="example@email.com"
                               title="Please enter email address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  id="username" class="form-control">
                        @error('email')
                        <span class="form-text small text-danger">{{ $message }}</span>
                        @else
                            <span class="form-text small">Your administrative email address.</span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="password">{{ __('Password') }}</label>
                        <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control" autocomplete="current-password">
                        @error('password')
                        <span class="form-text small text-danger">{{ $message }}</span>
                        @else
                            <span class="form-text small">Your password</span>
                            @enderror
                    </div>
                    <div>
                        <button class="btn btn-accent">Login</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
