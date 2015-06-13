{!! Form::open(['route' => ['member::tasks.destroy', $user, $task], 'method' => 'DELETE']) !!}
    <button type="submit" class="btn btn-circle btn-danger"
        data-toggle="tooltip" data-placement="bottom" title="Delete task">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}