@extends('layouts.admin')

@section('title', 'Member Notification')

@section('notifiable-objects')
    <div class="form-group">
        <div class="form-group">
            {!! Form::label('user_list', 'Choose Members', ['class' => 'control-label']) !!}
            {!! Form::select('user_list[]', $users, null, ['id' => 'user_list', 'class' => 'form-control', 'multiple']) !!}
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-wrapper">
                <h2 class="form-header">Create Member Notification</h2>
                @include('layouts.partials.errors')
                {!! Form::model($notification = new \Keep\Notification, ['route' => ['store.member.notification']]) !!}
                    @include('admin.notifications.partials.form', ['notificationButton' => 'Create Notification'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop