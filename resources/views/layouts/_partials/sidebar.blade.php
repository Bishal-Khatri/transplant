@auth
    <aside class="navigation">
        <nav>
            <ul class="nav luna-nav">
                <li class="nav-category">
                    Main Menu
                </li>
                <li class="{{ (request()->is('home') OR  request()->is('grocery') OR request()->is('restaurant')) ? 'active' : '' }}">
                    <a href="#dashboard" data-toggle="collapse" aria-expanded="{{ (request()->is('home') OR  request()->is('grocery') OR request()->is('restaurant')) ? 'true' : 'false' }}">
                        Dashboard <span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                    </a>
                    <ul id="dashboard" class="nav nav-second {{ (request()->is('home') OR  request()->is('grocery') OR request()->is('restaurant')) ? 'collapse show' : 'collapse' }}">
                        <li class="{{ (request()->is('home')) ? 'active' : '' }}">
                            <a href="/home">Application</a>
                        </li>
                        @if(Route::has('grocery.index') AND auth()->user()->hasAnyPermission(['list items', 'create items']))
                            <li class="{{ (request()->is('grocery')) ? 'active' : '' }}">
                                <a href="/grocery"> Grocery</a>
                            </li>
                        @endif
                        @if(Route::has('restaurant.index') AND auth()->user()->hasAnyPermission(['list restaurant', 'create restaurant']))
                            <li class="{{ (request()->is('restaurant')) ? 'active' : '' }}">
                                <a href="/restaurant"> Restaurant</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="{{ (request()->is('application/*')) ? 'active' : '' }}">
                    <a href="#application" data-toggle="collapse" aria-expanded="{{ (request()->is('application/*')) ? 'true' : 'false' }}">
                        App CMS <span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                    </a>
                    <ul id="application" class="nav nav-second {{ (request()->is('application/*')) ? 'collapse show' : 'collapse' }}">
                        <li class="@yield('banner_active')">
                            <a href="{{ route('application.banners') }}">Banners</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (request()->is('user') OR request()->is('user/*')) ? 'active' : '' }}">
                    <a href="/user">Users & Authorization</a>
                </li>
                <li class="{{ (request()->is('')) ? 'active' : '' }}">
                    <a href="/grocery">Profile</a>
                </li>
                <li class="{{ (request()->is('')) ? 'active' : '' }}">
                    <a href="/grocery">Settings</a>
                </li>
                <li class="{{ (request()->is('cart/order') OR request()->is('cart/order/*')) ? 'active' : '' }}">
                    <a href="{{ route('cart.order.index') }}">Orders</a>
                </li>

                @if(Route::has('grocery.index') AND auth()->user()->hasAnyPermission(['list items', 'create items']))
                    <li class="nav-category">
                        Grocery Menus
                    </li>
                    <li class="{{ (request()->is('grocery/*')) ? 'active' : '' }}">
                        <a href="#catalog" data-toggle="collapse" aria-expanded="{{ (request()->is('grocery/*')) ? 'true' : 'false' }}">
                            Catalog <span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                        </a>
                        <ul id="catalog" class="nav nav-second {{ (request()->is('grocery/*')) ? 'collapse show' : 'collapse' }}">
                            <li class="@yield('grocery_category_active')">
                                <a href="{{ route('grocery.category.index') }}">Categories</a>
                            </li>
                            @if(Route::has('grocery.index') AND auth()->user()->hasAnyPermission(['list items', 'create items']))
                                <li class="@yield('brand_active')">
                                    <a href="{{ route('grocery.brand.index') }}"> Brands</a>
                                </li>
                            @endif
                            @if(Route::has('restaurant.index') AND auth()->user()->hasAnyPermission(['list restaurant', 'create restaurant']))
                                <li class="@yield('item_active')">
                                    <a href="{{ route('grocery.item.index') }}"> Items</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(Route::has('restaurant.index') AND auth()->user()->hasAnyPermission(['list restaurant', 'create restaurant']))
                    <li class="nav-category">
                        Restaurant Menu
                    </li>
                    <li class="@yield('amenity_active')">
                        <a href="{{ route('restaurant.amenity.index') }}">Amenities</a>
                    </li>
                    <li class="@yield('restaurant_category_active')">
                        <a href="{{ route('restaurant.category.index') }}">Categories</a>
                    </li>
                    <li class="{{ (request()->is('restaurant/list')) ? 'active' : '' }}">
                        <a href="/restaurant/list">Restaurant List</a>
                    </li>
                @endif

                <li class="nav-info">
                    <i class="pe pe-7s-shield text-accent"></i>

                    <div class="m-t-xs">
                        <span class="c-white">D-ONE</span> admin control panel. By <a href="">iions Technology</a>.
                    </div>
                </li>
            </ul>
        </nav>
    </aside>
@endauth
