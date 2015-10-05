<div class="page-header">
    <h5>Sync up Failed Tasks</h5>
</div>
{!! Form::open(['route' => ['user.tasks.sync', $user], 'id' => 'sync-failed-tasks-form']) !!}
    {!! Form::submit('SYNC FAILED TASKS', ['class' => 'btn btn-info']) !!}
{!! Form::close() !!}