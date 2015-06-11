{!! Form::open(['route' => ['member::destroy', $user], 'method' => 'DELETE']) !!}
    {!! Form::submit('Cancel account', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}