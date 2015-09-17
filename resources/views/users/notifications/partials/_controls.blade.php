<div class="btn-group notification-controls">
    <button type="button" class="btn btn-primary"><i class="fa fa-cog"></i></button>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ route('member::notifications', ['users' => $authUser, 'type' => 'personal']) }}">
                Personal
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="{{ route('member::notifications', ['users' => $authUser, 'type' => 'group']) }}">
                Joined groups
            </a>
        </li>
    </ul>
</div>