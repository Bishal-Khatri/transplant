<?php
$json_data = json_decode($section->json_data, true);
$gallery = \Modules\ContentManagement\Entities\Gallery::with('images')->whereId($json_data['slider_id'])->first();
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col">
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

                <div class="slider slider--ken-burns" data-arrows="true" data-paging="true">
                    <ul class="slides">
                        @if(isset($gallery->images) AND !blank($gallery->images))
                            @foreach($gallery->images as $image)
                                <li> <img alt="Image" src="{{ asset('storage/'.$image->image_large) }}"> </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
