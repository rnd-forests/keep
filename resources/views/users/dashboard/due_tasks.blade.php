@extends('layouts.app')
@section('meta-description', 'The collection of all due tasks associated with ' . $authUser->name)
@section('title', 'Due Tasks')
@section('task-type', 'Due Tasks')
@section('content')
    @include('users.dashboard.partials._collection')
@stop