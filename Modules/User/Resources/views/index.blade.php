@extends('user::layouts.master')
@section('user_active') active @stop

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Administrator Users</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <user-list :types="{{json_encode($user_types)}}"></user-list>
        </div>
    </div>
@endsection


