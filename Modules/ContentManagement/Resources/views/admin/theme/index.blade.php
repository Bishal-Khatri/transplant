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
                                <li><a href="{{ route('cms.theme.scan') }}" class="text-accent" type="submit">Scan</a></li>
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
            <theme-customization :active_theme="{{ $active_theme }}" :pages="{{ $pages }}" :menus="{{ $menus }}"/>
        </div>
    </div>
@endsection
