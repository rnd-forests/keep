@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 user-profile-wrapper">
            @include('users.partials._update_profile_form', $user)
        </div>
    </div>
@stop
