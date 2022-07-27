@php
    $json_data = json_decode($section->json_data, true);
    $background = json_decode($section->background, true);
@endphp
<section class="cover height-80 imagebg switchable siwtchable--switch" data-overlay="8">
    <div class="background-image-holder">
        <img alt="background" src="{{ asset($background['image_url'] ) }}" />
    </div>
    <div class="container pos-vertical-center">
        <div class="row justify-content-around">
            <div class="col-lg-5 col-md-7">
                <div class="switchable__text">
                    @if(isset($section->title) AND !blank($section->title))
                        <h1>{{ $section->title ?? '' }}</h1>
                    @endif
                    <p class="lead">
                        @if(isset($section->text) AND !blank($section->text))
                            {!! $section->text ?? '' !!}
                        @endif
                    </p>
                    <a class="btn btn--primary type--uppercase" href="{{ $json_data['button_link'] ?? '' }}">
                        <span class="btn__text">{{ $json_data['button_name'] ?? 'GO' }}</span>
                    </a>

                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-12">
                <div class="video-cover border--round box-shadow-wide">
                    <div class="background-image-holder">
                        <img alt="image" src="{{ asset($json_data['image_url']) }}" />
                    </div>
                    <div class="video-play-icon"></div>
                    <iframe src="{{ $json_data['video_url'] }}" allowfullscreen="allowfullscreen"></iframe>
                </div>
                <!--end video cover-->
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
