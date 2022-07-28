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
                            <img class="logo logo-dark" alt="logo" src="{{ $active_theme->logo ? '/storage/'.$active_theme->logo : '' }}" />
                            <img class="logo logo-light" alt="logo" src="{{ $active_theme->logo ? '/storage/'.$active_theme->logo : '' }}" />
                        </a>
                    </div>
                    <!--end module-->
                </div>
                <div class="col-lg-11 col-md-12 text-right text-left-xs text-left-sm">
                    <div class="bar__module">
                        <ul class="menu-horizontal text-left">
                            @if(isset($nav_menu) AND !blank($nav_menu))
                                @foreach($nav_menu as $menu)
                                    <?php $url = $menu->getLink(); ?>
                                    @if(isset($menu->children) AND !blank($menu->children))
                                        <li class="dropdown">
                                            <span class="dropdown__trigger">{{ $menu['display_name'] ?? 'No Name' }}</span>
                                            <div class="dropdown__container">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="dropdown__content col-lg-2 col-md-4">
                                                            <ul class="menu-vertical">
                                                                @foreach($menu->children as $children)
                                                                    <?php $url_1 = $children->getLink();?>
                                                                    @if(isset($children->children) AND !blank($children->children))
                                                                        <li class="dropdown">
                                                                            <span class="dropdown__trigger">{{ $children->display_name ?? 'No Name' }}</span>
                                                                            <div class="dropdown__container">
                                                                                <div class="container">
                                                                                    <div class="row">
                                                                                        <div class="dropdown__content col-lg-2 col-md-4">
                                                                                            <ul class="menu-vertical">
                                                                                                @foreach($children->children as $subChildren)
                                                                                                    <?php $url_2 = $subChildren->getLink(); ?>
                                                                                                <li>
                                                                                                    <a href="{{ $url_2 }}">
                                                                                                       {{ $subChildren->display_name ?? 'No Name' }}
                                                                                                    </a>
                                                                                                </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>
                                                                                        <!--end dropdown content-->
                                                                                    </div>
                                                                                    <!--end row-->
                                                                                </div>
                                                                            </div>
                                                                            <!--end dropdown container-->
                                                                        </li>
                                                                    @else
                                                                        <li class="">
                                                                            <a href="{{ $url_1 }}" class="">{{ $children->display_name ?? 'No Name' }}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <!--end dropdown content-->
                                                    </div>
                                                    <!--end row-->
                                                </div>
                                            </div>
                                            <!--end dropdown container-->
                                        </li>
                                    @else
                                        <li class="">
                                            <a href="{{ $url }}" class="">{{ $menu->display_name ?? 'No Name' }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <!--end module-->
                    <div class="bar__module">
                        @if(Route::has('register-hospital') AND auth()->check())
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
