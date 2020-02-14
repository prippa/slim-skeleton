<?php

namespace app\controllers\user;

use app\models\User;
use Psr\Http\Message\ResponseInterface as Response;

class Delete extends UserController
{
    protected function action(): Response
    {
        User::delete($this->args['id']);
        return $this->response;
    }
}
