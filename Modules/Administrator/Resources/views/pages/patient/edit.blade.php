@extends('administrator::layouts.master')
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Update Patient Information</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            {{--<patient-update :patient="{{ $patient }}"--}}
                            {{--:religions="{{ $religions }}"--}}
                            {{--:ethnic_groups="{{ $ethnic_groups }}"--}}
                            {{--:education_levels="{{ $education_levels }}"--}}
                            {{--:occupations="{{ $occupations }}"></patient-update>--}}
            <patient-update :patient="{{ $patient }}"
                            :religions="{{ $religions }}"
                            :ethnic_groups="{{ $ethnic_groups }}"
                            :education_levels="{{ $education_levels }}"
                            :diseases="{{ $diseases }}"
                            :occupations="{{ $occupations }}"
                            :auth_user="{{ $auth_user }}" :patient_id="{{ $patient->id }}"></patient-update>
        </div>
    </div>
@endsection
