@extends('layouts.admin')
@section('title', 'Notifications Collection')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 notification-container">
            <div class="list-group">
                @foreach($notifications->chunk(10) as $notificationStack)
                    @foreach($notificationStack as $notification)
                        <div class="list-group-item notification"
                             data-toggle="collapse"
                             data-target="#{{ $notification->id }}-noti-collapse">
                            <strong class="text-{{ $notification->type }}">
                                {{ $notification->subject }}
                            </strong>
                            <span class="notification-time">
                                {{ humans_time($notification->created_at) }}
                            </span>
                            <div class="collapse" id="{{ $notification->id }}-noti-collapse">
                                <div class="collapse-content">
                                    {{ $notification->body }}
                                    <div class="text-center" style="margin-top: 10px">
                                        @include('admin.notifications.partials._delete_form')
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            {!! render_pagination($notifications) !!}
        </div>
    </div>
@stop