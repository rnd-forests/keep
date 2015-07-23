@extends('layouts.app')
@section('title', 'Group Notifications')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 notification-container">
            @include('users.notifications.partials._controls')
            @foreach($notifications as $notification)
                <div class="alert alert-{{ $notification->type }} notification">
                    <strong>{{ $notification->subject }}</strong>
                    <h6 class="notification-time">
                        {{ humans_time($notification->created_at) }}
                    </h6>
                    <div class="notification-body">
                        <p>{{ $notification->body }}</p>
                    </div>
                    <h6>
                        <div class="breadcrumb notification-groups">
                            @foreach($notification->groups as $group)
                                <li><a href="{{ route('member::groups.show', [$authUser, $group]) }}">{{ $group->name }}</a></li>
                            @endforeach
                        </div>
                    </h6>
                </div>
            @endforeach
            {!! render_pagination($notifications) !!}
        </div>
    </div>
@stop