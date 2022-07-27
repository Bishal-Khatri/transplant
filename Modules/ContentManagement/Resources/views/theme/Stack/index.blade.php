@extends('contentmanagement::theme.Stack.layouts.master')

@section('content')
    <div id="app"></div>
    @if($content->title_visibility)
        <section class="text-center imagebg space--lg" data-overlay="3">
            <div class="background-image-holder">
                <img alt="background" src="/themes/stack/img/landing-19.jpg" />
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <h1>{{ $content->title ?? '' }}</h1>
                        <p class="lead">
                            {{ $content->short_description ?? '' }}
                        </p>
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>
    @endif

    @if(isset($content->sections) AND !blank($content->sections))
        @foreach($content->sections as $section)

            @php
                $view_file = 'contentmanagement::theme.'.$active_theme->name.'.sections.' . $section->section_type . '.' . $section->section_name . '.style_1'
            @endphp

            @if($section->visibility)
                @include($view_file, $section)
            @endif

        @endforeach
    @endif
@endsection
