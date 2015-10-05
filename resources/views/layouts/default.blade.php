@extends('layouts.root')
@section('content-layout')
    @include('layouts.partials._main_navbar')
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    @include('layouts.partials._footer')
    <script src="{{ elixir('js/all.js') }}"></script>
    @yield('footer')
@stop
