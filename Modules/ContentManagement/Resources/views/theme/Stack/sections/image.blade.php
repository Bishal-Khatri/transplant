@if(isset($section->title) AND !blank($section->title))
    <h2>{{ $section->title ?? '' }}</h2>
@endif

@if(isset($section->image_url) AND !blank($section->image_url))
    <img src="{{ asset('storage/'.$section->image_url) }}" alt="" width="200">
@endif

