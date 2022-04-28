@extends('layouts.app')
@if(Request::segment(2) == 'restaurant')
@section('restaurant_category_active') active @stop
<?php $title = "Restaurant"; ?>
@else
@section('grocery_category_active') active @stop
<?php $title = "Grocery"; ?>
@endif

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>{{ $title }}<br>Categories<br></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-box1"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">{!! $title !!}</h3>
                    <small>
                        List of all categories for {{ $title }} items.
                    </small>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-filled">
                <div class="panel-heading">
                    Create New Category
                </div>
                <div class="panel-body">
                    @include('category.form')
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-filled">
                <div class="panel-heading">
                    Category list for grocery
                </div>
                <div class="panel-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Parent</th>
                            <th style="width: 180px" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($categories) AND !blank($categories))
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if($category->image_thumbnail)
                                            <img alt="image" class="rounded image-md" src="{{ Storage::url($category->image_thumbnail) }}">
                                        @else
                                            <img alt="image" class="rounded image-md" src="{{ asset('images/placeholder-dark.jpg') }}">
                                        @endif
                                    </td>
                                    <td>{!! data_get($category, 'parent.name') ?? "<code>root</code>" !!}</td>
                                    <td class="text-center">
                                        <div class="btn-group pull-right">
                                            {{--<a href="" class="btn btn-default btn-xs"><i class="fa fa-folder"></i> Items</a>--}}
                                            <a href="{{ route('grocery.category.edit', $category->id) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Edit</a>

                                            <a href="{{ route('grocery.category.delete', $category->id) }}"
                                               class="btn btn-default btn-sm text-danger deleteModal" >
                                                <i class="fa fa-sticky-note"></i> Delete
                                            </a>
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
