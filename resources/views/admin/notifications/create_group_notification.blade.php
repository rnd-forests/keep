@extends('layouts.admin')
@section('title', 'Create Group Notification')
@section('notifiable-objects')
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
            <div class="form-wrapper">
                {!! Form::model($notification = new \Keep\Entities\Notification, ['route' => ['admin::notifications.group.store']]) !!}
                    @include('admin.notifications.partials._main_form', ['notificationButton' => 'Create group notification'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
