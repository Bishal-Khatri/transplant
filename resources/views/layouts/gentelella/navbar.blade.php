<div class="top_nav">
    <div class="nav_menu">
        {{--<div class="nav toggle">--}}
            {{--<a id="menu_toggle"><i class="fa fa-bars"></i></a>--}}
        {{--</div>--}}

        <nav class="nav navbar-nav">
            <ul class="navbar-right">

                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="/asset/gentelella/images/img.jpg" alt="">{{ auth()->user()->name ?? '' }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="javascript:;">
                            <span>Settings</span>
                        </a>
                        <a class="dropdown-item"  href="javascript:;">Help</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                        {{--<a class="dropdown-item"  href="javascript:;"><i class="fa fa-sign-out pull-right"></i> Log Out</a>--}}
                    </div>
                </li>
                <li role="presentation" class="nav-item dropdown open">
                    <a href="{{ route('cms.index') }}" target="_blank">
                        <i class="fa fa-globe" style="font-size: 30px;"></i>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>
