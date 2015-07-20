<div class="panel panel-default">
    <ul class="list-group">
        <li class="list-group-item">
            {!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['member::update', $user]]) !!}
                <div class="form-group">
                    {!! Form::label('location', 'Current location', ['class' => 'control-label']) !!}
                    {!! Form::textarea('location', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    {!! error_text($errors, 'location') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bio', 'Biography', ['class' => 'control-label']) !!}
                    {!! Form::textarea('bio', null, ['class' => 'form-control', 'rows' => 5]) !!}
                    {!! error_text($errors, 'bio') !!}
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
                            {!! error_text($errors, 'website') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone number', ['class' => 'control-label']) !!}
                            {!! Form::text('phone', null, ['class' => 'form-control input-lg']) !!}
                            {!! error_text($errors, 'phone') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('github_username', 'GitHub', ['class' => 'control-label']) !!}
                            {!! Form::text('github_username', null, ['class' => 'form-control input-lg']) !!}
                            {!! error_text($errors, 'github_username') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('google_username', 'Google+', ['class' => 'control-label']) !!}
                            {!! Form::text('google_username', null, ['class' => 'form-control input-lg']) !!}
                            {!! error_text($errors, 'google_username') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('facebook_username', 'Facebook', ['class' => 'control-label']) !!}
                            {!! Form::text('facebook_username', null, ['class' => 'form-control input-lg']) !!}
                            {!! error_text($errors, 'facebook_username') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::submit('Update Profile', ['class' => 'btn btn-lg btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </li>
    </ul>
</div>