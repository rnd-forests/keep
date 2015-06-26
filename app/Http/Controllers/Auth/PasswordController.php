<?php

namespace Keep\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\ResetPasswordRequest;
use Illuminate\Contracts\Auth\PasswordBroker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{
    protected $passwords, $subject;

    /**
     * Create a new password controller instance.
     *
     * @param PasswordBroker $passwords
     */
    public function __construct(PasswordBroker $passwords)
    {
        $this->passwords = $passwords;
        $this->subject = 'Recover your account password at Keep';
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function getEmail()
    {
        return view('auth.password');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = $this->passwords->sendResetLink($request->only('email'), function ($message) {
            $message->subject($this->subject);
        });

        if ($response == PasswordBroker::RESET_LINK_SENT) {
            flash()->success(trans('authentication.password_reset_email'));

            return redirect()->home();
        }

        return back()->withErrors(['email' => trans($response)]);
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param null $token
     *
     * @return $this
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException();
        }

        return view('auth.reset')->with('token', $token);
    }

    /**
     * Reset the given user's password.
     *
     * @param ResetPasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postReset(ResetPasswordRequest $request)
    {
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = $this->passwords->reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
            auth()->login($user);
        });

        if ($response == PasswordBroker::PASSWORD_RESET) {
            flash()->success(trans('authentication.password_reset'));

            return redirect()->home();
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}
