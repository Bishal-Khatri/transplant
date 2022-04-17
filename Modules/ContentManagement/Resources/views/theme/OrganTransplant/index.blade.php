@extends('contentmanagement::layouts.master')

@section('content')
   <p>{{ $content->title ?? '' }}</p>
    {{dd($content)}}
@endsection
