<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }} | User</title>
    @include('layouts.gentelella.css')
</head>
<body class="nav-md">

<div class="container body">
    <div class="main_container">

    @include('layouts.gentelella.navigation')

    <!-- page content -->
        <div id="app">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('layouts.gentelella.footer')
        <!-- /footer content -->
    </div>
</div>
<script src="{{ mix('js/user.js') }}"></script>
@include('layouts.gentelella.script')
</body>

</html>


