@include('layouts.partials.errors')
{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->slug]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('birthday', 'Birthday', ['class' => 'control-label']) !!}
        <div class="input-group" id="user_update_form_datetimepicker">
            {!! Form::text('birthday', $user->birthday->format('m/d/Y'), ['class' => 'form-control input-lg']) !!}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
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
