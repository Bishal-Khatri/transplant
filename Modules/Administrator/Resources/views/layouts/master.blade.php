<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Module Administrator</title>

       {{-- Laravel Mix - CSS File --}}
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
    <script src="{{ mix('js/administrator.js') }}"></script>
    @include('layouts.gentelella.script')
    </body>
</html>
