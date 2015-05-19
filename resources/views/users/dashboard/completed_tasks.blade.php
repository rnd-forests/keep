@extends('layouts.app')

@section('meta-description', 'The collection of all completed tasks associated with ' . Auth::user()->name)

@section('title', 'Completed Tasks')

@section('task-type', 'Completed Tasks')

@section('content')
    @include('users.dashboard.partials.collection')
@stop