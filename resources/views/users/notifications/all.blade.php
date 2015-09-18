@extends('layouts.app')
@section('title', 'Group Notifications')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 notification-container">
            @include('users.notifications.partials._controls')
            <div class="list-group">
                @foreach($notifications as $notification)
                    <div class="list-group-item notification">
                        <strong class="text-{{ $notification->type }}">{{ $notification->subject }}</strong>
                        <h6 class="notification-time">
                            {{ humans_time($notification->created_at) }}
                        </h6>
                        <i class="fa fa-angle-down" data-toggle="collapse" data-target="#{{ $notification->id }}-noti-collapse"></i>
                        <div class="collapse" id="{{ $notification->id }}-noti-collapse">
                            <div class="collapse-content">
                                {{ $notification->body }}
                                @if(Request::get('type') == 'group')
                                    <ul class="breadcrumb notification-groups">
                                        @foreach($notification->groups as $group)
                                            <li><a href="{{ route('member::groups.show', [$authUser, $group]) }}">{{ $group->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(Request::get('type') == 'group')
                {!! render_pagination($notifications, ['type' => 'group']) !!}
            @else
                {!! render_pagination($notifications, ['type' => 'personal']) !!}
            @endif
        </div>
    </div>
@stop