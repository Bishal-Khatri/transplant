<!DOCTYPE html>
<html lang="en">
<head>
    @php
    $hospital = auth()->user()->hospital;
    $license = $hospital->license;
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | {{ $hospital->hospital_name ?? 'Hospital' }}</title>

    {{-- Laravel Mix - CSS File --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/hospital.css') }}"> --}}
    @include('layouts.gentelella.css')
</head>
<body class="nav-md">

<div class="container body">
    <div class="main_container">

    @include('layouts.gentelella.hospital-navigation')

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
@include('layouts.gentelella.script')
<script src="{{ asset('asset/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ mix('js/hospital.js') }}"></script>
</body>
</html>
