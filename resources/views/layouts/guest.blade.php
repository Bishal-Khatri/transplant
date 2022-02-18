<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts._partials.css')
</head>
<body class="blank">
<div class="wrapper">
    <section class="content">
        @yield('content')
    </section>
</div>

@include('layouts._partials.script')
</body>
</html>