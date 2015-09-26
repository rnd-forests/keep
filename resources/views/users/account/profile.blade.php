@extends('layouts.default')
@section('title', $user->name . ' Profile')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('users.account.partials._basic_info')
            @if($user->can('act-as-current-user'))
                <div class="text-center">
                    <a href="{{ route('member::profile.edit', $authUser) }}"
                       class="btn btn-primary btn-sm">Update Profile</a>
                </div>
            @endcan
        </div>
    </div>
@stop
