<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Hospital</title>
    @include('layouts.gentelella.css')
    <style>
        .wrapper{
            position: absolute;
            left: 50%;
            top: 50%;
            text-align: center;
        }
    </style>
</head>
<body class="nav-md">

<div class="container body">
    <div class="main_container">

        @if(auth()->check())
            @if(auth()->user()->user_type === \App\Enum\UserType::ADMINISTRATOR)
                @include('layouts.gentelella.admin-navigation')
            @elseif(auth()->user()->user_type === \App\Enum\UserType::HOSPITAL)
                @include('layouts.gentelella.hospital-navigation')
            @endif
        @endif

        <div class="right_col" role="main" >
            <div class="wrapper">
                @yield('code') | @yield('short_message')
                <br>
                @yield('message')
                <br><br>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-accent">Go Back</a>
            </div>
        </div>

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
<script src="{{ mix('js/hospital.js') }}"></script>
@include('layouts.gentelella.script')
</body>
</html>
