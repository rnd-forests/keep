@if (session('update_username_error'))
    <div class="alert alert-warning">{{ session('update_username_error') }}</div>
@endif

@if (session('update_username_success'))
    <div class="alert alert-success">{{ session('update_username_success') }}</div>
@endif

{!! Form::open(['method' => 'PATCH', 'route' => ['change.account.username', $user]]) !!}
    <div class="form-group">
        {!! Form::label('old_username', 'Old Username', ['class' => 'control-label']) !!}
        {!! Form::text('old_username', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('new_username', 'New Username', ['class' => 'control-label']) !!}
        {!! Form::text('new_username', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update username', ['class' => 'btn btn-danger']) !!}
    </div>
{!! Form::close() !!}
