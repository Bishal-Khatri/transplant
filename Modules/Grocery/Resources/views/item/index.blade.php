@extends('grocery::layouts.master')

@section('item_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Grocery<br>Items<br></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-box1"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Grocery Items</h3>
                    <small>
                        List of all grocery items.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <grocery-item-list></grocery-item-list>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
