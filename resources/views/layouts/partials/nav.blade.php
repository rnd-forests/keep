<nav class="navbar navbar-default navbar-fixed-top keep-navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#keep-nav">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home_path') }}">@KEEP</a>
        </div>

        <div class="collapse navbar-collapse" id="keep-nav">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home_path') }}">Home</a></li>
                @if (Auth::check() && Auth::user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                @endif
                @if (Auth::check())
                    <li><a href="{{ route('users.tasks.create', Auth::user()->slug) }}">Create task</a></li>
                    <li><a href="{{ route('users.tasks.index', Auth::user()->slug) }}">All tasks</a></li>
                    <li><a href="#">Notifications</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('register_path') }}">Register</a></li>
                    <li><a href="{{ route('login_path') }}">Login</a></li>
                @else
                    <li><a href="{{ route('users.show', Auth::user()->slug) }}">{{ Auth::user()->name }}</a></li>
                    <li><a href="{{ route('logout_path') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>