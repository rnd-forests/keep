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
                @if (Auth::check())
                    <li><a href="{{ route('member::dashboard', Auth::user()) }}">Dashboard</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tasks <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('member::tasks.create', Auth::user()) }}">Schedule New Task</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('member::scheduler', Auth::user()) }}">Tasks Scheduler</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('member::assignments.all', Auth::user()) }}">Assignments</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('member::tags.all', Auth::user()) }}">Tags</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('member::priorities.all', Auth::user()) }}">Priority Levels</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('member::groups.all', Auth::user()) }}">Groups</a></li>
                    <li>
                        <a href="{{ route('member::notifications.personal', Auth::user()) }}" class="notification-count">
                            Notifications
                            <span class="label">{{ $notificationCount }}</span>
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('auth::register') }}">Register</a></li>
                    <li><a href="{{ route('auth::login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('member::profile', Auth::user()) }}">Profile</a></li>
                            <li class="divider"></li>
                            @if (Auth::user()->isAdmin())
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