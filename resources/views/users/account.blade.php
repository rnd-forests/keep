@extends('layouts.app')
@section('title', 'Account Settings')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-wrapper">
                @include('users.partials._update_username_form')
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-wrapper">
                @include('users.partials._update_password_form')
            </div>
        </div>
        <div class="col-md-4">
            @unless($user->isAdmin())
                <div class="panel panel-danger text-center">
                    @include('users.partials._cancel_account_modal')
                    <div class="panel-heading">Cancel your account</div>
                    <div class="panel-body">
                        <p>Once you delete your account, there is no going back. Please be careful.</p>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#cancel-account-modal">Cancel account</button>
                    </div>
                </div>
            @endunless
        </div>
    </div>
@stop