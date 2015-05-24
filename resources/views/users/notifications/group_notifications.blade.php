@extends('layouts.app')

@section('meta-description', 'All group notifications associated with ' . Auth::user()->name)

@section('title', 'Group Notifications')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($notifications as $notification)
                <div class="alert alert-{{ $notification->type }} notification">
                    <strong>{{ $notification->subject }}</strong>
                    <h6 class="notification-time">
                        {{ $notification->present()->formatTimeForHumans($notification->created_at) }}
                    </h6>
                    <p>{{ $notification->body }}</p>
                    <h6>Notified Groups</h6>
                    <h6>
                        <div class="breadcrumb notification-groups">
                            @foreach($notification->groups as $group)
                                <li><a href="{{ route('users.groups.show', [Auth::user(), $group]) }}">{{ $group->name }}</a></li>
                            @endforeach
                        </div>
                    </h6>
                </div>
            @endforeach
        </div>
    </div>
@stop