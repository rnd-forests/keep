<div class="user-avatar">
    <a href="{{ route('users.show', $user->slug) }}">
        <img class="user-avatar-picture" src="{{ $user->present()->gravatar(isset($size) ? $size : 50) }}" alt="{{ $user->username }}" />
    </a>
</div>
