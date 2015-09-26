<div class="form-group">
    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! error_text($errors, 'title') !!}
</div>
<div class="form-group">
    {!! Form::label('content', 'Details', ['class' => 'control-label']) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    {!! error_text($errors, 'content') !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('starting_date', 'Starting Date', ['class' => 'control-label']) !!}
            <div class="input-group date task-time-form">
                {!! Form::text('starting_date', null, ['class' => 'form-control']) !!}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
            {!! error_text($errors, 'starting_date') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('finishing_date', 'Finishing Date', ['class' => 'control-label']) !!}
            <div class="input-group date task-time-form">
                {!! Form::text('finishing_date', null, ['class' => 'form-control']) !!}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
            {!! error_text($errors, 'finishing_date') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('location', 'Location', ['class' => 'control-label']) !!}
            {!! Form::text('location', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('tag_list', 'Tags', ['class' => 'control-label']) !!}
                {!! Form::select('tag_list[]', $tags, null, [
                    'id' => 'tag_list',
                    'class' => 'form-control multiple-selection',
                    'data-description' => 'Choose tags for this task...',
                    'multiple']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('priority_level', 'Priority Level', ['class' => 'control-label']) !!}
            {!! Form::select('priority_level', $priorities, null, ['class' => 'form-control']) !!}
            {!! error_text($errors, 'priority_level') !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::submit($taskFormSubmitButton, ['class' => 'btn btn-primary']) !!}
</div>
