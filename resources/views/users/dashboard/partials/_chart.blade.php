@unless(zero($counter->totalTasks()))
    <div class="panel chart-panel">
        <div class="panel-body">
            <canvas id="user-dashboard-stats" height="200px"></canvas>
        </div>
    </div>
@endunless