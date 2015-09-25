@unless(blank($deadline))
    <div class="panel panel-primary">
        <div class="panel-heading">Deadline</div>
        <ul class="list-group">
            @foreach($deadline as $task)
                <li class="list-group-item">
                    <h5 class="task-title">{{ $task->title }}</h5>
                    <h6 class="text-warning">{{ remaining_days($task->finishing_date) }}</h6>
                    @include('users.dashboard.partials._controls')
                </li>
            @endforeach
        </ul>
    </div>
@endunless