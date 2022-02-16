<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('asset/vendor/fontawesome/css/font-awesome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/vendor/animate.css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/vendor/bootstrap/css/bootstrap.css') }}"/>

    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('asset/styles/pe-icons/pe-icon-7-stroke.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/styles/pe-icons/helper.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/styles/stroke-icons/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/styles/style.css') }}">
</head>
<body>

<!-- Wrapper-->
<div class="wrapper">

    <!-- Header-->
@include('layouts._partials.nav')
<!-- End header-->

    <!-- Navigation-->
@include('layouts._partials.sidebar')
<!-- End navigation-->


    <!-- Main content-->
    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

<!-- Vendor scripts -->
<script src="{{ asset('asset/vendor/pacejs/pace.min.js') }}"></script>
<script src="{{ asset('asset/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- App scripts -->
<script src="{{ asset('asset/scripts/luna.js') }}"></script>
{{--<script src="{{ mix('js/restaurant.js') }}"></script>--}}
</body>

</html>


