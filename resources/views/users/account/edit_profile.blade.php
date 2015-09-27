@extends('layouts.default')
@section('title', 'Edit Profile')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 user-profile-wrapper">
            <div class="panel panel-default form-wrapper">
                <div class="panel-heading">Update your profile</div>
                <div class="panel-body">
                    @include('users.account.partials._update_profile_form', $user)
                </div>
            </div>
        </div>
    </div>
@stop
