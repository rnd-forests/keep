{!! Form::open(['route' => ['users.destroy', $user->slug], 'method' => 'DELETE']) !!}
    {!! Form::submit('Cancel account', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}