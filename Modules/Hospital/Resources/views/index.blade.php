@extends('hospital::layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hello World</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="x_panel">
                        This view is loaded from module: {!! config('hospital.name') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
