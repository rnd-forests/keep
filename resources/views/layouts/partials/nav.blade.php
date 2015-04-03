<nav class="navbar navbar-default navbar-fixed-top keep-navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#keep-nav">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home_path') }}">KEEP</a>
        </div>

        <div class="collapse navbar-collapse" id="keep-nav">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home_path') }}"><i class="fa fa-home"></i>Home</a></li>
                @if (Auth::check() && Auth::user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-lock"></i>Admin Panel</a></li>
                @endif
                @if (Auth::check())
                    <li><a href="{{ route('users.tasks.create', Auth::user()->slug) }}"><i class="fa fa-pencil-square-o"></i>Create task</a></li>
                    <li><a href="{{ route('users.tasks.index', Auth::user()->slug) }}"><i class="fa fa-tasks"></i>All Tasks</a></li>
                    <li><a href="#"><i class="fa fa-bell-o"></i>Notifications</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('register_path') }}">Register</a></li>
                    <li><a href="{{ route('login_path') }}">Login</a></li>
                @else
                    <li><a href="{{ route('users.show', Auth::user()->slug) }}"><i class="fa fa-user"></i>{{ Auth::user()->name }}</a></li>
                    <li><a href="{{ route('logout_path') }}"><i class="fa fa-sign-out"></i>Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>