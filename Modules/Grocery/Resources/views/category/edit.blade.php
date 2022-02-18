@extends('grocery::layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Grocery<br>Categories<br></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-shield"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Grocery Categories</h3>
                    <small>
                        D-ONE Application control panel for customizing and monitoring applications.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-filled">
                <div class="panel-heading">
                    Update Category
                </div>
                <div class="panel-body">
                    @include('grocery::category.form', compact('category_data'))
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection
