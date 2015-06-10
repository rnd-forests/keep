<div class="form-group">
    {!! Form::label('title', 'Task Header', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control input-lg']) !!}
</div>
<div class="form-group summernote-container">
    {!! Form::label('content', 'Task Details', ['class' => 'control-label']) !!}
    {!! Form::textarea('content', null, ['id' => 'summernote']) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('starting_date', 'Starting Date', ['class' => 'control-label']) !!}
            <div class="input-group date task-time-form">
                {!! Form::text('starting_date', $task->starting_date, ['class' => 'form-control input-lg']) !!}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('finishing_date', 'Finishing Date', ['class' => 'control-label']) !!}
            <div class="input-group date task-time-form">
                {!! Form::text('finishing_date', $task->finishing_date, ['class' => 'form-control input-lg']) !!}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('location', 'Location', ['class' => 'control-label']) !!}
            {!! Form::text('location', null, ['class' => 'form-control input-lg']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('tag_list', 'Tags', ['class' => 'control-label']) !!}
                {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('priority_level', 'Priority Level', ['class' => 'control-label']) !!}
    {!! Form::select('priority_level', $priorities, null, ['class' => 'form-control input-lg']) !!}
</div>
<div class="form-group">
    {!! Form::submit($taskFormSubmitButton, ['class' => 'btn btn-lg btn-primary']) !!}
</div>
