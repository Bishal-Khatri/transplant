@extends('contentmanagement::layouts.admin')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Page</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <page-edit :page="{{ $page }}" :galleries="{{ $galleries }}" :categories="{{ $categories }}" :sliders="{{ $sliders }}"></page-edit>
        </div>
    </div>
@endsection
