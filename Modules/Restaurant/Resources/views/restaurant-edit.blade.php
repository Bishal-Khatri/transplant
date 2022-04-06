@extends('restaurant::layouts.master')
@section('restaurant_list_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Restaurant<br>Listing<br> <span class="c-white">v.{{ config('app.app_version') }}</span></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-culture"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Edit Restaurant</h3>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <restaurant-edit :restaurant="{{ $restaurant }}" :categories="{{ $categories }}" :amenities="{{ $amenities }}"></restaurant-edit>
@endsection
