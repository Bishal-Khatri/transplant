@extends('administrator::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hospital's Details</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <hospital-details  hospital_json="{{ $hospital }}"/>
        </div>
    </div>
@endsection