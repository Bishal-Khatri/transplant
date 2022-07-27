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
    <link href="{{ asset('asset/gentelella/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
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
    @include('layouts.gentelella.footer')
    <!-- /footer content -->
    </div>
</div>

{{--temp fix | convert menu to vue component--}}
@if(Request::is('admin/cms/menu'))
    <script src="{{ mix('js/contentmanagement.js') }}"></script>
    @include('layouts.gentelella.script')
@else
    @include('layouts.gentelella.script')
    <script src="{{ mix('js/contentmanagement.js') }}"></script>

@endif
</body>
</html>
