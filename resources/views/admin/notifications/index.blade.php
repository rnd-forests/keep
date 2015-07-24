@extends('layouts.admin')
@section('title', 'Notifications Collection')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 notification-container">
            @foreach($notifications->chunk(10) as $notificationStack)
                @foreach($notificationStack as $notification)
                    <div class="alert alert-{{ $notification->type }} notification">
                        <strong>{{ $notification->subject }}</strong>
                        <h6 class="notification-time">
                            {{ humans_time($notification->created_at) }}
                        </h6>
                        <div class="notification-body">
                            <p>{{ $notification->body }}</p>
                        </div>
                        <div class="text-center" style="margin-top: 10px">@include('admin.notifications.partials._delete_form')</div>
                    </div>
                @endforeach
            @endforeach
            {!! render_pagination($notifications) !!}
        </div>
    </div>
@stop