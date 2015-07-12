<div class="text-center">
    @include('users.partials._avatar', ['size' => 180])
    <h2 class="username">{{ $user->name }}</h2>
</div>
<div class="panel panel-default">
    <ul class="list-group">
        <li class="list-group-item">
            <h6 class="list-group-item-heading">E-Mail Address</h6>
            {{ $user->email }}
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
            @unless(empty($user->profile->google_username))
                <a href="{{ $user->present()->googlePlusProfile($user) }}">
                    <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Google Plus Profile">
                        <i class="fa fa-google"></i>
                    </button>
                </a>
            @endunless
            @unless(empty($user->profile->facebook_username))
                <a href="{{ $user->present()->facebookProfile($user) }}">
                    <button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Facebook Profile">
                        <i class="fa fa-facebook"></i>
                    </button>
                </a>
            @endunless
            @unless(empty($user->profile->github_username))
                <a href="{{ $user->present()->githubProfile($user) }}">
                    <button class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="GitHub Profile">
                        <i class="fa fa-github"></i>
                    </button>
                </a>
            @endunless
        </li>
    </ul>
</div>