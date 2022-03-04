@extends('grocery::layouts.master')
@section('css')
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Grocery<br>Items<br>Edit<br></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-box1"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Edit Grocery Items</h3>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <grocery-item-edit :brands="{{ $brands }}" :category="{{ $categories }}" :item-id="{{ $item->id }}"></grocery-item-edit>
@endsection

@section('script')
    <script>
        // $('.summernote').on('summernote.change', function(we, contents, $editable) {
        //     vm.form.desc = contents //set vue data manually
        // });
    </script>
@endsection
