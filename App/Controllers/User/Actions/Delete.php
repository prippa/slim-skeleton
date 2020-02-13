<?php

namespace App\Controllers\User\Action;

use App\Controllers\User\UserController;
use Psr\Http\Message\ResponseInterface as Response;

class Delete extends UserController
{
    protected function action(): Response
    {
        $this->forAllUserControllers();
        echo 'User Delete';
        return $this->response;
    }
}