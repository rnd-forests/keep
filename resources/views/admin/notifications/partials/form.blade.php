<div class="form-group">
    {!! Form::label('subject', 'Notification Subject', ['class' => 'control-label']) !!}
    {!! Form::text('subject', $notification->subject, ['class' => 'form-control input-lg']) !!}
</div>
<div class="form-group summernote-container">
    {!! Form::label('body', 'Notification Details', ['class' => 'control-label']) !!}
    {!! Form::textarea('body', null, ['id' => 'summernote']) !!}
</div>
@yield('notifiable-objects')
<div class="form-group">
    {!! Form::label('type', 'Notification Type', ['class' => 'control-label']) !!}
    {!! Form::select('type', $types, is_null($notification->type) ? null : $notification->type, ['class' => 'form-control input-lg']) !!}
</div>
<div class="form-group">
    {!! Form::submit($notificationButton, ['class' => 'btn btn-lg btn-primary']) !!}
</div>
