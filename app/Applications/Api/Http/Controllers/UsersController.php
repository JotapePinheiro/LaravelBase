<?php

namespace App\Applications\Api\Http\Controllers;

use App\Domains\Users\User;

class UsersController extends BaseController
{

    public function index()
    {

        return User::query()->paginate(3);
        
    }
}