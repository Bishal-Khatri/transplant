@extends('restaurant::layouts.client')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Dashboard<br> <span class="c-white">v.{{ config('app.app_version') }}</span></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-culture"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Restaurant Dashboard</h3>
                    <small>
                        D-ONE Application control panel for restaurant user for customizing and monitoring assets.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    @if(!$restaurant)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        Restaurant not found.
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-6">

                <div class="row">
                    <div class="col-6">
                        <div class="panel panel-filled">

                            <div class="panel-body">
                                <h2 class="m-b-none server1">
                                    122
                                </h2>

                                <div class="small">Total Menu Items</div>
                                <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Updated: <span class="c-white time">19:44:30 pm</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="panel panel-filled">
                            <div class="panel-body">
                                <h2 class="m-b-none server2">
                                    140
                                </h2>

                                <div class="small">Total Sales</div>
                                <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Updated: <span class="c-white time">11:22:15 pm</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="panel panel-filled">

                            <div class="panel-body">
                                <h2 class="m-b-none server3">
                                    206
                                </h2>

                                <div class="small">Today's Order</div>
                                <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Updated: <span class="c-white time">04:44:32 pm</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="panel panel-filled">
                            <div class="panel-body">
                                <h2 class="m-b-none server4">
                                    140
                                </h2>

                                <div class="small">Total Clients</div>
                                <div class="slight m-t-sm"><i class="fa fa-clock-o"> </i> Updated: <span class="c-white time">11:42:11 pm</span></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="com-lg-6 col-sm-6">
                <client-menu-list :restaurant="{{ $restaurant }}" :categories="{{ $categories }}"></client-menu-list>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <client-order-list></client-order-list>
            </div>
        </div>
    @endif


@endsection
