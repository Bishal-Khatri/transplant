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
            <div class="col-md-6 col-sm-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registered Patients</h2>
                        <select class="float-right mt-2" name=""  id="">
                            <option value="">2022</option>
                        </select>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="registeredPatients"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
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

            <div class="col-md-6 col-sm-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hospitals</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="btn btn-sm btn-link" href="{{ route('admin.hospital.list') }}">View All</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Hospital Name </th>
                                    <th class="column-title">Email </th>
                                    <th class="column-title">Contact </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($hospitals->count())
                                    @foreach($hospitals as $value)
                                        <tr>
                                            <td><a href="{{ route('admin.hospital.display', $value->id) }}">{{ $value->hospital_name ?? '' }}</a></td>
                                            <td>{{ $value->email ?? 'Not-Available' }}</td>
                                            <td>{{ $value->primary_contact ?? 'Not-Available' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Items Found.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="col-md-6 col-sm-6">--}}
            {{--<div class="x_panel">--}}
            {{--<div class="x_title">--}}
            {{--<h2>Diseases</h2>--}}
            {{--<ul class="nav navbar-right panel_toolbox">--}}
            {{--<li><a class="btn btn-sm btn-link" href="{{ route('admin.disease') }}">View All</a></li>--}}
            {{--</ul>--}}
            {{--<div class="clearfix"></div>--}}
            {{--</div>--}}
            {{--<div class="x_content">--}}
            {{--<div class="table-responsive">--}}
            {{--<table class="table table-striped jambo_table bulk_action">--}}
            {{--<thead>--}}
            {{--<tr class="headings">--}}
            {{--<th class="column-title">Disease </th>--}}
            {{--<th class="column-title">Updated At </th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--@if($diseases->count())--}}
            {{--@foreach($diseases as $value)--}}
            {{--<tr>--}}
            {{--<td>{{ $value->title ?? '' }}</td>--}}
            {{--<td>{{ $value->updated_at ?? '' }}</td>--}}
            {{--</tr>--}}
            {{--@endforeach--}}
            {{--@else--}}
            {{--<tr>--}}
            {{--<td colspan="3">No Items Found.</td>--}}
            {{--</tr>--}}
            {{--@endif--}}
            {{--</tbody>--}}
            {{--</table>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>
@endsection
@section('script')
    <script>
        @if($patient_demograph)
        if ($('#registeredPatients').length ){
            let patient_demograph;
            patient_demograph = @json($patient_demograph);

            var label_data = patient_demograph['labels'];
            var datasets = patient_demograph['datasets'];
            var ctx = document.getElementById("registeredPatients");
            var mybarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label_data,
                    datasets: datasets
                },

                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }],
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            });

        }
        @endif
    </script>
@endsection
