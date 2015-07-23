<div class="btn-group notification-controls">
    <button type="button" class="btn btn-primary"><i class="fa fa-cog fa-spin"></i></button>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ route('member::notifications.personal', $authUser) }}">
                Notifications for only you
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="{{ route('member::notifications.group', $authUser) }}">
                Notifications from joined groups
            </a>
        </li>
        <li class="divider"></li>
        <li><a href="#">Clear all of your notifications</a></li>
    </ul>
</div>