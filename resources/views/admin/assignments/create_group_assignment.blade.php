@extends('layouts.admin')
@section('title', 'Schedule Group Assignment')
@section('assignable-objects')
    <div class="form-group">
        <div class="form-group">
            {!! Form::label('group_list', 'Choose Groups', ['class' => 'control-label']) !!}
            {!! Form::select('group_list[]', $groups, null, ['id' => 'group_list', 'class' => 'form-control', 'multiple']) !!}
            {!! error_text($errors, 'group_list') !!}
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Create Group Assignment</strong></div>
                <div class="panel-body">
                    {!! Form::model([$task = new \Keep\Entities\Task, $assignment = new \Keep\Entities\Assignment],
                        ['route' => ['admin::assignments.group.store']]) !!}
                        @include('admin.assignments.partials._main_form', ['assignmentButton' => 'Create Assignment'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
