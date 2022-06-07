@extends('contentmanagement::layouts.admin')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Gallery Images</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            @include('contentmanagement::admin.storage.top-menu')
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <gallery-images :gallery_id="{{ $galleryId }}"></gallery-images>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
