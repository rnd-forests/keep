@extends('layouts.app')

@section('meta-description', 'All notifications associated with ' . Auth::user()->name)

@section('title', 'Notifications')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="text-center" style="margin-bottom: 20px">
                <a href="{{ route('users.groups.notifications', Auth::user()) }}">
                    <button class="btn btn-primary">Show group notifications</button>
                </a>
            </div>
            @foreach($notifications as $notification)
                <div class="alert alert-{{ $notification->type }} notification">
                    <strong>{{ $notification->subject }}</strong>
                    <h6 class="notification-time">
                        {{ $notification->present()->formatTimeForHumans($notification->created_at) }}
                    </h6>
                    @unless($notification->body == '')
                        <p>{{ $notification->body }}</p>
                    @endunless
                    @if($notification->hasValidObject() && $notification->object_type == 'Keep\Entities\Task')
                        <div class="well">
                            <strong>{{ $notification->getObject()->title }}</strong>
                            <h6>{{ $notification->getObject()->present()->getRemainingDays($notification->getObject()->finishing_date) }}</h6>
                            <a href="{{ route('users.tasks.show', [
                                $notification->getObject()->owner,
                                $notification->getObject()]) }}"><i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    @endif
                </div>
            @endforeach
            <div class="text-center">{!! $notifications->render() !!}</div>
        </div>
    </div>
@stop