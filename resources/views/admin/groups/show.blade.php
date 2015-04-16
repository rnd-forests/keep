@extends('layouts.admin')

@section('title')
    {{ $group->name }}
@stop

@section('content')
    <div class="group-wrapper">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                    <h3>{{ $group->name }}</h3>
                    <a href="{{ route('admin.active.groups') }}">
                        <button class="btn btn-circle btn-primary"
                                data-toggle="tooltip" data-placement="bottom" title="Back to active groups collection">
                            <i class="fa fa-arrow-left"></i>
                        </button>
                    </a>
                    @include('admin.groups.partials.flush_form')
                    <a href="{{ route('admin.groups.add.users', $group->slug) }}">
                        <button class="btn btn-circle btn-primary"
                            data-toggle="tooltip" data-placement="bottom" title="Add new users to this group">
                            <i class="fa fa-plus"></i>
                        </button>
                    </a>
                    <a href="#">
                        <button class="btn btn-circle btn-warning"
                            data-toggle="tooltip" data-placement="bottom" title="Send notification">
                            <i class="fa fa-bell-o"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="group-wrapper__users">
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