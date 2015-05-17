@extends('layouts.app')

@section('title')
    {{ $user->name }}
@stop

@section('content')
    <div class="user-profile-wrapper">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="nav nav-tabs nav-justified">
                    <li role="presentation" class="active"><a href="#profile" data-toggle="tab">Basic Information</a></li>
                    <li role="presentation"><a href="#update-profile" data-toggle="tab">Profile Settings</a></li>
                    <li role="presentation"><a href="#account" data-toggle="tab">Account Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active in fade" id="profile">
                        @include('users.partials.basic_information')
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="update-profile">
                        @include('users.partials.update_profile_form', $user)
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="account">
                        <div class="panel panel-dangerzone">
                            <div class="panel-heading">Update current username</div>
                            <div class="panel-body">
                                @include('users.partials.update_username_form', $user)
                            </div>
                        </div>
                        <div class="panel panel-dangerzone">
                            <div class="panel-heading">Update current password</div>
                            <div class="panel-body">
                                @include('users.partials.update_password_form', $user)
                            </div>
                        </div>
                        @unless($user->isAdmin())
                            <div class="panel panel-dangerzone">
                                @include('users.partials.cancel_account_modal')
                                <div class="panel-heading">Cancel your account</div>
                                <div class="panel-body">
                                    <p>Once you delete your account, there is no going back. Please be careful.</p>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#cancel-account-modal">Cancel account</button>
                                </div>
                            </div>
                        @endunless
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
