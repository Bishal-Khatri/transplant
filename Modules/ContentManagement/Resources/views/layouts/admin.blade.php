<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Organ Transplant | </title>
    @include('layouts.gentelella.css')
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">

        @include('layouts.gentelella.admin-navigation')

        <!-- page content -->
        <div id="app">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Bootstrap Admin Template
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<script src="{{ mix('js/contentmanagement.js') }}"></script>
@include('layouts.gentelella.script')
</body>
</html>
