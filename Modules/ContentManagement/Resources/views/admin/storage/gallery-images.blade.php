@extends('contentmanagement::layouts.admin')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Gallery</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <gallery-images :gallery_id="{{ $galleryId }}"></gallery-images>
        </div>
    </div>
@endsection
