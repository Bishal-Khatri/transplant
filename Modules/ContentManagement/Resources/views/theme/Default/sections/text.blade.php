@if(isset($section->title) AND !blank($section->title))
    <h2>{{ $section->title ?? '' }}</h2>
@endif

@if(isset($section->text) AND !blank($section->text))
   <p>{!! $section->text ?? '' !!}</p>
@endif
