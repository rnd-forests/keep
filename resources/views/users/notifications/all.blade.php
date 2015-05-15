@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    @foreach($notifications as $notification)
        <div class="alert alert-info">
            <strong>{{ $notification->subject }}</strong>
            <p>{{ $notification->body }}</p>
        </div>
    @endforeach
@stop