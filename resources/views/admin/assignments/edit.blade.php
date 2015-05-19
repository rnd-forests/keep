@extends('layouts.admin')

@section('title', 'Edit - ' . $assignment->assignment_name)

@section('assignable-objects')
    @if($assignment->groups->isEmpty())
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('user_list', 'Choose Members', ['class' => 'control-label']) !!}
                {!! Form::select('user_list[]', $users, $assignment->users->lists('id'), ['id' => 'user_list', 'class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
    @else
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('group_list', 'Choose Groups', ['class' => 'control-label']) !!}
                {!! Form::select('group_list[]', $groups, $assignment->groups->lists('id'), ['id' => 'group_list', 'class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
    @endif
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Edit - {{ $assignment->assignment_name }}</strong></div>
                <div class="panel-body">
                    @include('layouts.partials.errors')
                    {!! Form::model($task, ['method' => 'PATCH', 'route' => ['admin.assignments.update', $assignment]]) !!}
                        @include('admin.assignments.partials.form', ['assignmentButton' => 'Update Assignment'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop