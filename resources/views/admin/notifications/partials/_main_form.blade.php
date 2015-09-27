<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('subject', 'Notification Subject', ['class' => 'control-label']) !!}
                {!! Form::text('subject', $notification->subject, ['class' => 'form-control']) !!}
                {!! error_text($errors, 'subject') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('type', 'Notification Type', ['class' => 'control-label']) !!}
                {!! Form::select('type', $types, is_null($notification->type) ? null : $notification->type,
                    ['class' => 'form-control']) !!}
                {!! error_text($errors, 'type') !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('body', 'Notification Details', ['class' => 'control-label']) !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    {!! error_text($errors, 'body') !!}
</div>
@yield('notifiable-objects')
<div class="form-group form-submit">
    {!! Form::submit($notificationButton, ['class' => 'btn btn-primary']) !!}
</div>
