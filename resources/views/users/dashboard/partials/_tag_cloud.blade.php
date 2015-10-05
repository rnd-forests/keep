<div class="panel panel-info">
    <div class="panel-heading">Tag Cloud</div>
    <div class="panel-body tag-cloud">
        @foreach($tags as $tag)
            <a href="{{ route('user.tags.task', [$authUser, $tag]) }}">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>