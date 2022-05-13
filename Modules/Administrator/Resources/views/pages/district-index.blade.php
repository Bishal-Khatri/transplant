@extends('administrator::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>District</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <district-index province_id="{{ $province_id }}"/>
        </div>
    </div>
@endsection
