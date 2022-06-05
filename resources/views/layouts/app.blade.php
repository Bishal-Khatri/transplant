<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.gentelella.css')

</head>
<body class="login">
<div class="wrapper">
    <section class="content">
        @yield('content')
    </section>
</div>

@include('layouts.gentelella.script')
</body>

</html>
