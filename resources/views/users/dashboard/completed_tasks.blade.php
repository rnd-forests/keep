@extends('layouts.app')

@section('title', 'Completed Tasks')

@section('task-type', 'Completed Tasks')

@section('content')
    @include('users.dashboard.partials.collection')
@stop