@extends('cart::layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Grocery<br>Orders<br>Image Order</small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-box1"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Grocery Image Orders</h3>
                    <small>
                        List of all image order.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <grocery-image-order></grocery-image-order>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".deleteModal").on("click", function (e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('href');
                $("#deleteForm").attr('action', deleteUrl);
                $("#deleteModal").modal("show");
            });

            $("#deleteForm").on("submit", function (e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('action');
                $.ajax({
                    type:'DELETE',
                    url: deleteUrl,
                    success:function(data){
                        if (data.error === false){
                            window.location.reload()
                        }
                    }
                });
            })
        });
    </script>
@endsection
