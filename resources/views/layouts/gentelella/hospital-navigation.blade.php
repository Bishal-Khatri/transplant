<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('cms.admin') }}" class="site_title"><i class="fa fa-paw"></i> <span>Organ Transplant</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="/asset/gentelella/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ auth()->user()->name ?? '' }}</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Main Menu</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('hospital.patients') }}">
                            <i class="fa fa-folder-o"></i> Patient Waiting List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hospital.profile') }}">
                            <i class="fa fa-folder-open"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" href="{{ route('logout') }}" data-placement="top" title="Logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
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
                        <a class="dropdown-item"  href="javascript:;"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>
                <li role="presentation" class="nav-item dropdown open">
                    <a href="{{ route('cms.index') }}" >
                        <i class="fa fa-globe"></i>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
