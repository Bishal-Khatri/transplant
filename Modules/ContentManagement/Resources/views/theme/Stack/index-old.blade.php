@extends('contentmanagement::theme.Stack.layouts.master')

@section('content')

    @if(isset($content->sections) AND !blank($content->sections))
        @foreach($content->sections as $section)

            @php
                $view_file = 'contentmanagement::Theme.'.$active_theme->name.'.sections.' . $section->section_type . '.' . $section->section_name . '.style_1'
            @endphp

            @if($section->visibility)
                @include($view_file, $section)
            @endif

        @endforeach
    @endif

    {{--<section class="cover height-80 imagebg switchable siwtchable--switch" data-overlay="8">--}}
        {{--<div class="background-image-holder">--}}
            {{--<img alt="background" src="{{ asset('themes/stack/images/banner.jpg') }}" />--}}
        {{--</div>--}}
        {{--<div class="container pos-vertical-center">--}}
            {{--<div class="row justify-content-around">--}}
                {{--<div class="col-lg-5 col-md-7">--}}
                    {{--<div class="switchable__text">--}}
                        {{--<h1>--}}
                            {{--Welcome to NMC--}}
                        {{--</h1>--}}
                        {{--<p class="lead">--}}
                            {{--Nepal Medical Council (NMC) was established in 2020 by the act of Parliament.--}}
                        {{--</p>--}}
                        {{--<a class="btn btn--primary type--uppercase" href="/">--}}
                            {{--<span class="btn__text">Read More</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-6 col-md-4 col-12">--}}
                    {{--<div class="video-cover border--round box-shadow-wide">--}}
                        {{--<div class="background-image-holder">--}}
                            {{--<img alt="image" src="{{ asset('themes/stack/images/banner.jpg') }}" />--}}
                        {{--</div>--}}
                        {{--<div class="video-play-icon"></div>--}}
                        {{--<iframe data-src="https://www.youtube.com/embed/6p45ooZOOPo?autoplay=1" allowfullscreen="allowfullscreen"></iframe>--}}
                    {{--</div>--}}
                    {{--<!--end video cover-->--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--end of row-->--}}
        {{--</div>--}}
        {{--<!--end of container-->--}}
    {{--</section>--}}
    {{--<section class="text-center">--}}
        {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<div class="col-md-10 col-lg-8">--}}
                    {{--<h2>All the tools you'll need</h2>--}}
                    {{--<p class="lead">--}}
                        {{--Whether you’re building a welcome mat for your SaaS or a clean, corporate portfolio, Stack has your design needs covered.--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--end of row-->--}}
        {{--</div>--}}
        {{--<!--end of container-->--}}
    {{--</section>--}}
    {{--<section>--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="feature feature-3 boxed boxed--lg boxed--border text-center">--}}
                        {{--<i class="icon icon--lg icon-Mail-3"></i>--}}
                        {{--<h4>Mailer Integrations</h4>--}}
                        {{--<p>--}}
                            {{--Stack comes with integration for Mail Chimp and Campaign Monitor forms - ideal for modern marketing campaigns--}}
                        {{--</p>--}}
                        {{--<a href="#">--}}
                            {{--Learn More--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<!--end feature-->--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="feature feature-3 boxed boxed--lg boxed--border text-center">--}}
                        {{--<i class="icon icon--lg icon-Air-Balloon"></i>--}}
                        {{--<h4>Diverse Icons</h4>--}}
                        {{--<p>--}}
                            {{--Including the premium Icons Mind icon kit, Stack features a highly diverse set of icons suitable for all purposes.--}}
                        {{--</p>--}}
                        {{--<a href="#">--}}
                            {{--Learn More--}}
                        {{--</a>--}}
                        {{--<span class="label">New</span>--}}
                    {{--</div>--}}
                    {{--<!--end feature-->--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="feature feature-3 boxed boxed--lg boxed--border text-center">--}}
                        {{--<i class="icon icon--lg icon-Bacteria"></i>--}}
                        {{--<h4>Modular Design</h4>--}}
                        {{--<p>--}}
                            {{--Combine blocks from a range of categories to build pages that are rich in visual style and interactivity--}}
                        {{--</p>--}}
                        {{--<a href="#">--}}
                            {{--Learn More--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<!--end feature-->--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--end of row-->--}}
        {{--</div>--}}
        {{--<!--end of container-->--}}
    {{--</section>--}}
    {{--<section class="imagebg">--}}
        {{--<div class="background-image-holder">--}}
            {{--<img alt="background" src="{{ asset('themes/stack/img/landing-6.jpg') }}" />--}}
        {{--</div>--}}
        {{--<div class="container">--}}
            {{--<div class="row justify-content-end">--}}
                {{--<div class="col-md-7 col-lg-5">--}}
                    {{--<div class="boxed boxed--lg border--round bg--white">--}}
                        {{--<div class="col-lg-10 mx-auto col-md-12">--}}
                            {{--<h3>Experience quality</h3>--}}
                            {{--<p class="lead">--}}
                                {{--Stack is built with customization and ease-of-use at its core &mdash; whether you're a seasoned developer or just starting out, you'll be making attractive sites faster than any traditional HTML template.--}}
                            {{--</p>--}}
                            {{--<hr class="short" />--}}
                            {{--<p>--}}
                                {{--Each purchase of Stack includes six months of free support and lifetime free content and bug-fix updates.--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--end of row-->--}}
        {{--</div>--}}
        {{--<!--end of container-->--}}
    {{--</section>--}}
    {{--<section class="text-center bg--secondary">--}}
        {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<div class="col-md-10 col-lg-8">--}}
                    {{--<h2>Perfect for Designers &amp; Developers</h2>--}}
                    {{--<p class="lead">--}}
                        {{--Whether you’re building a welcome mat for your SaaS or a clean, corporate portfolio, Stack has your design needs covered.--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--end of row-->--}}
        {{--</div>--}}
        {{--<!--end of container-->--}}
    {{--</section>--}}
    {{--<section class="bg--secondary imagebg image--light">--}}
        {{--<div class="background-image-holder visible-lg">--}}
            {{--<img alt="background" src="{{ asset('themes/stack/img/device-bg-1.jpg') }}" />--}}
        {{--</div>--}}
        {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<div class="col-md-8 text-center">--}}
                    {{--<div class="tabs-container" data-content-align="left">--}}
                        {{--<ul class="tabs">--}}
                            {{--<li class="active">--}}
                                {{--<div class="tab__title">--}}
                                    {{--<span class="h5">Code Quality</span>--}}
                                {{--</div>--}}
                                {{--<div class="tab__content">--}}
                                    {{--<p class="lead">--}}
                                        {{--Stack follows the BEM naming convention that focusses on logical code readability that is reflected in both the HTML and CSS. Interactive elements such as accordions and tabs follow the same markup patterns making rapid development easier for developers and beginners alike.--}}
                                    {{--</p>--}}
                                    {{--<p class="lead">--}}
                                        {{--Add to this the thoughtfully presented documentation, featuring code highlighting, snippets, class customizer explanation and you've got yourself one powerful value package.--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<div class="tab__title">--}}
                                    {{--<span class="h5">Visual Design</span>--}}
                                {{--</div>--}}
                                {{--<div class="tab__content">--}}
                                    {{--<p class="lead">--}}
                                        {{--Stack offers a clean and contemporary look to suit a range of purposes from corporate, tech startup, marketing site to digital storefront. Elements have been designed to showcase content in a diverse yet consistent manner.--}}
                                    {{--</p>--}}
                                    {{--<p class="lead">--}}
                                        {{--Multiple font and colour scheme options mean that dramatically altering the look of your site is just clicks away &mdash; Customizing your site in the included Variant Page Builder makes experimenting with styles and content arrangements dead simple.--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<div class="tab__title">--}}
                                    {{--<span class="h5">Stack Experience</span>--}}
                                {{--</div>--}}
                                {{--<div class="tab__content">--}}
                                    {{--<p class="lead">--}}
                                        {{--Medium Rare is an elite author known for offering high-quality, high-value products backed by timely and personable support. Recognised and awarded by Envato on multiple occasions for producing consistently outstanding products, there's no wonder over 20,000 customers enjoy using Medium Rare templates.--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<!--end of tabs container-->--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--end of row-->--}}
        {{--</div>--}}
        {{--<!--end of container-->--}}
    {{--</section>--}}
    {{--<section class="text-center">--}}
        {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<div class="col-md-8 col-lg-6">--}}
                    {{--<div class="cta">--}}
                        {{--<h2>Purchase Stack now and get lifetime free content updates</h2>--}}
                        {{--<p class="lead">--}}
                            {{--Each purchase of Stack comes with six months free support &mdash; and a lifetime of free content and bug-fix updates.--}}
                        {{--</p>--}}
                        {{--<a class="btn btn--primary type--uppercase" href="#">--}}
                                    {{--<span class="btn__text">--}}
                                        {{--Purchase on Envato--}}
                                    {{--</span>--}}
                            {{--<span class="label">$19 USD</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--end of row-->--}}
        {{--</div>--}}
        {{--<!--end of container-->--}}
    {{--</section>--}}

@endsection
