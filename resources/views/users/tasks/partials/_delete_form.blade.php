{!! Form::open(['route' => ['user.tasks.destroy', $user, $task], 'method' => 'DELETE', 'id' => 'task-delete-form']) !!}
    <li><a><i class="fa fa-trash-o"></i>&nbsp; Trash</a></li>
{!! Form::close() !!}