@extends('layouts.app')

@section('meta-description', 'The collection of all due tasks associated with ' . Auth::user()->name)

@section('title', 'Due Tasks')

@section('task-type', 'Due Tasks')

@section('content')
    @include('users.dashboard.partials.collection')
@stop