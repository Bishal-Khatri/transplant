@extends('administrator::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left w-100 d-flex justify-content-center">
                    <h3>Create New Hospital</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <hospital-create />
        </div>
    </div>
@endsection
