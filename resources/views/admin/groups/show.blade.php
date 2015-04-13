@extends('layouts.admin')

@section('title')
    {{ $group->name }}
@stop

@section('content')
    <div class="group-wrapper">
        <div class="jumbotron text-center">
            <h2 class="jumbotron__heading">{{ $group->name }}</h2>
            <div class="text-center jumbotron__sub-heading">
                <a href="{{ route('admin.active.groups') }}" class="btn btn-circle btn-primary"
                   data-toggle="tooltip" data-placement="bottom" title="Back to active groups collection">
                    <i class="fa fa-arrow-left"></i>
                </a>
                @include('admin.groups.partials.flush_form')
                <a href="{{ route('admin.groups.add.users', $group->slug) }}" class="btn btn-circle btn-primary"
                   data-toggle="tooltip" data-placement="bottom" title="Add new users to this group">
                    <i class="fa fa-plus"></i>
                </a>
                <a href="#" class="btn btn-warning btn-circle"
                   data-toggle="tooltip" data-placement="bottom" title="Send notification">
                    <i class="fa fa-bell-o"></i>
                </a>
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