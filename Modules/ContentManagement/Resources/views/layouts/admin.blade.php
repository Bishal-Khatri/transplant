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

    <!-- Bootstrap -->
    <link href="{{ asset('asset/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('asset/gentelella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('asset/gentelella/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('asset/gentelella/build/css/custom.min.css') }}" rel="stylesheet">

    {{--from dione--}}
    <link rel="stylesheet" href="{{ asset('asset/vendor/summernote/dist/summernote-bs4.css') }}"/>
    <link rel="stylesheet" href="{{ asset('asset/vendor/toastr/toastr.min.css') }}"/>

    <style>
        .rounded{
            border-radius: 0.25rem !important;
        }

        img.image-xl {
            width: 128px;
            height: 128px;
        }

        img.image-md {
            width: 32px;
            height: 32px;
        }
        .btn-accent{
            color: #fff;
            background-color: #2A3F54;
            border-color: #2A3F54;
        }
        .btn-accent:hover{
            color: #fff;
            background-color: #2A3F54;
            border-color: #2A3F54;
        }
    </style>
    @yield('css')
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">

        @include('contentmanagement::admin._partials.navigation')

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

<!-- jQuery -->
<script src="{{ asset('asset/gentelella/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('asset/gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('asset/gentelella/vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('asset/gentelella/vendors/nprogress/nprogress.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('asset/gentelella/build/js/custom.min.js') }}"></script>

{{--// from dione--}}
<script src="{{ asset('asset/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('asset/vendor/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('asset/vendor/nestable/jquery.nestable.js') }}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    toastr.options = {
        "debug": false,
        "newestOnTop": false,
        "positionClass": "toast-bottom-right",
        "closeButton": true,
        "progressBar": true
    };
    @if(Session::has('success'))
    toastr.success("{!! session('success') !!}");
    @endif
    @if(Session::has('error'))
    toastr.error("{!! session('error') !!}");
    @endif
    @if(Session::has('info'))
    toastr.info("{!! session('info') !!}");
    @endif
</script>

@yield('script')
</body>
</html>
