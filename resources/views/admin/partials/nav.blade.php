<nav class="navbar navbar-fixed-top admin-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#admin-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home_path') }}">@Keep</a>
    </div>

    <div class="sidebar" role="navigation">
        <div class="sidebar-nav" id="admin-navbar-collapse">
            <ul class="nav" id="side-menu">
                <div class="admin-user text-center">
                    @include('users.partials.avatar', ['size' => 80])
                    <h4><a href="{{ route('users.show', $user->slug) }}">{{ $user->name }}</a></h4>
                </div>
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a></li>
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i>Manage Accounts<span class="fa arrow-control"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('admin.active.accounts') }}">Active Accounts</a></li>
                        <li><a href="{{ route('admin.disabled.accounts') }}">Disabled Accounts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i>Manage Groups<span class="fa arrow-control"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('admin.groups.create') }}">Create Group</a></li>
                        <li><a href="{{ route('admin.active.groups') }}">Active Groups</a></li>
                        <li><a href="{{ route('admin.trashed.groups') }}">Trashed Groups</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-tasks fa-fw"></i>Manage Tasks<span class="fa arrow-control"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('admin.manage.tasks') }}">Active Tasks</a></li>
                        <li><a href="{{ route('admin.trashed.tasks') }}">Trashed Tasks</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bell-o fa-fw"></i>Notifications<span class="fa arrow-control"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#">Manage notifications</a></li>
                        <li><a href="#">Create notification</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>