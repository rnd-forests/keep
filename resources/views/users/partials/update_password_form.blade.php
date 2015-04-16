@include('layouts.partials.errors')

@if (session('update_password_error'))
    <div class="alert alert-warning">{{ session('update_password_error') }}</div>
@endif

@if (session('update_password_success'))
    <div class="alert alert-success">{{ session('update_password_success') }}</div>
@endif

{!! Form::open(['route' => 'change.account.password']) !!}
    <div class="form-group">
        {!! Form::label('old_password', 'Old Password', ['class' => 'control-label']) !!}
        {!! Form::password('old_password', ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('new_password', 'New Password', ['class' => 'control-label']) !!}
        {!! Form::password('new_password', ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('new_password_confirmation', 'New Password Confirmation', ['class' => 'control-label']) !!}
        {!! Form::password('new_password_confirmation', ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update password', ['class' => 'btn btn-danger']) !!}
    </div>
{!! Form::close() !!}
