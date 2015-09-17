<i class="fa fa-arrow-circle-down task-dashboard-control task-content-toggle"
   data-toggle="collapse"
   data-target="#{{ $task->id }}-task-collapse"></i>
<a href="{{ route('member::tasks.show', [$user, $task]) }}">
    <i class="fa fa-arrow-circle-right task-dashboard-control"
       data-toggle="tooltip"
       data-placement="top"
       title="Full details"></i>
</a>
<div class="collapse" id="{{ $task->id }}-task-collapse">
    <div class="collapse-content">
        {{ $task->content }}
    </div>
</div>