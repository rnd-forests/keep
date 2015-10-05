<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#keep-nav">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">KEEP</a>
        </div>

        <div class="collapse navbar-collapse" id="keep-nav">
            <ul class="nav navbar-nav">
                @if(auth()->check())
                    <li><a href="{{ route('user.dashboard', $authUser) }}">Dashboard</a></li>
                    <li><a href="{{ route('user.tasks.create', $authUser) }}">Schedule Task</a></li>
                    <li>
                        <a href="{{ route('user.notifications',
                            ['users' => $authUser, 'type' => 'personal']) }}">
                            Notifications
                        </a>
                    </li>
                    <li><a href="{{ route('user.groups.all', $authUser) }}">Groups</a></li>
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown">
                            Personal <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('user.profile.show', $authUser) }}">Profile</a></li>
                            <li><a href="{{ route('user.account.show', $authUser) }}">Account</a></li>
                            @if ($authUser->can('act-as-admin'))
                                <li><a href="{{ route('admin.dashboard') }}">Administrator</a></li>
                            @endif
                            <li><a href="{{ route('auth.logout') }}">Sign Out</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            @if(auth()->guest())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('auth.login') }}">Sign In</a></li>
                    <li><a href="{{ route('auth.register') }}">Sign Up</a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>