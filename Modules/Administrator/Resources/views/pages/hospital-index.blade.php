@extends('administrator::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hospital Listing</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <hospital-index route="{{route('admin.hospital.index')}}" create_route="{{ route('admin.hospital.create') }}"/>
        </div>
    </div>
@endsection
