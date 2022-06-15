<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Organ Transplant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site Description Here">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('contentmanagement::theme.Stack._partials.css')
</head>
<body class=" ">
<a id="start"></a>
<section class="bar bar-3 bar--xs bg--blue">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="bar__module">
                    <span class="type--fine-print color--white">Nepal Medical Council (NMC)</span>
                </div>
            </div>
            <div class="col-lg-6 text-right text-left-xs text-left-sm">
                <div class="bar__module">
                    <ul class="menu-horizontal">
                        {{--<li>--}}
                            {{--<div class="modal-instance">--}}
                                {{--<a href="#" class="modal-trigger text-white">Login</a>--}}
                                {{--<div class="modal-container">--}}
                                    {{--<div class="modal-content section-modal">--}}
                                        {{--<section class="unpad">--}}
                                            {{--<div class="container">--}}
                                                {{--<div class="row justify-content-center">--}}
                                                    {{--<div class="col-md-6">--}}
                                                        {{--<div class="boxed boxed--lg bg--white text-center feature">--}}
                                                            {{--<div class="modal-close modal-close-cross"></div>--}}
                                                            {{--<h3>Login to Your Account</h3>--}}
                                                            {{--<a class="btn block btn--icon bg--facebook type--uppercase" href="#">--}}
                                                                        {{--<span class="btn__text">--}}
                                                                            {{--<i class="socicon-facebook"></i>--}}
                                                                            {{--Login with Facebook--}}
                                                                        {{--</span>--}}
                                                            {{--</a>--}}
                                                            {{--<a class="btn block btn--icon bg--twitter type--uppercase" href="#">--}}
                                                                        {{--<span class="btn__text">--}}
                                                                            {{--<i class="socicon-twitter"></i>--}}
                                                                            {{--Login with Twitter--}}
                                                                        {{--</span>--}}
                                                            {{--</a>--}}
                                                            {{--<hr data-title="OR">--}}
                                                            {{--<div class="feature__body">--}}
                                                                {{--<form>--}}
                                                                    {{--<div class="row">--}}
                                                                        {{--<div class="col-md-12">--}}
                                                                            {{--<input type="text" placeholder="Username" />--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="col-md-12">--}}
                                                                            {{--<input type="password" placeholder="Password" />--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="col-md-12">--}}
                                                                            {{--<button class="btn btn--primary type--uppercase" type="submit">Login</button>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<!--end of row-->--}}
                                                                {{--</form>--}}
                                                                {{--<span class="type--fine-print block">Dont have an account yet?--}}
                                                                            {{--<a href="#">Create account</a>--}}
                                                                        {{--</span>--}}
                                                                {{--<span class="type--fine-print block">Forgot your username or password?--}}
                                                                            {{--<a href="#">Recover account</a>--}}
                                                                        {{--</span>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<!--end of row-->--}}
                                            {{--</div>--}}
                                            {{--<!--end of container-->--}}
                                        {{--</section>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<div class="modal-instance">--}}
                                {{--<a href="#" class="modal-trigger text-white">Create Account</a>--}}
                                {{--<div class="modal-container">--}}
                                    {{--<div class="modal-content">--}}
                                        {{--<section class="imageblock feature-large bg--white border--round ">--}}
                                            {{--<div class="imageblock__content col-lg-5 col-md-3 pos-left">--}}
                                                {{--<div class="background-image-holder">--}}
                                                    {{--<img alt="image" src="/themes/stack/img/cowork-11.jpg" />--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="container">--}}
                                                {{--<div class="row justify-content-end">--}}
                                                    {{--<div class="col-lg-7">--}}
                                                        {{--<div class="row justify-content-center">--}}
                                                            {{--<div class="col-lg-10 col-md-11">--}}
                                                                {{--<h2>Create an account</h2>--}}
                                                                {{--<p class="lead">Get started with a 14 day free trial, No credit card required &mdash; cancel at any time.</p>--}}
                                                                {{--<a class="btn block btn--icon bg--facebook type--uppercase" href="#">--}}
                                                                            {{--<span class="btn__text">--}}
                                                                                {{--<i class="socicon-facebook"></i>--}}
                                                                                {{--Sign up with Facebook--}}
                                                                            {{--</span>--}}
                                                                {{--</a>--}}
                                                                {{--<a class="btn block btn--icon bg--twitter type--uppercase" href="#">--}}
                                                                            {{--<span class="btn__text">--}}
                                                                                {{--<i class="socicon-twitter"></i>--}}
                                                                                {{--Sign up with Twitter--}}
                                                                            {{--</span>--}}
                                                                {{--</a>--}}
                                                                {{--<hr data-title="OR">--}}
                                                                {{--<form>--}}
                                                                    {{--<div class="row">--}}
                                                                        {{--<div class="col-12">--}}
                                                                            {{--<input type="email" name="Email Address" placeholder="Email Address" />--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="col-12">--}}
                                                                            {{--<input type="password" name="Password" placeholder="Password" />--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="col-12">--}}
                                                                            {{--<button type="submit" class="btn btn--primary type--uppercase">Create Account</button>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="col-12">--}}
                                                                                    {{--<span class="type--fine-print">By signing up, you agree to the--}}
                                                                                        {{--<a href="#">Terms of Service</a>--}}
                                                                                    {{--</span>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<!--end row-->--}}
                                                                {{--</form>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<!--end of row-->--}}
                                                    {{--</div>--}}
                                                    {{--<!--end of col-->--}}
                                                {{--</div>--}}
                                                {{--<!--end of row-->--}}
                                            {{--</div>--}}
                                            {{--<!--end of container-->--}}
                                        {{--</section>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        <li>
                            <a href="#" data-notification-link="side-menu">
                                <i class="stack-dot-3 text-white"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
<!--end bar-->
{{--<div class="notification pos-right pos-top side-menu bg--white" data-notification-link="side-menu" data-animation="from-right">--}}
    {{--<div class="side-menu__module">--}}
        {{--<a class="btn btn--icon bg--facebook block" href="#">--}}
                    {{--<span class="btn__text">--}}
                        {{--<i class="socicon-facebook"></i>--}}
                        {{--Sign up with Facebook--}}
                    {{--</span>--}}
        {{--</a>--}}
        {{--<a class="btn btn--icon bg--dark block" href="#">--}}
                    {{--<span class="btn__text">--}}
                        {{--<i class="socicon-mail"></i>--}}
                        {{--Sign up with Email--}}
                    {{--</span>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<!--end module-->--}}
    {{--<hr>--}}
    {{--<div class="side-menu__module">--}}
        {{--<span class="type--fine-print float-left">Already have an account?</span>--}}
        {{--<a class="btn type--uppercase float-right" href="#">--}}
            {{--<span class="btn__text">Login</span>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<!--end module-->--}}
    {{--<hr>--}}
    {{--<div class="side-menu__module">--}}
        {{--<ul class="list--loose list--hover">--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<span class="h5">About Stack</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<span class="h5">Careers</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<span class="h5">Investors</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<span class="h5">Locations</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<span class="h5">Contact</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<!--end module-->--}}
    {{--<hr>--}}
    {{--<div class="side-menu__module">--}}
        {{--<ul class="social-list list-inline list--hover">--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<i class="socicon socicon-google icon icon--xs"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<i class="socicon socicon-twitter icon icon--xs"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<i class="socicon socicon-facebook icon icon--xs"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<i class="socicon socicon-instagram icon icon--xs"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--<i class="socicon socicon-pinterest icon icon--xs"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="notification pos-top pos-right search-box bg--white border--bottom" data-animation="from-top" data-notification-link="search-box">--}}
    {{--<form>--}}
        {{--<div class="row justify-content-center">--}}
            {{--<div class="col-lg-6 col-md-8">--}}
                {{--<input type="search" name="query" placeholder="Type search query and hit enter" />--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!--end of row-->--}}
    {{--</form>--}}
{{--</div>--}}

@include('contentmanagement::theme.Stack._partials.navbar')

<div class="main-container">

    @yield('content')

    <footer class="footer-3 text-center-xs space--xs ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img alt="Image" class="logo" src="{{ $active_theme->logo ? 'storage/'.$active_theme->logo : '' }}" />
                    <ul class="list-inline list--hover">
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="type--fine-print">Get Started</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="type--fine-print">help@iionstech.com</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-right text-center-xs">
                    <ul class="social-list list-inline list--hover">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="socicon socicon-google icon icon--xs"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="socicon socicon-twitter icon icon--xs"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="socicon socicon-facebook icon icon--xs"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="socicon socicon-instagram icon icon--xs"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end of row-->
            <div class="row">
                <div class="col-md-6">
                    <p class="type--fine-print">
                        Supercharge your web workflow
                    </p>
                </div>
                <div class="col-md-6 text-right text-center-xs">
                            <span class="type--fine-print">&copy;
                                <span class="update-year"></span> Stack Inc.</span>
                    <a class="type--fine-print" href="#">Privacy Policy</a>
                    <a class="type--fine-print" href="#">Legal</a>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </footer>
</div>
<!--<div class="loader"></div>-->
<a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
    <i class="stack-interface stack-up-open-big"></i>
</a>

@include('contentmanagement::theme.Stack._partials.scripts')
<script src="{{ mix('js/contentmanagement.js') }}"></script>
</body>
</html>
