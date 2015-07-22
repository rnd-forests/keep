<div class="row stats">
    <div class="col-md-3">
        <a href="{{ route('member::tasks.all', $user) }}">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="large">{{ $counter->totalTasks() }}</div>
                    <div class="small">in total</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::tasks.completed', $user) }}">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="large">{{ $counter->countCompletedTasks() }}</div>
                    <div class="small">completed</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::tasks.failed', $user) }}">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="large">{{ $counter->countFailedTasks() }}</div>
                    <div class="small">failed</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::tasks.due', $user) }}">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="large">{{ $counter->countDueTasks() }}</div>
                    <div class="small">processing</div>
                </div>
            </div>
        </a>
    </div>
</div>