<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('cms.admin') }}" class="site_title">
                <img src="{{ asset('/images/logo.png') }}" alt="" width="220">
            </a>
        </div>
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">

            <div class="profile_pic">
                <img src="/asset/gentelella/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <h2>{{ auth()->user()->name ?? '' }}</h2>
                <h2>[ {{ auth()->user()->hospital->hospital_name ?? '' }} ]</h2>
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
                        <a href="{{ route('hospital.index') }}">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hospital.patients') }}">
                            <i class="fa fa-users"></i> Patients Information
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hospital.profile') }}">
                            <i class="fa fa-hospital-o"></i> Profile
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
@include('layouts.gentelella.navbar')
<!-- /top navigation -->
