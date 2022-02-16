@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>D-ONE Application<br>Dashboard<br> <span class="c-white">v.{{ config('app.app_version') }}</span></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-shield"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Welcome to D-ONE</h3>
                    <small>
                        D-ONE Application control panel for customizing and monitoring applications.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-2 col-xs-6">
            <div class="panel panel-filled">

                <div class="panel-body">
                    <h2 class="m-b-none">
                        206 <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> +20%</span>
                    </h2>

                    <div class="small">% New Sessions</div>
                    <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Updated: <span class="c-white">10:22pm</span></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <div class="panel panel-filled">
                <div class="panel-body">
                    <h2 class="m-b-none">
                        140 <span class="slight"><i class="fa fa-play fa-rotate-90 c-white"> </i> 5%</span>
                    </h2>

                    <div class="small">Total visitors</div>
                    <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Updated: <span class="c-white">9:10am</span></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <div class="panel panel-filled">
                <div class="panel-body">
                    <h2 class="m-b-none">
                        262 <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> +56%</span>
                    </h2>

                    <div class="small">Total users</div>
                    <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Updated: <span class="c-white">05:42pm</span></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <div class="panel panel-filled">
                <div class="panel-body">
                    <h2 class="m-b-none">
                        62% <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> +18%</span>
                    </h2>

                    <div class="small">Bounce Rate</div>
                    <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Updated: <span class="c-white">04:00am</span></div>
                </div>
            </div>
        </div>


        <div class="col-lg-4 col-xs-12">
            <div class="panel panel-filled" style="position:relative;height: 114px">
                <div style="position: absolute;bottom: 0;left: 0;right: 0">
                    <span class="sparkline"></span>
                </div>
                <div class="panel-body">
                    <div class="m-t-sm">
                        <div class="pull-right">
                            <a href="#" class="btn btn-default btn-xs">See locations</a>
                        </div>
                        <div class="c-white"><span class="label label-accent">+45</span> New visitor</div>
                        <span class="small c-white">120,312 <i class="fa fa-play fa-rotate-270 text-warning"> </i> -22%</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
