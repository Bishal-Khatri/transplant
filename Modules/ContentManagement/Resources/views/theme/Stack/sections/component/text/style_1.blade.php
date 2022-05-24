<section class="space--xs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($section->title) AND !blank($section->title))
                    <h2>{{ $section->title ?? '' }}</h2>
                @endif
                @if(isset($section->text) AND !blank($section->text))
                    <p>{!! $section->text ?? '' !!}</p>
                @endif
            </div>
        </div>
    </div>
</section>
