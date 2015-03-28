@extends('layouts.admin')

@section('title')
    Admin-Dashboard
@stop

@section('content')
    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/members/text:{{ $userList->count() }}" class="img-responsive">
            <h4>Members</h4>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/tasks/text:{{ $taskList->count() }}" class="img-responsive">
            <h4>Tasks</h4>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/notifications/text:1500" class="img-responsive">
            <h4>Notifications</h4>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/visitors/text:9876" class="img-responsive">
            <h4>Unique Visitors</h4>
        </div>
    </div>
@stop

