@extends('contentmanagement::layouts.admin')
{{--// REMOVE THIS FILE--}}
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Storage - All Files</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_content">
                            <storage-index></storage-index>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
