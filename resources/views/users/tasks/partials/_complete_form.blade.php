{!! Form::model($task,
    ['method' => 'PATCH',
    'route' => ['user.tasks.complete', $user, $task],
    'id' => 'task-complete-form']) !!}
    {!! Form::checkbox('completed', 1, null,
        ['id' => 'completed',
        'class' => 'cmn-toggle cmn-toggle-round-flat']) !!}
    <label for="completed"></label>
    <p class="task-complete-message"></p>
    <i class="fa fa-2x fa-cog fa-spin loading hidden"></i>
{!! Form::close() !!}
