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
                <li class="{{ (request()->is('grocery/category')) ? 'active' : '' }}">
                    <a href="/grocery">App CMS</a>
                </li>
                <li class="{{ (request()->is('user') OR request()->is('user/*')) ? 'active' : '' }}">
                    <a href="/user">Users</a>
                </li>
                <li class="{{ (request()->is('grocery/category')) ? 'active' : '' }}">
                    <a href="/grocery">Authorization</a>
                </li>
                <li class="{{ (request()->is('grocery/category')) ? 'active' : '' }}">
                    <a href="/grocery">Profile</a>
                </li>
                <li class="{{ (request()->is('grocery/category')) ? 'active' : '' }}">
                    <a href="/grocery">Settings</a>
                </li>

                @if(Route::has('grocery.index') AND auth()->user()->hasAnyPermission(['list items', 'create items']))
                    <li class="nav-category">
                        Grocery Menus
                    </li>
                    <li class="{{ (request()->is('grocery/category')) ? 'active' : '' }}">
                        <a href="/grocery">Categories</a>
                    </li>
                    <li class="{{ (request()->is('grocery/items')) ? 'active' : '' }}">
                        <a href="/grocery">Items</a>
                    </li>
                    <li class="{{ (request()->is('grocery/orders')) ? 'active' : '' }}">
                        <a href="/grocery">Orders</a>
                    </li>
                @endif

                @if(Route::has('restaurant.index') AND auth()->user()->hasAnyPermission(['list restaurant', 'create restaurant']))
                    <li class="nav-category">
                        Restaurant Menu
                    </li>
                    <li class="{{ (request()->is('restaurant/list')) ? 'active' : '' }}">
                        <a href="/restaurant">Restaurant List</a>
                    </li>
                    <li class="{{ (request()->is('restaurant/orders')) ? 'active' : '' }}">
                        <a href="/restaurant">Orders</a>
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
