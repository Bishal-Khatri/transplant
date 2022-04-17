@extends('contentmanagement::layouts.master')

@section('content')
    <h1>{{ $content->title }}</h1>
    <p>{{ $content->short_description }}</p>
    @if(isset($content->sections) AND !blank($content->sections))
        @foreach($content->sections as $section)
            @php
                $view_file = 'contentmanagement::Theme.'.$active_theme->name.'.sections.'.$section->type
            @endphp
            @include($view_file, $section)
        @endforeach
    @endif
@endsection
