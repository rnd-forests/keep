{!! Form::open(['route' => ['users.destroy', $user->slug], 'method' => 'DELETE']) !!}
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    {!! Form::submit('Delete account',
        ['class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#cancel-account-modal']) !!}
{!! Form::close() !!}