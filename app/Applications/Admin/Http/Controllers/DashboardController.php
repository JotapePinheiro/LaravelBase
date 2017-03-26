<?php

namespace App\Applications\Admin\Http\Controllers;

class DashboardController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return  $this->view('dashboard');
    }
}