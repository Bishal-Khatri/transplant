@extends('grocery::layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                    <small>Grocery<br>Categories<br></small>
                </div>
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-shield"></i>
                </div>
                <div class="header-title">
                    <h3 class="m-b-xs">Grocery Categories</h3>
                    <small>
                        D-ONE Application control panel for customizing and monitoring applications.
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
                    @include('grocery::category.form')
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
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Parent</th>
                            <th style="width: 180px" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($categories) AND !blank($categories))
                            @foreach($categories as $category)
                                <tr>
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
                                            <a href="" class="btn btn-default btn-xs"><i class="fa fa-folder"></i> Items</a>
                                            <a href="{{ route('grocery.category.edit', $category->id) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{ route('grocery.category.delete', $category->id) }}" class="btn btn-default btn-xs text-danger"><i class="fa fa-sticky-note"></i> Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {!! $categories->links() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
