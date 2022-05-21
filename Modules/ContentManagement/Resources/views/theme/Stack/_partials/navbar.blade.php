<div class="nav-container ">
    <div class="bar bar--sm visible-xs">
        <div class="container">
            <div class="row">
                <div class="col-3 col-md-2">
                    <a href="/">
                        {{--                        <img src="{{ $active_theme->logo ? 'storage/'.$active_theme->logo : '' }}" alt="logo" width="400">--}}
                        <img class="logo logo-dark" alt="logo" src="{{ $active_theme->logo ? 'storage/'.$active_theme->logo : '' }}" />
                        <img class="logo logo-light" alt="logo" src="{{ $active_theme->logo ? 'storage/'.$active_theme->logo : '' }}" />
                    </a>
                </div>
                <div class="col-9 col-md-10 text-right">
                    <a href="#" class="hamburger-toggle" data-toggle-class="#menu1;hidden-xs">
                        <i class="icon icon--sm stack-interface stack-menu"></i>
                    </a>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </div>
    <!--end bar-->
    <nav id="menu1" class="bar bar--sm bar-1 hidden-xs bar--absolute bar--transparent">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-md-2 hidden-xs">
                    <div class="bar__module">
                        <a href="/">
                            {{--<img class="logo logo-dark" alt="logo" src="{{ asset('themes/stack/images/logo.png') }}" />--}}
                            {{--<img class="logo logo-light" alt="logo" src="{{ asset('themes/stack/images/logo.png') }}" />--}}
                            <img class="logo logo-dark" alt="logo" src="{{ $active_theme->logo ? 'storage/'.$active_theme->logo : '' }}" />
                            <img class="logo logo-light" alt="logo" src="{{ $active_theme->logo ? 'storage/'.$active_theme->logo : '' }}" />
                        </a>
                    </div>
                    <!--end module-->
                </div>
                <div class="col-lg-11 col-md-12 text-right text-left-xs text-left-sm">
                    <div class="bar__module">
                        <ul class="menu-horizontal text-left">
                            <li class="">
                                <a href="/" class="">Home</a>
                            </li>
                            <li class="">
                                <a href="/" class="">About Us</a>
                            </li>
                            <li class="dropdown">
                                <span class="dropdown__trigger">Notices</span>
                                <div class="dropdown__container">
                                    <div class="container">
                                        <div class="row">
                                            <div class="dropdown__content col-lg-2 col-md-4">
                                                <ul class="menu-vertical">
                                                    <li class="">
                                                        <a href="/" class="">About</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="/" class="">Careers</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="/" class="">Contact</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="/" class="">Pricing</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="/" class="">Accounts</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--end dropdown content-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                                <!--end dropdown container-->
                            </li>
                            <li class="">
                                <a href="/" class="">Documents</a>
                            </li>
                            <li class="">
                                <a href="/" class="">Doctors</a>
                            </li>
                            <li class="">
                                <a href="/" class="">Gallery</a>
                            </li>
                            <li class="">
                                <a href="/" class="">License</a>
                            </li>
                            <li class="">
                                <a href="/" class="">Hospitals</a>
                            </li>

                        </ul>
                    </div>
                    <!--end module-->
                    <div class="bar__module">
                        @if(Route::has('register-hospital'))
                            <a class="btn btn--sm type--uppercase btn-outline-danger" href="{{ route('register-hospital') }}">
                                <span class="btn__text">Register Hospital</span>
                            </a>
                        @endif
                    </div>
                    <!--end module-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </nav>
    <!--end bar-->
</div>
