<!DOCTYPE html>
@include('layouts.partials._conditions')
<head>
    @include('layouts.partials._common_head')
    @include('layouts.partials._shiv')
</head>
<body>
    @yield('content-layout')
    <script>
        @if(session('app_status') == 'login_success')
            swal({
                    title: "Hi, Again!",
                    text:  "You are now logged in.",
                    type: "success",
                    timer: 3000,
                    showConfirmButton: false
                });
        @endif

        @if(session('app_status') == 'logged_out')
            swal({
                    title: "Sorry to see you go!",
                    text:  "You have been logged out.",
                    type: "warning",
                    timer: 3000,
                    showConfirmButton: false
                });
        @endif
    </script>
</body>
</html>