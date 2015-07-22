<div class="row stats">
    <div class="col-md-3">
        <a href="{{ route('member::tasks.all', $user) }}">
            <div class="stat-container">
                <div class="large">{{ $counter->totalTasks() }}</div>
                <div class="small">in total</div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::tasks.completed', $user) }}">
            <div class="stat-container">
                <div class="large">{{ $counter->countCompletedTasks() }}</div>
                <div class="small">completed</div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::tasks.failed', $user) }}">
            <div class="stat-container">
                <div class="large">{{ $counter->countFailedTasks() }}</div>
                <div class="small">failed</div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::tasks.due', $user) }}">
            <div class="stat-container">
                <div class="large">{{ $counter->countDueTasks() }}</div>
                <div class="small">processing</div>
            </div>
        </a>
    </div>
</div>