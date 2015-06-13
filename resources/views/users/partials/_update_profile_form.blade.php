@include('layouts.partials._form_errors')
{!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['member::update', $user]]) !!}
    <div class="form-group">
        {!! Form::label('location', 'Current Location', ['class' => 'control-label']) !!}
        {!! Form::textarea('location', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('bio', 'Biography', ['class' => 'control-label']) !!}
        {!! Form::textarea('bio', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('company', 'Company', ['class' => 'control-label']) !!}
        {!! Form::text('company', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('website', 'Website', ['class' => 'control-label']) !!}
                {!! Form::text('website', null, ['class' => 'form-control input-lg']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('phone', 'Phone Number', ['class' => 'control-label']) !!}
                {!! Form::text('phone', null, ['class' => 'form-control input-lg']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('twitter_username', 'Twitter Username', ['class' => 'control-label']) !!}
                {!! Form::text('twitter_username', null, ['class' => 'form-control input-lg']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('github_username', 'GitHub Username', ['class' => 'control-label']) !!}
                {!! Form::text('github_username', null, ['class' => 'form-control input-lg']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('google_username', 'Google Plus Username', ['class' => 'control-label']) !!}
                {!! Form::text('google_username', null, ['class' => 'form-control input-lg']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('facebook_username', 'Facebook Username', ['class' => 'control-label']) !!}
                {!! Form::text('facebook_username', null, ['class' => 'form-control input-lg']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::submit('Update Profile', ['class' => 'btn btn-lg btn-primary']) !!}
    </div>
{!! Form::close() !!}
