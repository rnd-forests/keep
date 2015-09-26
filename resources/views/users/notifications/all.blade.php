@extends('layouts.default')
@section('title', ucfirst(Request::get('type')) . ' Notifications')
@section('content')
    @inject('counter', 'Keep\Services\UserNotification')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Choose your category</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('member::notifications',
                            ['users' => $authUser, 'type' => 'personal']) }}">
                            Personal notifications
                        </a>
                        <span class="badge">
                            {{ $counter->countPersonalNotifications() }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('member::notifications',
                            ['users' => $authUser, 'type' => 'group']) }}">
                            Group notifications
                        </a>
                        <span class="badge">
                            {{ $counter->countGroupNotifications() }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 notification-container">
            <div class="list-group">
                @foreach($notifications as $notification)
                    <div class="list-group-item notification"
                         data-toggle="collapse"
                         data-target="#{{ $notification->id }}-noti-collapse">
                        <h5 class="text-{{ $notification->type }}">
                            {{ $notification->subject }}
                            <span class="notification-time">
                                {{ humans_time($notification->created_at) }}
                            </span>
                        </h5>
                        <div class="collapse" id="{{ $notification->id }}-noti-collapse">
                            <div class="collapse-content">
                                {{ $notification->body }}
                                @if(Request::get('type') == 'group')
                                    <ul class="breadcrumb notification-groups">
                                        @foreach($notification->groups as $group)
                                            <li>
                                                <a href="{{ route('member::groups.show', [$authUser, $group]) }}">
                                                    {{ $group->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {!! render_pagination($notifications, ['type' => Request::get('type')]) !!}
        </div>
    </div>
@stop