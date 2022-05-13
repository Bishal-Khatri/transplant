@extends('contentmanagement::layouts.admin')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Theme Setting</h3>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Available Themes</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a href="{{ route('cms.theme.scan') }}" style="color: #5A738E;" type="submit">Scan</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                @foreach($available_themes as $value)
                                    <div class="col-md-4">
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <h4>
                                                    {{ $value->name }}
                                                    @if($value->is_active)
                                                        <span class="badge badge-warning">Active</span>
                                                    @endif
                                                </h4>
                                                @if($value->is_active)
                                                    <button type="button" class="btn btn-primary btn-sm">Active</button>
                                                @else
                                                    <a class="btn btn-secondary btn-sm" href="{{ route('cms.theme.activate', $value->id) }}">Activate</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="x_panel">
                        <form action="{{ route('cms.theme.update') }}" method="post" enctype="multipart/form-data">
                            <div class="x_title">
                                <h2>General</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><button class="btn btn-link" style="color: #5A738E;" type="submit">Save</button></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @csrf
                                <input type="hidden" name="theme_id" value="{{ $active_theme->id ?? '' }}">

                                @if(isset($active_theme) AND !blank($active_theme->logo))
                                    <div class="col-md-12 ">
                                        <img src="{{ asset('storage/'.$active_theme->logo) }}" alt="logo" class="rounded image-xl">
                                        <p>Current Logo</p>
                                    </div>
                                @endif

                                <div class="col-md-12 col-sm-12 form-group">
                                    <label for="title">Website Logo</label>
                                    <input type="file" class="form-control" name="logo" placeholder="Website Logo">
                                </div>

                                <div class="col-md-12 col-sm-12 form-group">
                                    <label for="title">Website Name</label>
                                    <input type="text" class="form-control" name="title" placeholder="Website Name" value="{{ $active_theme->title ?? '' }}">
                                </div>

                                <div class="col-md-12 col-sm-12 form-group">
                                    <label for="titlme">Home Page</label>
                                    <select class="form-control" name="homepage_id">
                                        <option value="" selected>Choose Page</option>
                                        @if(isset($pages) AND !blank($pages))
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" @if(!blank($active_theme) AND $active_theme->homepage_id == $page->id) selected @endif>{{ $page->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label for="titlme">Navigation Menu</label>
                                    <select class="form-control" name="nav_menu_id">
                                        <option value="" selected>Choose Menu</option>
                                        @if(isset($menus) AND !blank($menus))
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}" @if(!blank($active_theme) AND $active_theme->nav_menu_id == $menu->id) selected @endif>{{ $menu->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group">
                                    <label for="title">Copyright Text</label>
                                    <textarea name="copyright_text" class="form-control" id="" cols="30" rows="10" placeholder="Copyright Text">{{ $active_theme->copyright ?? '' }}</textarea>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
