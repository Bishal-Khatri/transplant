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
                <h3>Administrator</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.religion') }}">
                            <i class="fa fa-dashboard"></i> Religions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ethnic-group') }}">
                            <i class="fa fa-dashboard"></i> Ethnic Groups
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.disease') }}">
                            <i class="fa fa-dashboard"></i> Diseases
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.education-level') }}">
                            <i class="fa fa-dashboard"></i> Education Level
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.occupation') }}">
                            <i class="fa fa-dashboard"></i> Occupations
                        </a>
                    </li>
                </ul>

                <h3>Content Management</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('cms.page.index') }}">
                            <i class="fa fa-folder-o"></i> Pages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cms.category.index') }}">
                            <i class="fa fa-folder-open"></i> Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cms.theme.index') }}">
                            <i class="fa fa-laptop"></i> Theme Setting
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cms.menu.index') }}">
                            <i class="fa fa-file-image-o"></i> Menu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cms.storage.gallery.index') }}">
                            <i class="fa fa-dropbox"></i> Storage
                        </a>
                    </li>
                    {{--<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>--}}
                    {{--<ul class="nav child_menu">--}}
                    {{--<li><a href="index.html">Dashboard</a></li>--}}
                    {{--<li><a href="index2.html">Dashboard2</a></li>--}}
                    {{--<li><a href="index3.html">Dashboard3</a></li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}

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
            {{--<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">--}}
            {{--<span class="glyphicon glyphicon-off" aria-hidden="true"></span>--}}
            {{--</a>--}}
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
