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
                            @php
                                $hospital = auth()->user()->hospital;
                                $license = $hospital->license;
                            @endphp
                            <h3>Welcome, {{ auth()->user()->name }}</h3>
                            <p>{{ $hospital->hospital_name ?? '' }}</p>
                            <hr class="my-4">
                            <p>License Information.</p>
                            @if(blank($license))
                                <p class="alert alert-error">
                                    <i class="fa fa-info-circle mr-2"></i>
                                    License not found. This account is under approval process.
                                </p>
                            @else
                                <p class="alert alert-info">
                                    <i class="fa fa-info-circle mr-2"></i>
                                    License status <span class="badge badge-accent">Active</span>. Expires on <span class="badge badge-accent">{{ $license->expiry_date ?? 'Not-Available' }}</span>
                                </p>
                            @endif


                            <ul class="nav navbar-right panel_toolbox">
                                <li><a  href="#" class="text-accent">FAQ</a></li>
                                <li><a class="text-accent" href="#">Support</a></li>
                                <li><a class="text-accent" href="#">User Manual</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{--<div class="col-lg-5 col-md-5 col-sm-5">--}}
                    {{--<div class="x_panel">--}}

                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection
