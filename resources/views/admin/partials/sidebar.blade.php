<div class="col-sm-3 col-md-2 sidebar">
    <div class="text-center">
        @include('users.partials.avatar', ['size' => 80])
        <h4 class="text-warning">{{ $user->name }}</h4>
    </div>
    <ul class="nav nav-sidebar">
        <li class="active"><a href="{{ route('admin.dashboard') }}">Overview <span class="sr-only">(current)</span></a></li>
        <li><a href="{{ route('admin.manage.members') }}">Manage Member Accounts</a></li>
        <li><a href="#">Manage Published Tasks</a></li>
        <li><a href="#">Notification Center</a></li>
    </ul>
    <ul class="nav nav-sidebar">
        <li><a href="#">Analytics</a></li>
        <li><a href="#">Charts</a></li>
        <li><a href="#">Mailbox</a></li>
    </ul>
</div>