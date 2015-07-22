@unless(zero($counter->totalTasks()))
    <div class="stats">
        <div class="stat-container">
            <h4 class="stat-title">Task Statistics Chart</h4>
            <canvas id="user-dashboard-stats" height="180px"></canvas>
        </div>
    </div>
@endunless