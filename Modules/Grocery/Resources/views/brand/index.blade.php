@extends('grocery::layouts.master')

@section('brand_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Grocery<br>Brands<br></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-box1"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Grocery Brands</h3>
                    <small>
                        List of all grocery items brands.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <grocery-brand-list></grocery-brand-list>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
