@extends('layouts.app')
@section('title', 'Personal Notifications')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 notification-container">
            @include('users.notifications.partials._controls')
            <div class="list-group">
                @foreach($notifications as $notification)
                    <div class="list-group-item notification">
                        <strong class="text-{{ $notification->type }}">{{ $notification->subject }}</strong>
                        <h6 class="notification-time">{{ humans_time($notification->created_at) }}</h6>
                        <i class="fa fa-angle-down" data-toggle="collapse" data-target="#{{ $notification->id }}-noti-collapse"></i>
                        <div class="collapse" id="{{ $notification->id }}-noti-collapse">
                            <div class="collapse-content">
                                {{ $notification->body }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {!! render_pagination($notifications, ['type' => 'personal']) !!}
        </div>
    </div>
@stop