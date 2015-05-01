{!! Form::open(['route' => ['users.destroy', $user], 'method' => 'DELETE']) !!}
    {!! Form::submit('Cancel account', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}