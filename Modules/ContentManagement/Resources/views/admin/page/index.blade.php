@extends('contentmanagement::layouts.admin')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Pages</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Listing</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="" class="text-accent" href="{{ route('cms.page.create') }}">Create New Page</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr>
                                    <th style="width: 80px;">#</th>
                                    <th style="width: 80px;">Image</th>
                                    <th>Page Title</th>
                                    <th style="width: 180px" class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($pages) AND !blank($pages))
                                    @foreach($pages as $page)
                                        <tr>
                                            <td>{{ $page->id }}</td>
                                            <td>
                                                @if($page->cover_image_thumbnail)
                                                    <img alt="image" class="rounded image-md" src="{{ Storage::url($page->cover_image_thumbnail) }}">
                                                @else
                                                    <img alt="image" class="rounded image-md" src="{{ asset('images/placeholder-dark.jpg') }}">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $page->title }}<br>
                                                <small class="">Created on {{ $page->created_at }}</small>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="{{ route('cms.page.edit', $page->id) }}" class="btn btn-secondary btn-sm" type="button">Edit</a>
                                                    <a href="{{ route('cms.page.delete', $page->id) }}" class="btn btn-secondary btn-sm deleteModal" type="button">Delete</a>
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
@endsection
