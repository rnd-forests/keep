@unless(blank($completed))
    <div class="panel panel-primary">
        <div class="panel-heading">Recently Completed</div>
        <ul class="list-group">
            @foreach($completed as $task)
                <li class="list-group-item">
                    <h5 class="task-title">{{ $task->title }}</h5>
                    <h6 class="text-info">completed {{ humans_time($task->finished_at) }}</h6>
                </li>
            @endforeach
        </ul>
    </div>
@endunless