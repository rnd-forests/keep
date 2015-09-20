<nav class="navbar navbar-default keep-navigation">
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
                @if (auth()->check())
                    <li><a href="{{ route('member::dashboard', $authUser) }}">Dashboard</a></li>
                    <li><a href="{{ route('member::tasks.create', $authUser) }}">Schedule Task</a></li>
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown">
                            Filters <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('member::tags.all', $authUser) }}">Tags</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('member::priorities.all', $authUser) }}">Priorities</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('member::groups.all', $authUser) }}">Groups</a></li>
                    <li>
                        <a href="{{ route('member::notifications',
                            ['users' => $authUser, 'type' => 'personal']) }}">
                            Notifications
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (auth()->guest())
                    <li><a href="{{ route('auth::login') }}">Log In</a></li>
                    <li><a href="{{ route('auth::register') }}">Sign Up</a></li>
                @else
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown">
                            {{ $authUser->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('member::profile.show', $authUser) }}">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('member::profile.edit', $authUser) }}">Edit Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('member::account.show', $authUser) }}">Account</a></li>
                            <li class="divider"></li>
                            @if ($authUser->isAdmin())
                                <li><a href="{{ route('admin::dashboard') }}">Admin Panel</a></li>
                                <li class="divider"></li>
                            @endif
                            <li><a href="{{ route('auth::logout') }}">Log out</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>