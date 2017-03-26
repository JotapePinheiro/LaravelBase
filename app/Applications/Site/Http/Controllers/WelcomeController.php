<?php

namespace App\Applications\Site\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return $this->view('welcome');
    }

}
