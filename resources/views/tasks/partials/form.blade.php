<div class="form-group">
    {!! Form::label('title', 'Task Header', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control input-lg']) !!}
</div>
<div class="form-group">
    {!! Form::label('content', 'Task Details', ['class' => 'control-label']) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 6]) !!}
</div>
<div class="form-group">
    {!! Form::label('starting_date', 'Starting Date', ['class' => 'control-label']) !!}
    <div class="input-group date task_form_datetimepicker">
        {!! Form::text('starting_date', $task->starting_date, ['class' => 'form-control input-lg']) !!}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('finishing_date', 'Finishing Date', ['class' => 'control-label']) !!}
    <div class="input-group date task_form_datetimepicker">
        {!! Form::text('finishing_date', $task->finishing_date, ['class' => 'form-control input-lg']) !!}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('location', 'Location', ['class' => 'control-label']) !!}
    {!! Form::text('location', null, ['class' => 'form-control input-lg']) !!}
</div>
<div class="form-group">
    {!! Form::label('note', 'Quick Note', ['class' => 'control-label']) !!}
    {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>
<div class="form-group">
    <div class="form-group">
        {!! Form::label('tag_list', 'Tags', ['class' => 'control-label']) !!}
        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::submit($taskFormSubmitButton, ['class' => 'btn btn-lg btn-primary']) !!}
</div>
