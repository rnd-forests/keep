@extends('layouts.app')
@section('title', 'Notifications')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="text-center" style="margin-bottom: 20px">
                <a href="{{ route('member::notifications.group', $authUser) }}">
                    <button class="btn btn-primary">Show group notifications</button>
                </a>
            </div>
            @foreach($notifications as $notification)
                <div class="alert alert-{{ $notification->type }} notification">
                    <strong>{{ $notification->subject }}</strong>
                    <h6 class="notification-time">
                        {{ humans_time($notification->created_at) }}
                    </h6>
                    @unless($notification->body == '')
                        <p>{{ $notification->body }}</p>
                    @endunless
                    @if($notification->hasValidObject() && $notification->object_type == 'Keep\Entities\Task')
                        <div class="well">
                            <strong>{{ $notification->getObject()->title }}</strong>
                            <h6>{{ remaining_days($notification->getObject()->finishing_date) }}</h6>
                            <a href="{{ route('member::tasks.show', [
                                $notification->getObject()->owner,
                                $notification->getObject()]) }}"><i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    @endif
                </div>
            @endforeach
            {!! render_pagination($notifications) !!}
        </div>
    </div>
@stop