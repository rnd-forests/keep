@extends('layouts.app')
@section('title', 'Group - ' . $group->name)
@section('content')
    <div class="row">
        @foreach($members->chunk(4) as $userStack)
            <div class="row">
                @foreach($userStack as $user)
                    <div class="col-md-3">
                        <div class="well">
                            <div class="media">
                                <div class="media-left">
                                    @include('users.partials._avatar')
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">{{ $user->name  }}</h5>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@stop