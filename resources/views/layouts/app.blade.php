<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts._partials.css')

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

@include('layouts._partials.script')
@yield('script')
<script>
    $(document).ready(function () {
        $("#category-image").on("change", function (event) {
            let newSrc = URL.createObjectURL(event.target.files[0]);
            $('#cat-image-preview').attr('src', newSrc);
        })
    })
</script>

</body>

</html>
