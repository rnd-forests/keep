<nav class="navbar navbar-default keep-navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#keep-navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">KEEP</a>
        </div>
        <div id="keep-navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('admin::dashboard') }}">Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Members <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin::members.active') }}">Active</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin::members.disabled') }}">Disabled</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Groups <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin::groups.active.create') }}">Create</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin::groups.active') }}">Active</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin::groups.trashed') }}">Trash</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tasks <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin::tasks.published') }}">Published</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin::tasks.trashed') }}">Trash</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Notifications <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" data-toggle="modal" data-target="#notification-selection-modal">Create</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin::notifications.all') }}">Collection</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('auth::logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

@include('admin.notifications.partials._notification_modal')