<nav class="navbar navbar-default navbar-fixed-top keep-navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#keep-navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">@KEEP</a>
        </div>
        <div id="keep-navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Members</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.active.accounts') }}">Active</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin.disabled.accounts') }}">Disabled</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Groups</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.groups.create') }}">Create</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin.active.groups') }}">Active</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin.trashed.groups') }}">Trashed</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tasks</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.manage.tasks') }}">Active</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin.trashed.tasks') }}">Trashed</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Assignments</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.assignments.all') }}">Collection</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-toggle="modal" data-target="#assignment-selection-modal">Create</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Notifications</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Manage</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Create</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('users.show', Auth::user()->slug) }}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

@include('admin.layouts.assignment_selection')