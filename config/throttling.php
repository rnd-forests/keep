<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Login Attempts
    |--------------------------------------------------------------------------
    |
    | This option specifies the maximum number of failed login attempts that
    | users can make. Once this number is reached, users will be locked
    | for a number of seconds before they may try to login again.
    |
    */
    'max_login_attempts' => 5,

    /*
    |--------------------------------------------------------------------------
    | Lockout Time
    |--------------------------------------------------------------------------
    |
    | This option specifies the number of seconds that users must wait when
    | they are switched to the locked state.
    |
    */
    'lockout_time'       => 60,

    /*
    |--------------------------------------------------------------------------
    | The Login Username
    |--------------------------------------------------------------------------
    |
    | This option specifies the field (attribute) of user which is used
    | as the login name.
    |
    */
    'login_username'     => 'email',

    /*
    |--------------------------------------------------------------------------
    | The Login Path
    |--------------------------------------------------------------------------
    |
    | This option specifies the login path.
    |
    */
    'login_path'         => '/auth/login',

];
