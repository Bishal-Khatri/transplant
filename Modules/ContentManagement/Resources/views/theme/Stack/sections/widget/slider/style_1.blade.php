@if(isset($section->title) AND !blank($section->title))
    <h2>{{ $section->title ?? '' }}</h2>
@endif

@if(isset($section->slider_id) AND !blank($section->slider_id))
    <?php
    $slider = \Modules\ContentManagement\Entities\Slider::with('images')->whereId($section->slider_id)->first();
    ?>
    @if(isset($slider->images) AND !blank($slider->images))
        @foreach($slider->images as $image)
            <img src="{{ asset('storage/'.$image->image_original) }}" alt="" width="200">
        @endforeach
    @endif
@endif

