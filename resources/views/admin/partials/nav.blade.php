<nav class="navbar navbar-default navbar-fixed-top keep-navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#keep-navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home_path') }}">@KEEP</a>
        </div>
        <div id="keep-navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Accounts <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.active.accounts') }}">Active Accounts</a></li>
                        <div class="divider"></div>
                        <li><a href="{{ route('admin.disabled.accounts') }}">Disabled Accounts</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Groups <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.groups.create') }}">Create Group</a></li>
                        <div class="divider"></div>
                        <li><a href="{{ route('admin.active.groups') }}">Active Groups</a></li>
                        <div class="divider"></div>
                        <li><a href="{{ route('admin.trashed.groups') }}">Trashed Groups</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tasks <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.manage.tasks') }}">Active Tasks</a></li>
                        <div class="divider"></div>
                        <li><a href="{{ route('admin.trashed.tasks') }}">Trashed Tasks</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Notifications <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Manage notifications</a></li>
                        <div class="divider"></div>
                        <li><a href="#">Create notification</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('users.show', Auth::user()->slug) }}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('logout_path') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>