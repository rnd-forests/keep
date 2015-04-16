{!! Form::model($task, ['method' => 'PATCH', 'route' => ['users.tasks.complete', $user->slug, $task->slug]]) !!}
    <div class="checkbox">
        <label>
            {!! Form::checkbox('completed', 1, null, ['id' => 'completing-task-checkbox']) !!}
            Check is box to mark your task as completed
        </label>
    </div>
    {!! Form::submit('Complete', ['class' => 'btn btn-sm btn-primary']) !!}
{!! Form::close() !!}