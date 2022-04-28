@extends('cart::layouts.master')
@section('order_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Grocery<br>Orders<br></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-box1"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Grocery Orders</h3>
                    <small>
                        List of all grocery order.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <grocery-order-list></grocery-order-list>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title">Confirm Delete</h4>
                    <small>Click <code>Delete</code> button to confirm.</small>
                </div>
                <div class="modal-body">
                    <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <form action="" id="deleteForm">
                        <button type="submit" class="btn btn-accent">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
