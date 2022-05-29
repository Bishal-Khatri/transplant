<?php
$json_data = json_decode($section->json_data, true);
$gallery = \Modules\ContentManagement\Entities\Gallery::with('images')->whereId($json_data['gallery_id'])->first();
?>
<section>
    <div class="container">
        <div class="masonry">
            <article>
                <div class="article__title text-center">
                    @if(isset($section->title) AND !blank($section->title))
                        <h1 class="h2">{{ $section->title ?? '' }}</h1>
                    @endif
                    @if(isset($section->text) AND !blank($section->text))
                        <span>{!! $section->text ?? '' !!}</span>
                    @endif
                    <span><a href="javascript:void();">{{ $gallery->title ?? '' }}</a></span>
                </div>
            </article>
            <div class="masonry__container row masonry--active">
                @if(isset($section->json_data) AND !blank($section->json_data))
                    @if(isset($gallery->images) AND !blank($gallery->images))
                        @foreach($gallery->images as $image)
                            <div class="masonry__item col-lg-4 col-6 filter-people" data-masonry-filter="People">
                                <a href="{{ asset('storage/'.$image->image_original) }}" data-lightbox="Gallery 1">
                                    <img alt="Image" src="{{ asset('storage/'.$image->image_original) }}">
                                </a>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</section>
