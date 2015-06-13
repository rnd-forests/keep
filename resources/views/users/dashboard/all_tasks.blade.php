@extends('layouts.app')
@section('meta-description', 'The collection of all tasks associated with ' . $authUser->name)
@section('title', 'All Tasks')
@section('task-type', 'All Tasks')
@section('content')
    @include('users.dashboard.partials._collection')
@stop