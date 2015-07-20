@if (session('update_password_error'))
    <div class="alert alert-warning">{{ session('update_password_error') }}</div>
@endif

@if (session('update_password_success'))
    <div class="alert alert-success">{{ session('update_password_success') }}</div>
@endif

{!! Form::open(['method' => 'PATCH', 'route' => ['auth::change.password', $user]]) !!}
    <div class="form-group">
        {!! Form::label('old_password', 'Current password', ['class' => 'control-label']) !!}
        {!! Form::password('old_password', ['class' => 'form-control input-lg']) !!}
        {!! error_text($errors, 'old_password') !!}
    </div>
    <div class="form-group">
        {!! Form::label('new_password', 'New password', ['class' => 'control-label']) !!}
        {!! Form::password('new_password', ['class' => 'form-control input-lg']) !!}
        {!! error_text($errors, 'new_password') !!}
    </div>
    <div class="form-group">
        {!! Form::label('new_password_confirmation', 'Confirm new password', ['class' => 'control-label']) !!}
        {!! Form::password('new_password_confirmation', ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info btn-lg">Confirm</button>
    </div>
{!! Form::close() !!}
