<div class="panel panel-danger">
    <div class="panel-heading">Urgent</div>
    <div class="list-group">
        @foreach($urgent as $task)
            <a class="list-group-item" href="{{ route('member::tasks.show', [$user, $task]) }}">
                <h5>{{ $task->title }}</h5>
            </a>
        @endforeach
    </div>
</div>