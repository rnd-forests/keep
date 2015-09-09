@extends('layouts.app')
@section('title', 'Public Profile')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 user-profile-wrapper">
            @include('users.account.partials._basic_info')
        </div>
    </div>
@stop
