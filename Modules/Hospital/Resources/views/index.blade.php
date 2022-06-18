@extends('hospital::layouts.master')
@section('script')
    <script src="https://unpkg.com/nepali-date-picker@2.0.1/dist/jquery.nepaliDatePicker.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/nepali-date-picker@2.0.1/dist/nepaliDatePicker.min.css" crossorigin="anonymous" />

    <script>
        $(".bod-picker").nepaliDatePicker({
            dateFormat: "%D, %M %d, %y",
            closeOnDateSelect: true
        });

        $("#clear-bth").on("click", function(event) {
            $(".bod-picker").val('');
        });
    </script>
@endsection
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Dashboard</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="x_panel">
                        <div class="jumbotron mb-2 mt-2">
                            <h3>Welcome, {{ auth()->user()->name }}</h3>
                            <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                            <hr class="my-4">
                            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                            <p class="alert alert-info">
                                <i class="fa fa-info-circle mr-2"></i>
                                License expiry warning message goes here.
                            </p>
                            {{--<p class="alert alert-error">--}}
                                {{--<i class="fa fa-info-circle mr-2"></i>--}}
                                {{--License expiry message goes here.--}}
                                {{--<a href="/hospital/profile" class="text-white ml-2 btn btn-link btn-sm">Go to profile</a>--}}
                            {{--</p>--}}

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a  href="#" class="text-accent">FAQ</a></li>
                                <li><a class="text-accent" href="#">Support</a></li>
                                <li><a class="text-accent" href="#">User Manual</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="x_panel">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
