@extends('layouts.app')
@section('meta-description', 'The collection of all failed tasks associated with ' . $authUser->name)
@section('title', 'Failed Tasks')
@section('task-type', 'Failed Tasks')
@section('content')
    @include('users.dashboard.partials._collection')
@stop