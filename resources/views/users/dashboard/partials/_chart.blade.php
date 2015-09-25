@unless(zero($counter->totalTasks()))
    <div class="panel chart-panel">
        <div class="panel-body">
            <canvas id="user-dashboard-stats" height="200px"></canvas>
        </div>
    </div>
    <div class="page-header">
        <h5>Percentage of Completion</h5>
    </div>
    <div class="progress">
        <div class="progress-bar progress-bar-success progress-bar-striped active"
             aria-valuenow="{{ $counter->completedPercentage() }}"
             aria-valuemin="0"
             aria-valuemax="100"
             style="width: {{ $counter->completedPercentage() }}%">
            <span>{{ $counter->completedPercentage() }}%</span>
        </div>
    </div>
    <div class="page-header">
        <h5>Percentage of Currently Processing</h5>
    </div>
    <div class="progress">
        <div class="progress-bar progress-bar-danger progress-bar-striped active"
             aria-valuenow="{{ $counter->processingPercentage() }}"
             aria-valuemin="0"
             aria-valuemax="100"
             style="width: {{ $counter->processingPercentage() }}%">
            <span>{{ $counter->processingPercentage() }}%</span>
        </div>
    </div>
@endunless