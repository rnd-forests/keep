<div class="panel panel-warning">
    <div class="panel-heading">Deadline</div>
    <div class="list-group">
        @foreach($deadlineTasks as $task)
            <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                <h5>{{ $task->title }}</h5>
                <h6 class="text-warning">{{ remaining_days($task->finishing_date) }}</h6>
            </a>
        @endforeach
    </div>
</div>