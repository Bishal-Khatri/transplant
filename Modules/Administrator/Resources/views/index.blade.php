@extends('administrator::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row">
            <div class="tile_count" style="width: 80%;">
                <div class="row">
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                        <div class="count green">{{ $total_users ?? 0 }}</div>
                        {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> From last Month</span>--}}
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-hospital-o"></i> Total Hospitals</span>
                        <div class="count green">{{ $total_hospitals ?? 0 }}</div>
                        <span class="count_bottom"><i class="green">Gov.: {{ $hospital_type_gov }} </i> | <i class="green">Pvt.: {{ $hospital_type_pvt }} </i></span>
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Approved Hospitals</span>
                        <div class="count green">{{ $approved_hospitals ?? 0 }}</div>
                        <span class="count_bottom"><i class="green"><i class="fa fa-plus"></i>{{ $unapproved_hospitals || 0 }} </i> New Hospitals</span>
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Rejected Hospitals</span>
                        <div class="count green">{{ $rejected_hospitals ?? 0 }}</div>
                        {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> From last Month</span>--}}
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Total Patients</span>
                        <div class="count green">{{ $total_patients ?? 0 }}</div>
                        {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>0% </i> From last Month</span>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registered Patients</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="mybarChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Recent Activities</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link">View All</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <recent-activity/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        if ($('#mybarChart').length ){

            var ctx = document.getElementById("mybarChart");
            var mybarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                        label: '# of Votes',
                        backgroundColor: "#26B99A",
                        data: [51, 30, 40, 28, 92, 50, 45]
                    }, {
                        label: '# of Votes',
                        backgroundColor: "#03586A",
                        data: [41, 56, 25, 48, 72, 34, 12]
                    }]
                },

                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        }
    </script>
@endsection
