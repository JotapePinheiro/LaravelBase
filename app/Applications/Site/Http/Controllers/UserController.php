<?php

namespace App\Applications\Site\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        if ($user->isAdmin()) {

            return $this->view('pages.admin.home');


        }

        return $this->view('pages.user.home');

    }

}