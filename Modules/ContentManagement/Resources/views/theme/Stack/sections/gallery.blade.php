@if(isset($section->title) AND !blank($section->title))
    <h2>{{ $section->title ?? '' }}</h2>
@endif

@if(isset($section->gallery_id) AND !blank($section->gallery_id))
    <?php
    $gallery = \Modules\ContentManagement\Entities\Gallery::with('images')->whereId($section->gallery_id)->first();
    ?>
    @if(isset($gallery->images) AND !blank($gallery->images))
        @foreach($gallery->images as $image)
            <img src="{{ asset('storage/'.$image->image_original) }}" alt="" width="200">
        @endforeach
    @endif
@endif

