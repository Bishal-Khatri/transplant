@extends('layouts.app')

@section('content')
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form  method="POST" action="{{ route('change-password') }}" novalidate id="login-form">
                    @csrf
                    <h1>Change Password</h1>
                    <div style="margin-bottom: 20px;">
                        <input type="password" class="form-control mb-0" placeholder="{{ __('New Password') }}" required="" name="password" autocomplete="current-password" />
                        @error('password')
                        <ul class="parsley-errors-list filled text-left"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div style="margin-bottom: 20px;">
                        <input type="password" class="form-control mb-0" placeholder="{{ __('Confirm Password') }}" required="" name="password_confirmation" autocomplete="current-password" />
                        @error('password_confirmation')
                        <ul class="parsley-errors-list filled text-left"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-accent btn-sm submit" type="submit">Change</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

                        <div class="clearfix"></div>

                        <div>
                            <h2><img src="{{ $active_theme->logo ? 'storage/'.$active_theme->logo : '' }}" alt="logo" width="350"></h2>
                            <p>{!! $active_theme->copyright ?? '©2022 All Rights Reserved. iions technology Pvt. Ltd.' !!}</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
