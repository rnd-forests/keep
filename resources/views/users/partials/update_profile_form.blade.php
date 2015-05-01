@include('layouts.partials.errors')
{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('address', 'Current Address', ['class' => 'control-label']) !!}
        {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('company', 'Company', ['class' => 'control-label']) !!}
        {!! Form::text('company', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('website', 'Website', ['class' => 'control-label']) !!}
        {!! Form::text('website', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('phone', 'Phone Number', ['class' => 'control-label']) !!}
        {!! Form::text('phone', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('about', 'About Yourself', ['class' => 'control-label']) !!}
        {!! Form::textarea('about', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update Profile', ['class' => 'btn btn-lg btn-primary']) !!}
    </div>
{!! Form::close() !!}
