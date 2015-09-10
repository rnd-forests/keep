<div class="panel panel-info">
    <div class="panel-heading">Recently Completed</div>
    <div class="list-group">
        @foreach($completed as $task)
        <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
            <h5>{{ $task->title }}</h5>
            <h6 class="text-info">completed {{ humans_time($task->finished_at) }}</h6>
        </a>
        @endforeach
    </div>
</div>