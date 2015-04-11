@extends('layouts.admin')

@section('title')
    {{ $group->name }}
@stop

@section('content')
    <div class="group-wrapper">
        <div class="text-center"><h3 class="group-name">{{ $group->name }}</h3></div>
        <div class="text-center">
            <h5>Created at: {{ $group->present()->formatFullTime($group->created_at) }}</h5>
            <span class="label label-primary">
                {{ $users->count() }} {{ str_plural('member', $users->count()) }}
            </span>
        </div>
        <div class="group-wrapper--users">
            @if($users->isEmpty())
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="well text-center">Currently, this group has no associated member.</div>
                    </div>
                </div>
            @else
                @foreach($users->chunk(4) as $userStack)
                    <div class="row">
                        @foreach($userStack as $user)
                            <div class="col-md-3">
                                <div class="well">
                                    <div class="media">
                                        <div class="media-left">
                                            @include('users.partials.avatar')
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading">{{ $user->name  }}</h5>
                                            ...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@stop