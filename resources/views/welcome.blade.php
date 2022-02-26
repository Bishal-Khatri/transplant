<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts._partials.css')
</head>
<body>

<div class="wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                        <div class="pull-right text-right" style="line-height: 14px">
                            <small>Root<br>General<br> <span class="c-white">D-ONE versions</span></small>
                        </div>
                        <div class="header-icon">
                            <img src="{{ asset('/images/d-one-logo.jpg') }}" alt="" width="60">
                            {{--<i class="pe page-header-icon pe-7s-server"></i>--}}
                        </div>
                        <div class="header-title">
                            <h3>D-ONE Application</h3>
                            <small>
                                Application dashboard by <a target="_blank" href="https://iionstech.com">iions Technology</a>
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>


            <div class="row">

                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                                <p class="c-white">
                                    LUNA Admin Theme is a premium admin theme with flat and dark design concept. It is fully responsive admin theme built with latest Bootstrap 3+ Framework, HTML5 and CSS3, Media query.
                                    It can be used for monitoring or administration web applications, project management system, admin dashboard, application backend or other custom project.
                                </p>
                            <a target="_blank" href="https://donedoc.iionstech.com" class="underline text-gray-900 dark:text-white">API Documentation</a>
                            <br>
                            <a target="_blank" href="http://localhost/d-one-web/doc" class="underline text-gray-900 dark:text-white">API Documentation Editor</a>
                            <br>
                            @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                                        <br>
                                        <a href="{{ url('/setup') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Setup</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                            <hr>
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </section>
</div>
@include('layouts._partials.script')

</body>

</html>

