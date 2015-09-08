{!! Form::open(['route' => ['member::tasks.destroy', $user, $task], 'method' => 'DELETE', 'id' => 'task-delete-form']) !!}
    <li><a href="#"><i class="fa fa-trash-o"></i>&nbsp; Trash</a></li>
{!! Form::close() !!}