<div class="row stats">
    <div class="col-md-12">
        <div class="page-header">
            <h5>Tasks according to priorities <small>not including completed tasks</small></h5>
        </div>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::priorities.task', [$user, 'urgent']) }}">
            <div class="stat-container">
                <div class="large">{{ $counter->countUrgentPriorityTasks() }}</div>
                <div class="small">urgent</div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::priorities.task', [$user, 'high']) }}">
            <div class="stat-container">
                <div class="large">{{ $counter->countHighPriorityTasks() }}</div>
                <div class="small">high</div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::priorities.task', [$user, 'normal']) }}">
            <div class="stat-container">
                <div class="large">{{ $counter->countNormalPriorityTasks() }}</div>
                <div class="small">normal</div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('member::priorities.task', [$user, 'low']) }}">
            <div class="stat-container">
                <div class="large">{{ $counter->countLowPriorityTasks() }}</div>
                <div class="small">low</div>
            </div>
        </a>
    </div>
</div>