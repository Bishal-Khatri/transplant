@extends('hospital::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Patient Waiting List</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <patient-list/>
        </div>
    </div>
@endsection
