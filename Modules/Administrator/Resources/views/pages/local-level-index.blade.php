@extends('administrator::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Local Level</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <local-level-index district_id="{{ $district_id }}"/>
        </div>
    </div>
@endsection
