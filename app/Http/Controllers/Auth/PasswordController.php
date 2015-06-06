<?php
namespace Keep\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use Keep\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Redirecting path.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     *
     * @param  Guard          $auth
     * @param  PasswordBroker $passwords
     */
    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;
        $this->subject = 'Recover your account password at Keep';
        $this->middleware('guest');
    }
}
