@extends('layouts.admin')

@section('title')
    {{ $group->name }}
@stop

@section('content')
    <div class="group-wrapper">
        <div class="text-center"><h3>{{ $group->name }}</h3></div>
        <div class="text-center">
            <span class="label label-primary">
                {{ $users->count() }} {{ str_plural('member', $users->count()) }}
            </span>
        </div>

        <div class="group-wrapper--users">
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
        </div>
    </div>
@stop