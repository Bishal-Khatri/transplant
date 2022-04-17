@extends('user::layouts.master')
@section('roles_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>User<br>Roles & Permissions<br> <span class="c-white">v.{{ config('app.app_version') }}</span></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-lock"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Roles & Permissions</h3>
                    <small>
                        D-ONE Application control panel for customizing and monitoring applications.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <role-list></role-list>
@endsection
