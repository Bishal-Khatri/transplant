<nav class="navbar navbar-expand-md navbar-default fixed-top">
    <div class="navbar-header">
        <div id="mobile-menu">
            <div class="left-nav-toggle">
                <a href="#">
                    <i class="stroke-hamburgermenu"></i>
                </a>
            </div>
        </div>
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Laravel') }}
            <span>v.{{ config('app.app_version', '0.0.0') }}</span>
        </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <div class="left-nav-toggle">
            <a href="">
                <i class="stroke-hamburgermenu"></i>
            </a>
        </div>
        <form class="navbar-form  mr-auto">
            <input type="text" class="form-control" placeholder="Search data for analysis" style="width: 175px">
        </form>
        @auth
            <ul class="nav navbar-nav">
                <li class="nav-item uppercase-link">
                    <a href="versions.html" class="nav-link">Versions
                        <span class="label label-warning pull-right">2</span>
                    </a>
                </li>
                <li class="nav-item uppercase-link">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                <li class="nav-item profil-link">
                    <a href="#">
                        <span class="profile-address">{{ Auth::user()->name }}</span>
                        <img src="{{ asset('asset/images/profile.jpg') }}" class="rounded-circle" alt="">
                    </a>
                </li>
            </ul>
    </div>
    @endauth
</nav>
