@extends('hospital::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hospital Profile</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <hospital-profile hospital_json="{{ $hospital }}" licenses_json="{{ $licenses }}" auth_user="{{ auth()->user() }}"/>
        </div>
    </div>
@endsection
