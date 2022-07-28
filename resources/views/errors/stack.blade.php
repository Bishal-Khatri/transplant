<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site Description Here">

    <link href="{{ asset('themes/stack/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('themes/stack/css/stack-interface.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('themes/stack/css/socicon.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('themes/stack/css/lightbox.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('themes/stack/css/flickity.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('themes/stack/css/iconsmind.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('themes/stack/css/jquery.steps.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('themes/stack/css/theme.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('themes/stack/css/custom.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('themes/stack/css/theme-red.css') }}" rel="stylesheet" type="text/css" media="all">
</head>
<body class=" ">
<a id="start"></a>
<div class="nav-container ">
    <!--end bar-->
@include('contentmanagement::theme.Stack._partials.navbar')
    <!--end bar-->
</div>
<div class="main-container">
    <section class="height-100 bg--dark text-center">
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="h1--large">@yield('code') | @yield('title')</h1>
                    <p class="lead">
                        @yield('message')
                    </p>
                    <a href="/">Go back to home page</a>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
</div>
<!--<div class="loader"></div>-->
<a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
    <i class="stack-interface stack-up-open-big"></i>
</a>
<script src="{{ asset('themes/stack/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/flickity.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/easypiechart.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/parallax.js') }}"></script>
<script src="{{ asset('themes/stack/js/typed.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/datepicker.js') }}"></script>
<script src="{{ asset('themes/stack/js/isotope.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/ytplayer.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/lightbox.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/granim.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/countdown.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/twitterfetcher.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/spectragram.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('themes/stack/js/scripts.js') }}"></script>
</body>
</html>
