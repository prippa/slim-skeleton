<?php

namespace App\Controllers\User;

use App\Controllers\Controller;

abstract class UserController extends Controller
{
    protected function forAllUserControllers()
    {
        echo 'forAllUserControllers' . '<br>';
    }
}
