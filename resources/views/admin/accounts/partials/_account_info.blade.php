<div class="panel">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="text-center">
                @include('users.partials._avatar', ['size' => 180])
                <h2 class="username">{{ $user->name }}</h2>
            </div>
        </li>
        @if($user->hasRole('admin'))
            <div class="list-group-item">
                <span class="label label-primary">Administrator</span>
            </div>
        @endif
        <li class="list-group-item">
            <h6 class="list-group-item-heading">E-Mail Address</h6>
            {{ $user->email }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Tasks Count</h6>
            {{ counting($user->tasks) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Biography</h6>
            {{ print_attr($user->profile->bio) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Location</h6>
            {{ print_attr($user->profile->location) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Company</h6>
            {{ print_attr($user->profile->company) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Personal Website</h6>
            {{ print_attr($user->profile->website) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Phone Number</h6>
            {{ print_attr($user->profile->phone) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Joined Date</h6>
            {{ short_time($user->created_at) }}
        </li>
        <li class="list-group-item">
            <h6 class="list-group-item-heading">Social Network Profile</h6>
            @unless(empty($user->profile->twitter_username))
                <a href="{{ $user->present()->twitterProfile($user) }}">
                    <button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Twitter Profile">
                        <i class="fa fa-twitter"></i>
                    </button>
                </a>
            @endunless
            @unless(empty($user->profile->github_username))
                <a href="{{ $user->present()->githubProfile($user) }}">
                    <button class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="GitHub Profile">
                        <i class="fa fa-github"></i>
                    </button>
                </a>
            @endunless
        </li>
    </ul>
</div>