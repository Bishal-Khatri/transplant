<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts._partials.css')
    <style>
        html,body{background-color: #292e34;}
        #response{
            height: 410px;
            max-height: 410px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                        <div class="pull-right text-right" style="line-height: 14px">
                            <small>Root<br>General<br> <span class="c-white">D-ONE versions</span></small>
                        </div>
                        <div class="header-icon">
                            <img src="{{ asset('/images/d-one-logo.jpg') }}" alt="" width="60">
                            {{--<i class="pe page-header-icon pe-7s-server"></i>--}}
                        </div>
                        <div class="header-title">
                            <h3>D-ONE Application</h3>
                            <small>
                                Application dashboard by <a target="_blank" href="https://iionstech.com">iions Technology</a>
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>


            <div class="row">

                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <p class="c-white">
                                LUNA Admin Theme is a premium admin theme with flat and dark design concept. It is fully responsive admin theme built with latest Bootstrap 3+ Framework, HTML5 and CSS3, Media query.
                                It can be used for monitoring or administration web applications, project management system, admin dashboard, application backend or other custom project.
                            </p>
                            <a target="_blank" href="https://donedoc.iionstech.com" class="underline text-gray-900 dark:text-white">API Documentation</a>
                            <br>
                            <a target="_blank" href="http://localhost/d-one-web/doc" class="underline text-gray-900 dark:text-white">API Documentation Editor</a>
                            <br>
                            @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                                        <br>
                                        <a href="{{ url('/setup') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Setup</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                            <hr>
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </div>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <form id="setup-form">
                        <table class="table table-dark table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 100px;">Action</th>
                                <th scope="col" style="width: 200px;">Process</th>
                                <th>
                                    <button type="submit" class="btn btn-primary float-right">Run</button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="down"></td>
                                <td>Maintenance Mode</td>
                                <td rowspan="9">
                                    <div id="response"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="up"></td>
                                <td>Live Mode</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="view_clear"></td>
                                <td>Clear Views</td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-center"><input type="checkbox" name="cache_clear"></td>
                                <td>Clear Cache</td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-center"><input type="checkbox" name="config_cache"></td>
                                <td>Cache Config</td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-center"><input type="checkbox" name="config_clear"></td>
                                <td>Clear Config</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="storage_link"></td>
                                <td>Link Storage</td>
                            </tr>

                            <tr>
                                <td class="text-center"><input type="checkbox" name="migrate_refresh"></td>
                                <td>Refresh Migration</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="migrate_fresh"></td>
                                <td>Migrate Fresh</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="migrate_fresh_seed"></td>
                                <td>Migrate Fresh & DB Seed</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="migrate"></td>
                                <td>Migrate</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="db_seed"></td>
                                <td>Seed Database</td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="db_seed"></td>
                                <td>Install Passport</td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts._partials.script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#setup-form').on('submit', function(e) {
        e.preventDefault();
        const data = $(this).serializeArray();
        run(data)
    });
    async function run(data) {
        for (var i=0;i<data.length;i++){
            await $.ajax({
                type:'POST',
                url:'{{ route('setup.run') }}',
                data: data[i],
                success:function(response) {
                    $("#response").append(`<span> ${response.message} </span><br><small>${response.time}</small><hr>`);
                    var objDiv = document.getElementById("response");
                    objDiv.scrollTop = objDiv.scrollHeight;
                    $('input:checkbox').prop('checked', false);
                }
            });
        }
    }
</script>
</body>

</html>

