@extends('layouts.admin')
@section('title', $user->name)
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 account-profile">
            @include('admin.accounts.partials._account_info')
        </div>
    </div>
@stop