<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts._partials.css')
    {{--<link rel="stylesheet" href="{{ mix('css/cart.css') }}">--}}
    @yield('css')
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
            <div id="app">
                @yield('content')
            </div>
        </div>
    </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

@include('layouts._partials.script')
 <script src="{{ mix('js/cart.js') }}"></script>
@yield('script')
</body>

</html>

