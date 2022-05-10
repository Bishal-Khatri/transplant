@extends('layouts.guest')

@section('content')
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form  method="POST" action="{{ route('login') }}" novalidate id="login-form">
                    @csrf
                    <h1>Login Form</h1>
                    <div style="margin-bottom: 20px;">
                        <input type="email" name="email" required="required" autocomplete="email" value="{{ old('email') }}" class="form-control mb-0" placeholder="{{ __('Email Address') }}" />
                        @error('email')
                        <ul class="parsley-errors-list filled text-left"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div style="margin-bottom: 20px;">
                        <input type="password" class="form-control mb-0" placeholder="{{ __('Password') }}" required="" name="password" autocomplete="current-password" />
                        @error('password')
                        <ul class="parsley-errors-list filled text-left"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-default btn-sm submit" type="submit">Log in</button>
                        <button class="btn btn-default btn-sm submit">Lost your password?</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
