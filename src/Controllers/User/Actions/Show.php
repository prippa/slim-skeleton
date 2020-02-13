<?php

namespace App\Controllers\User\Actions;

use App\Controllers\User\UserController;
use Psr\Http\Message\ResponseInterface as Response;

class Show extends UserController
{
    protected function action(): Response
    {
        $this->forAllUserControllers();
        echo 'User Show';
        return $this->response;
    }
}
