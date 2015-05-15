@extends('layouts.admin')

@section('title', 'Notifications')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($notifications as $notification)
                <div class="alert alert-{{ $notification->type }} notification">
                    <h3>{{ $notification->subject }}</h3>
                    <h6>{{ $notification->present()->formatTimeForHumans($notification->created_at) }}</h6>
                    <p>{{ $notification->body }}</p>
                </div>
            @endforeach
            <div class="text-center">{!! $notifications->render() !!}</div>
        </div>
    </div>
@stop