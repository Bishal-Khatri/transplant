<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Organ Transplant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site Description Here">
    @include('contentmanagement::theme.Stack._partials.css')
</head>
<body class=" ">
<a id="start"></a>
<section class="bar bar-3 bar--sm bg--secondary" style="background-color: #1e5ea4; color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="bar__module">
                    <span class="type--fade">Nepal Medical Council (NMC)</span>
                </div>
            </div>
            <div class="col-lg-6 text-right text-left-xs text-left-sm">
                <div class="bar__module">
                    <ul class="menu-horizontal">
                        <li>
                            <div class="modal-instance">
                                <a href="#" class="modal-trigger text-white">Login</a>
                                <div class="modal-container">
                                    <div class="modal-content section-modal">
                                        <section class="unpad">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="boxed boxed--lg bg--white text-center feature">
                                                            <div class="modal-close modal-close-cross"></div>
                                                            <h3>Login to Your Account</h3>
                                                            <a class="btn block btn--icon bg--facebook type--uppercase" href="#">
                                                                        <span class="btn__text">
                                                                            <i class="socicon-facebook"></i>
                                                                            Login with Facebook
                                                                        </span>
                                                            </a>
                                                            <a class="btn block btn--icon bg--twitter type--uppercase" href="#">
                                                                        <span class="btn__text">
                                                                            <i class="socicon-twitter"></i>
                                                                            Login with Twitter
                                                                        </span>
                                                            </a>
                                                            <hr data-title="OR">
                                                            <div class="feature__body">
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="text" placeholder="Username" />
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <input type="password" placeholder="Password" />
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn--primary type--uppercase" type="submit">Login</button>
                                                                        </div>
                                                                    </div>
                                                                    <!--end of row-->
                                                                </form>
                                                                <span class="type--fine-print block">Dont have an account yet?
                                                                            <a href="#">Create account</a>
                                                                        </span>
                                                                <span class="type--fine-print block">Forgot your username or password?
                                                                            <a href="#">Recover account</a>
                                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end of row-->
                                            </div>
                                            <!--end of container-->
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="modal-instance">
                                <a href="#" class="modal-trigger text-white">Create Account</a>
                                <div class="modal-container">
                                    <div class="modal-content">
                                        <section class="imageblock feature-large bg--white border--round ">
                                            <div class="imageblock__content col-lg-5 col-md-3 pos-left">
                                                <div class="background-image-holder">
                                                    <img alt="image" src="img/cowork-11.jpg" />
                                                </div>
                                            </div>
                                            <div class="container">
                                                <div class="row justify-content-end">
                                                    <div class="col-lg-7">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-10 col-md-11">
                                                                <h2>Create an account</h2>
                                                                <p class="lead">Get started with a 14 day free trial, No credit card required &mdash; cancel at any time.</p>
                                                                <a class="btn block btn--icon bg--facebook type--uppercase" href="#">
                                                                            <span class="btn__text">
                                                                                <i class="socicon-facebook"></i>
                                                                                Sign up with Facebook
                                                                            </span>
                                                                </a>
                                                                <a class="btn block btn--icon bg--twitter type--uppercase" href="#">
                                                                            <span class="btn__text">
                                                                                <i class="socicon-twitter"></i>
                                                                                Sign up with Twitter
                                                                            </span>
                                                                </a>
                                                                <hr data-title="OR">
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <input type="email" name="Email Address" placeholder="Email Address" />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="password" name="Password" placeholder="Password" />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <button type="submit" class="btn btn--primary type--uppercase">Create Account</button>
                                                                        </div>
                                                                        <div class="col-12">
                                                                                    <span class="type--fine-print">By signing up, you agree to the
                                                                                        <a href="#">Terms of Service</a>
                                                                                    </span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end row-->
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!--end of row-->
                                                    </div>
                                                    <!--end of col-->
                                                </div>
                                                <!--end of row-->
                                            </div>
                                            <!--end of container-->
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </li>
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
<div class="notification pos-right pos-top side-menu bg--white" data-notification-link="side-menu" data-animation="from-right">
    <div class="side-menu__module">
        <a class="btn btn--icon bg--facebook block" href="#">
                    <span class="btn__text">
                        <i class="socicon-facebook"></i>
                        Sign up with Facebook
                    </span>
        </a>
        <a class="btn btn--icon bg--dark block" href="#">
                    <span class="btn__text">
                        <i class="socicon-mail"></i>
                        Sign up with Email
                    </span>
        </a>
    </div>
    <!--end module-->
    <hr>
    <div class="side-menu__module">
        <span class="type--fine-print float-left">Already have an account?</span>
        <a class="btn type--uppercase float-right" href="#">
            <span class="btn__text">Login</span>
        </a>
    </div>
    <!--end module-->
    <hr>
    <div class="side-menu__module">
        <ul class="list--loose list--hover">
            <li>
                <a href="#">
                    <span class="h5">About Stack</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="h5">Careers</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="h5">Investors</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="h5">Locations</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="h5">Contact</span>
                </a>
            </li>
        </ul>
    </div>
    <!--end module-->
    <hr>
    <div class="side-menu__module">
        <ul class="social-list list-inline list--hover">
            <li>
                <a href="#">
                    <i class="socicon socicon-google icon icon--xs"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="socicon socicon-twitter icon icon--xs"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="socicon socicon-facebook icon icon--xs"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="socicon socicon-instagram icon icon--xs"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="socicon socicon-pinterest icon icon--xs"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="notification pos-top pos-right search-box bg--white border--bottom" data-animation="from-top" data-notification-link="search-box">
    <form>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <input type="search" name="query" placeholder="Type search query and hit enter" />
            </div>
        </div>
        <!--end of row-->
    </form>
</div>

@include('contentmanagement::theme.Stack._partials.navbar')

<div class="main-container">
    <section class="cover height-80 imagebg switchable siwtchable--switch" data-overlay="8">
        <div class="background-image-holder">
            <img alt="background" src="{{ asset('themes/stack/images/banner.jpg') }}" />
        </div>
        <div class="container pos-vertical-center">
            <div class="row justify-content-around">
                <div class="col-lg-5 col-md-7">
                    <div class="switchable__text">
                        <h1>
                            Welcome to NMC
                        </h1>
                        <p class="lead">
                            Nepal Medical Council (NMC) was established in 2020 by the act of Parliament.
                        </p>
                        <a class="btn btn--primary type--uppercase" href="/">
                            <span class="btn__text">Read More</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-12">
                    <div class="video-cover border--round box-shadow-wide">
                        <div class="background-image-holder">
                            <img alt="image" src="{{ asset('themes/stack/images/banner.jpg') }}" />
                        </div>
                        <div class="video-play-icon"></div>
                        <iframe data-src="https://www.youtube.com/embed/6p45ooZOOPo?autoplay=1" allowfullscreen="allowfullscreen"></iframe>
                    </div>
                    <!--end video cover-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <h2>All the tools you'll need</h2>
                    <p class="lead">
                        Whether you’re building a welcome mat for your SaaS or a clean, corporate portfolio, Stack has your design needs covered.
                    </p>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature feature-3 boxed boxed--lg boxed--border text-center">
                        <i class="icon icon--lg icon-Mail-3"></i>
                        <h4>Mailer Integrations</h4>
                        <p>
                            Stack comes with integration for Mail Chimp and Campaign Monitor forms - ideal for modern marketing campaigns
                        </p>
                        <a href="#">
                            Learn More
                        </a>
                    </div>
                    <!--end feature-->
                </div>
                <div class="col-md-4">
                    <div class="feature feature-3 boxed boxed--lg boxed--border text-center">
                        <i class="icon icon--lg icon-Air-Balloon"></i>
                        <h4>Diverse Icons</h4>
                        <p>
                            Including the premium Icons Mind icon kit, Stack features a highly diverse set of icons suitable for all purposes.
                        </p>
                        <a href="#">
                            Learn More
                        </a>
                        <span class="label">New</span>
                    </div>
                    <!--end feature-->
                </div>
                <div class="col-md-4">
                    <div class="feature feature-3 boxed boxed--lg boxed--border text-center">
                        <i class="icon icon--lg icon-Bacteria"></i>
                        <h4>Modular Design</h4>
                        <p>
                            Combine blocks from a range of categories to build pages that are rich in visual style and interactivity
                        </p>
                        <a href="#">
                            Learn More
                        </a>
                    </div>
                    <!--end feature-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="imagebg">
        <div class="background-image-holder">
            <img alt="background" src="{{ asset('themes/stack/img/landing-6.jpg') }}" />
        </div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-7 col-lg-5">
                    <div class="boxed boxed--lg border--round bg--white">
                        <div class="col-lg-10 mx-auto col-md-12">
                            <h3>Experience quality</h3>
                            <p class="lead">
                                Stack is built with customization and ease-of-use at its core &mdash; whether you're a seasoned developer or just starting out, you'll be making attractive sites faster than any traditional HTML template.
                            </p>
                            <hr class="short" />
                            <p>
                                Each purchase of Stack includes six months of free support and lifetime free content and bug-fix updates.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="text-center bg--secondary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <h2>Perfect for Designers &amp; Developers</h2>
                    <p class="lead">
                        Whether you’re building a welcome mat for your SaaS or a clean, corporate portfolio, Stack has your design needs covered.
                    </p>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="bg--secondary imagebg image--light">
        <div class="background-image-holder visible-lg">
            <img alt="background" src="{{ asset('themes/stack/img/device-bg-1.jpg') }}" />
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="tabs-container" data-content-align="left">
                        <ul class="tabs">
                            <li class="active">
                                <div class="tab__title">
                                    <span class="h5">Code Quality</span>
                                </div>
                                <div class="tab__content">
                                    <p class="lead">
                                        Stack follows the BEM naming convention that focusses on logical code readability that is reflected in both the HTML and CSS. Interactive elements such as accordions and tabs follow the same markup patterns making rapid development easier for developers and beginners alike.
                                    </p>
                                    <p class="lead">
                                        Add to this the thoughtfully presented documentation, featuring code highlighting, snippets, class customizer explanation and you've got yourself one powerful value package.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="tab__title">
                                    <span class="h5">Visual Design</span>
                                </div>
                                <div class="tab__content">
                                    <p class="lead">
                                        Stack offers a clean and contemporary look to suit a range of purposes from corporate, tech startup, marketing site to digital storefront. Elements have been designed to showcase content in a diverse yet consistent manner.
                                    </p>
                                    <p class="lead">
                                        Multiple font and colour scheme options mean that dramatically altering the look of your site is just clicks away &mdash; Customizing your site in the included Variant Page Builder makes experimenting with styles and content arrangements dead simple.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="tab__title">
                                    <span class="h5">Stack Experience</span>
                                </div>
                                <div class="tab__content">
                                    <p class="lead">
                                        Medium Rare is an elite author known for offering high-quality, high-value products backed by timely and personable support. Recognised and awarded by Envato on multiple occasions for producing consistently outstanding products, there's no wonder over 20,000 customers enjoy using Medium Rare templates.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--end of tabs container-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <section class="text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="cta">
                        <h2>Purchase Stack now and get lifetime free content updates</h2>
                        <p class="lead">
                            Each purchase of Stack comes with six months free support &mdash; and a lifetime of free content and bug-fix updates.
                        </p>
                        <a class="btn btn--primary type--uppercase" href="#">
                                    <span class="btn__text">
                                        Purchase on Envato
                                    </span>
                            <span class="label">$19 USD</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <footer class="footer-3 text-center-xs space--xs ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img alt="Image" class="logo" src="{{ asset('themes/stack/img/logo-dark.png') }}" />
                    <ul class="list-inline list--hover">
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="type--fine-print">Get Started</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="type--fine-print">help@stack.io</span>
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
</body>
</html>
