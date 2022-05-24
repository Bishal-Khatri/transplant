@php
    $json_data = json_decode($section->json_data, true);
    $background = json_decode($section->background, true);
@endphp

<section class="text-center {{ $background['type'] }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-6">
                <div class="cta">
                    @if(isset($section->title) AND !blank($section->title))
                        <h2>{{ $section->title ?? '' }}</h2>
                    @endif
                        <p class="lead">
                            @if(isset($section->text) AND !blank($section->text))
                                {!! $section->text ?? '' !!}
                            @endif
                        </p>
                    <a class="btn btn--primary type--uppercase" href="{{ $json_data['link'] ?? '' }}">
                        <span class="btn__text">{{ $json_data['button_name'] ?? 'GO' }}</span>
                    </a>
                    {{--<p class="type--fine-print">or check out <a href="index.html">more demos</a></p>--}}
                </div>
            </div>
        </div>
    </div>
</section>



