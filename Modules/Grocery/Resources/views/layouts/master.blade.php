<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts._partials.css')
    <link rel="stylesheet" href="{{ asset('/asset/vendor/select2/dist/css/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/asset/styles/style.css') }}">
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
<script src="{{ asset('/asset/vendor/select2/dist/js/select2.js') }}"></script>
<script src="{{ mix('js/grocery.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2({
            placeholder: "Select",
            allowClear: true
        });
        $(".select2_demo_3").select2();
    })
</script>

@yield('script')
</body>

</html>

