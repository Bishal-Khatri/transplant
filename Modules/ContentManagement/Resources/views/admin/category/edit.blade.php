@extends('contentmanagement::layouts.admin')
@section('category_active') active @stop
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Page Categories</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Update Category</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('contentmanagement::admin.category.form', compact('category_data'))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection
