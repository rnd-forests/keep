@extends('layouts.app')

@section('meta-description', 'The collection of all tasks associated with ' . Auth::user()->name)

@section('title', 'All Tasks')

@section('task-type', 'All Tasks')

@section('content')
    @include('users.dashboard.partials.collection')
@stop