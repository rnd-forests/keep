@extends('layouts.admin')

@section('title', 'Notifications')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($notifications as $notification)
                <div class="alert alert-{{ $notification->type }} notification">
                    <strong>{{ $notification->subject }}</strong>
                    <h6>
                        <span class="label label-{{ $notification->type }}">
                            {{ $notification->present()->formatTimeForHumans($notification->created_at) }}
                        </span>
                    </h6>
                    <p>{{ $notification->body }}</p>
                    <div class="text-center" style="margin-top: 10px">@include('admin.notifications.partials.delete_form')</div>
                </div>
            @endforeach
            <div class="text-center">{!! $notifications->render() !!}</div>
        </div>
    </div>
@stop