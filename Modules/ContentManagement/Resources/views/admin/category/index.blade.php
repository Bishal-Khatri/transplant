@extends('contentmanagement::layouts.admin')
@if(Request::segment(2) == 'restaurant')
@section('restaurant_category_active') active @stop
<?php $title = "Restaurant"; ?>
@else
@section('grocery_category_active') active @stop
<?php $title = "Grocery"; ?>
@endif

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
                            <h2> Create New Category</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('contentmanagement::admin.category.form')
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Listing</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th style="width: 180px" class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($categories) AND !blank($categories))
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                @if($category->image_thumbnail)
                                                    <img alt="image" class="rounded image-md" src="{{ Storage::url($category->image_thumbnail) }}">
                                                @else
                                                    <img alt="image" class="rounded image-md" src="{{ asset('images/placeholder-dark.jpg') }}">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $category->name }}<br>
                                                <small>Created on {{ $category->created_at }}</small>
                                            </td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{!! data_get($category, 'parent.name') ?? "<code>root</code>" !!}</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="{{ route('cms.category.edit', $category->id) }}" class="btn btn-secondary btn-sm" type="button">Edit</a>
                                                    <a href="{{ route('cms.category.delete', $category->id) }}" class="btn btn-secondary btn-sm deleteModal" type="button">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-right">
        @if(isset($categories))
            {!! $categories->links() !!}
        @endif
    </div>

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
