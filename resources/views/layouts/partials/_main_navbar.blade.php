<nav class="navbar navbar-default navbar-fixed-top keep-navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#keep-nav">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">KEEP</a>
        </div>

        <div class="collapse navbar-collapse" id="keep-nav">
            <ul class="nav navbar-nav">
                @if (auth()->check())
                    <li><a href="{{ route('member::dashboard', $authUser) }}">Dashboard</a></li>
                    <li><a href="{{ route('member::tasks.create', $authUser) }}">Schedule New Task</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('member::tags.all', $authUser) }}">Tags</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('member::priorities.all', $authUser) }}">Priorities</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('member::groups.all', $authUser) }}">Groups</a></li>
                    <li>
                        <a href="{{ route('member::notifications.personal', $authUser) }}">Notifications</a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (auth()->guest())
                    <li><a href="{{ route('auth::register') }}">Register</a></li>
                    <li><a href="{{ route('auth::login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $authUser->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('member::profile', $authUser) }}">Profile</a></li>
                            <li class="divider"></li>
                            @if ($authUser->isAdmin())
                                <li><a href="{{ route('admin::dashboard') }}">Admin Panel</a></li>
                                <li class="divider"></li>
                            @endif
                            <li><a href="{{ route('auth::logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>