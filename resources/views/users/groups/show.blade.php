@extends('layouts.app')
@section('title', 'Group - ' . $group->name)
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="text-center" style="margin-bottom: 15px">
                <button class="btn btn-lg btn-info" type="button">
                    {{ plural('Member', counting($members)) }}
                </button>
            </div>
            <div class="col-md-4">
                @foreach($members as $user)
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
                @endforeach
            </div>
        </div>
    </div>
@stop