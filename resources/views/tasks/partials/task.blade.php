<div class="task-wrapper">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a class="task-title">{{ $task->title }}</a>
            <h6 class="task-time-ago">{{ $task->present()->formatTimeForHumans($task->created_at) }}</h6>
        </div>
        <div class="panel-body">
            <div class="task-labels">
                <span class="label label-primary">
                    {{ $task->present()->formatTime($task->starting_date) }} to
                    {{ $task->present()->formatTime($task->finishing_date) }}
                </span>
                <span class="label label-primary">{{ $task->present()->getRemainingDays($task->finishing_date) }}</span>
                @if ($task->completed)
                    <span class="label label-info">Completed</span>
                @else
                    <span class="label label-danger">Not completed</span>
                @endif
            </div>
            <div class="well">{{ $task->content }}</div>
            @unless (empty($task->location))
                <div class="well"><i class="fa fa-map-marker"></i><strong>{{ $task->location }}</strong></div>
            @endunless
            @unless ($task->tags->isEmpty())
                <div class="well">
                    <i class="fa fa-tags"></i>
                    @foreach($task->tags as $tag)
                        <span class="label label-default">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endunless
        </div>
    </div>
</div>