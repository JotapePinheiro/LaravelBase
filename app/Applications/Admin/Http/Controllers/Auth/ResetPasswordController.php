<?php

namespace Jotape\Applications\Admin\Http\Controllers\Auth;

use Jotape\Applications\Admin\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return $this->view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
