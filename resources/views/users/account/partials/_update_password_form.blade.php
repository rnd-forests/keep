@if (session('invalid.password'))
    <div class="alert alert-warning">{{ session('invalid.password') }}</div>
@elseif (session('valid.password'))
    <div class="alert alert-success">{{ session('valid.password') }}</div>
@endif

{!! Form::open(['method' => 'PATCH', 'route' => ['member::change.password', $user]]) !!}
    <div class="form-group">
        {!! Form::label('old_pass', 'Current password', ['class' => 'control-label']) !!}
        {!! Form::password('old_pass', ['class' => 'form-control input-lg']) !!}
        {!! error_text($errors, 'old_pass') !!}
    </div>
    <div class="form-group">
        {!! Form::label('new_pass', 'New password', ['class' => 'control-label']) !!}
        {!! Form::password('new_pass', ['class' => 'form-control input-lg']) !!}
        {!! error_text($errors, 'new_pass') !!}
    </div>
    <div class="form-group">
        {!! Form::label('new_pass_confirmation', 'Confirm new password', ['class' => 'control-label']) !!}
        {!! Form::password('new_pass_confirmation', ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Change your password</button>
    </div>
{!! Form::close() !!}
