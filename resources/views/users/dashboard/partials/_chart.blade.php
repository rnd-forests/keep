@unless(zero($counter->totalTasks()))
    <div class="i-panel">
        <div class="i-panel-title">
            <h5>Task Statistics Chart</h5>
        </div>
        <div class="i-panel-content">
            <canvas id="user-dashboard-stats" height="200px"></canvas>
        </div>
    </div>
@endunless