@extends('layouts.admin')
@section('title', 'Notifications Collection')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($notifications as $notification)
                <div class="alert alert-{{ $notification->type }} notification">
                    <strong>{{ $notification->subject }}</strong>
                    <h6>{{ humans_time($notification->created_at) }}</h6>
                    <p>{{ $notification->body }}</p>
                    <div class="text-center" style="margin-top: 10px">@include('admin.notifications.partials._delete_form')</div>
                </div>
            @endforeach
            {!! render_pagination($notifications) !!}
        </div>
    </div>
@stop