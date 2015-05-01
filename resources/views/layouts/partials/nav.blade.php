<nav class="navbar navbar-default navbar-fixed-top keep-navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#keep-nav">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">@KEEP</a>
        </div>

        <div class="collapse navbar-collapse" id="keep-nav">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}">Home</a></li>
                @if (Auth::check() && Auth::user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                @endif
                @if (Auth::check())
                    <li><a href="{{ route('users.tasks.create', Auth::user()) }}">Create task</a></li>
                    <li><a href="{{ route('users.tasks.index', Auth::user()) }}">All tasks</a></li>
                    <li><a href="{{ route('users.tag.list', Auth::user()) }}">Tags</a></li>
                    <li><a href="#">Notifications</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li><a href="{{ route('users.show', Auth::user()) }}">{{ Auth::user()->name }}</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>