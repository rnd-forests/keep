@extends('layouts.app')

@section('title')
    {{ $user->name }}
@stop

@section('content')
    <div class="user-profile-wrapper">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="nav nav-tabs nav-justified">
                    <li role="presentation" class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                    <li role="presentation"><a href="#update-profile" data-toggle="tab">Update Profile</a></li>
                    <li role="presentation"><a href="#account" data-toggle="tab">Account Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active in fade" id="profile">
                        <div class="text-center">
                            @include('users.partials.avatar', ['size' => 180])
                            <h2 class="username">{{ $user->name }}</h2>
                        </div>
                        <div class="panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading">Date of Birth</h6>
                                    {{ $user->present()->printAttribute($user->present()->formatUserTime($user->birthday)) }}
                                </li>
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading">E-Mail Address</h6>
                                    {{ $user->email }}
                                </li>
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading">Address</h6>
                                    {{ $user->address }}
                                </li>
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading">Company</h6>
                                    {{ $user->present()->printAttribute($user->company) }}
                                </li>
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading">Personal Website</h6>
                                    {{ $user->present()->printAttribute($user->website) }}
                                </li>
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading">Phone Number</h6>
                                    {{ $user->present()->printAttribute($user->phone) }}
                                </li>
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading">About Yourself</h6>
                                    {{ $user->present()->printAttribute($user->about) }}
                                </li>
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading">Joined Date</h6>
                                    {{ $user->present()->formatUserTime($user->created_at) }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="update-profile">
                        @include('users.partials.update_profile_form', $user)
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="account">
                        <div class="panel panel-dangerzone">
                            <div class="panel-heading">Change Password</div>
                            <div class="panel-body">
                                @include('users.partials.update_password_form', $user)
                            </div>
                        </div>
                        <div class="panel panel-dangerzone">
                            <div class="modal fade" id="cancel-account-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p>Once your account is deleted, the system will immediately delete all your tasks, and
                                            all other things related to your account.</p>
                                        </div>
                                        <div class="modal-footer">
                                            @include('users.partials.delete_account_form')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">Delete Account</div>
                            <div class="panel-body">
                                <p>Once you delete your account, there is no going back. Please be careful.</p>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#cancel-account-modal">Delete your account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
