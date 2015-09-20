@extends('layouts.default')
@section('title', 'Account Settings')
@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="col-md-4">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="#update-name" role="tab" data-toggle="tab">Change Current Name</a></li>
                <li role="presentation"><a href="#update-password" role="tab" data-toggle="tab">Change Current Password</a></li>
                @unless($user->isAdmin())
                    <li role="presentation"><a href="#cancel-account" role="tab" data-toggle="tab">Cancel Account</a></li>
                @endunless
            </ul>
        </div>
        <div class="col-md-8">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="update-name">
                    <div class="form-wrapper">
                        @include('users.account.partials._update_name_form')
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="update-password">
                    <div class="form-wrapper">
                        @include('users.account.partials._update_password_form')
                    </div>
                </div>
                @unless($user->isAdmin())
                    <div role="tabpanel" class="tab-pane" id="cancel-account">
                        <div class="panel panel-danger text-center">
                            @include('users.account.partials._cancel_account_modal')
                            <div class="panel-heading">Cancel your account</div>
                            <div class="panel-body">
                                <button class="btn btn-danger" data-toggle="modal" data-target="#cancel-account-modal">Cancel account</button>
                            </div>
                        </div>
                    </div>
                @endunless
            </div>
        </div>
    </div>
@stop