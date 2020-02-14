<?php

namespace app\controllers\user;

use app\models\User;
use Psr\Http\Message\ResponseInterface as Response;

class Add extends UserController
{
    protected function action(): Response
    {
        User::add($this->args['name']);
        return $this->response;
    }
}
