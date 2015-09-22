<div class="user-avatar">
    <a href="{{ route('member::profile.show', $user) }}">
        <img class="user-avatar-picture"
             src="{{ $user->present()->gravatar(isset($size) ? $size : 50) }}"
             alt="{{ $user->username }}">
    </a>
</div>
