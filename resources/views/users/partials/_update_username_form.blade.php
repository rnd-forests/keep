@if (session('update_username_error'))
    <div class="alert alert-warning">{{ session('update_username_error') }}</div>
@endif

@if (session('update_username_success'))
    <div class="alert alert-success">{{ session('update_username_success') }}</div>
@endif

{!! Form::open(['method' => 'PATCH', 'route' => ['auth::change.username', $user]]) !!}
    <div class="form-group">
        <label for="" class="control-label"></label>
        {!! Form::label('old_username', 'Current name', ['class' => 'control-label']) !!}
        {!! Form::text('old_username', null, ['class' => 'form-control input-lg']) !!}
        {!! error_text($errors, 'old_username') !!}
    </div>
    <div class="form-group">
        {!! Form::label('new_username', 'New name', ['class' => 'control-label']) !!}
        {!! Form::text('new_username', null, ['class' => 'form-control input-lg']) !!}
        {!! error_text($errors, 'new_username') !!}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info btn-lg">Confirm</button>
    </div>
{!! Form::close() !!}
