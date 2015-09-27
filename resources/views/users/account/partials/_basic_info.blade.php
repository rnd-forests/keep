<div class="panel panel-default">
    <div class="panel-heading">Public profile</div>
    <ul class="list-group">
        <li class="list-group-item">
            @include('users.account.partials._avatar', ['size' => 180])
            <h2 class="text-center">{{ $user->name }}</h2>
        </li>
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
            <a href="{{ print_attr($user->profile->website) }}">
                {{ print_attr($user->profile->website) }}
            </a>
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
                <a href="{{ $user->present()->googlePlusProfile($user) }}"
                   class="btn btn-social-icon btn-google">
                    <i class="fa fa-google"></i>
                </a>
            @endunless
            @unless(empty($user->profile->facebook_username))
                <a href="{{ $user->present()->facebookProfile($user) }}"
                   class="btn btn-social-icon btn-facebook">
                    <i class="fa fa-facebook"></i>
                </a>
            @endunless
            @unless(empty($user->profile->github_username))
                <a href="{{ $user->present()->githubProfile($user) }}"
                   class="btn btn-social-icon btn-github">
                    <i class="fa fa-github"></i>
                </a>
            @endunless
        </li>
    </ul>
</div>