<?php

namespace app\controllers\user;

use app\core\Controller;

abstract class UserController extends Controller
{
    protected function forAllUserControllers()
    {
        echo 'forAllUserControllers' . '<br>';
    }
}
