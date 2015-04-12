@extends('layouts.admin')

@section('title')
    {{ $group->name }}
@stop

@section('content')
    <div class="group-wrapper">
        <div class="jumbotron text-center">
            <h2 class="jumbotron__heading">{{ $group->name }}</h2>
            <p class="jumbotron__sub-heading">
                Created {{ $group->present()->formatTimeForHumans($group->created_at) }}
            </p>
        </div>
        <div class="text-center">
            <div class="btn-group inline">
                <div class="btn-group" role="group">
                    @include('admin.groups.partials.flush_form')
                    <a href="{{ route('admin.groups.add.users', $group->slug) }}">
                        <button type="button" class="btn btn-primary">Add new users</button>
                    </a>
                </div>

            </div>
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
                                            @include('admin.groups.partials.remove_form')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="text-center">{!! $users->render() !!}</div>
            @endif
        </div>
    </div>
@stop