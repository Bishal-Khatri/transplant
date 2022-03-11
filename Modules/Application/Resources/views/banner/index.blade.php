@extends('grocery::layouts.master')

@section('banner_active') active @stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Application<br>Banners<br></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-phone"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Application Banners</h3>
                    <small>
                        List of all application banners.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>


    <div class="row">
        @if(!blank($banners))
            @foreach($banners as $key=>$value)
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            {{ ucfirst($key) ?? '' }}
                            <div class="panel-tools">
                                <button class="btn btn-default btn-sm mr-2 add-banner" data-value="{{$key}}">Add New</button>
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(!blank($value))
                                @foreach($value as $banner)
                                    <img alt="image" class="rounded mb-2" width="300" src="{{ asset('storage/'.$banner->image) }}">
                                    <a href="{{ route('application.banners.delete', $banner->id) }}" class="btn btn-danger btn-sm" style="position: relative; top: 61px; right: 36px;"><i class="fa fa-trash text-danger"></i></a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif


        <div class="modal fade" id="create-banner" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Create New Banner</h4>
                    </div>
                    <form class="form-group" action="{{ route('application.banners.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="key" name="key" value="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-filled">
                                        <div class="panel-heading">
                                            Create New Banner.
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group row">
                                                <label for="item_name" class="col-sm-2 col-form-label">Image
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="file" id="main-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg" ref="file">
                                                    <small class="text-muted">Your image needs to be at least 500×500 pixels.</small>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-accent" >Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".add-banner").on('click', function (e) {
                e.preventDefault();
                const key = $(this).data('value');
                $("#key").val(key);
                $("#create-banner").modal("show");
            })
        });
    </script>
@endsection
