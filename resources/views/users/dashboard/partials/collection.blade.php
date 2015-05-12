<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="list-group">
            <div class="list-group-item active">
                <div class="text-center">
                    @yield('task-type')
                </div>
            </div>
            @foreach($tasks as $task)
                <a href="{{ route('users.tasks.show', [$user, $task]) }}" class="list-group-item">
                    {{ $task->title }}
                    <span class="badge">{{ $task->present()->formatTimeForHumans($task->created_at) }}</span>
                </a>
            @endforeach
        </div>
        <div class="text-center">{!! $tasks->render() !!}</div>
    </div>
</div>