@extends('layouts.app')

@section('meta-description', 'All notifications associated with ' . Auth::user()->name)

@section('title', 'Notifications')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($notifications as $notification)
                <div class="alert alert-{{ $notification->type }} notification">
                    <strong>{{ $notification->subject }}</strong>
                    <h6 class="notification-time">
                        {{ $notification->present()->formatTimeForHumans($notification->created_at) }}
                    </h6>
                    @unless($notification->body == '')
                        <p>{{ $notification->body }}</p>
                    @endunless
                    @if($notification->hasValidObject() && $notification->object_type == 'Keep\Task')
                        <div class="well">
                            <strong class="text-navy">{{ $notification->getObject()->title }}</strong>
                            <h6>{{ $notification->getObject()->present()->getRemainingDays($notification->getObject()->finishing_date) }}</h6>
                            <a href="{{ route('users.tasks.show', [$notification->getObject()->owner, $notification->getObject()]) }}">Read More</a>
                        </div>
                    @endif
                </div>
            @endforeach
            <div class="text-center">{!! $notifications->render() !!}</div>
        </div>
    </div>
@stop