<div class="btn-group notification-controls">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
                From joined groups
            </a>
        </li>
    </ul>
</div>