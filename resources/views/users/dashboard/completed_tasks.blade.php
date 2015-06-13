@extends('layouts.app')
@section('meta-description', 'The collection of all completed tasks associated with ' . $authUser->name)
@section('title', 'Completed Tasks')
@section('task-type', 'Completed Tasks')
@section('content')
    @include('users.dashboard.partials._collection')
@stop