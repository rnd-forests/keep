<div class="panel">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="text-center">
                @include('users.partials.avatar', ['size' => 180])
            </div>
        </li>
        <div class="text-center">
            <h2 class="username">{{ $user->name }}</h2>
        </div>
        @if($user->roles->contains('name', 'admin'))
            <div class="list-group-item">
                <span class="label label-primary">Administrator</span>
            </div>
        @endif
        <li class="list-group-item">
            <h6 class="list-group-item-heading">E-Mail Address</h6>
            {{ $user->email }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Address</h6>
            {{ $user->present()->attribute($user->address) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Company</h6>
            {{ $user->present()->attribute($user->company) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Personal Website</h6>
            {{ $user->present()->attribute($user->website) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Phone Number</h6>
            {{ $user->present()->attribute($user->phone) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">About Yourself</h6>
            {{ $user->present()->attribute($user->about) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Joined Date</h6>
            {{ $user->present()->formatTime($user->created_at) }}
        </li>
    </ul>
</div>