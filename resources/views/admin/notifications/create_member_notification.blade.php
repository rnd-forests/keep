@extends('layouts.admin')
@section('title', 'Create Member Notification')
@section('notifiable-objects')
    <div class="form-group">
        <div class="form-group">
            {!! Form::label('user_list', 'Choose Members', ['class' => 'control-label']) !!}
            {!! Form::select('user_list[]', $users, null, ['id' => 'user_list', 'class' => 'form-control', 'multiple']) !!}
            {!! error_text($errors, 'user_list') !!}
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                {!! Form::model($notification = new \Keep\Entities\Notification, ['route' => ['admin::notifications.member.store']]) !!}
                    @include('admin.notifications.partials._main_form', ['notificationButton' => 'Create member notification'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
