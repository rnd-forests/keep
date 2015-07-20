@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#profile" data-toggle="tab">Public Profile</a></li>
                <li><a href="#update-profile" data-toggle="tab">Update Profile</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active in fade" id="profile">
                    @include('users.partials._basic_info')
                </div>
                <div role="tabpanel" class="tab-pane fade" id="update-profile">
                    @include('users.partials._update_profile_form', $user)
                </div>
            </div>
        </div>
    </div>
@stop
