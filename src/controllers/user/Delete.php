<?php

namespace app\controllers\user;

use Psr\Http\Message\ResponseInterface as Response;

class Delete extends UserController
{
    protected function action(): Response
    {
        $this->db->delete('test', ['id', $this->args['id']], 1);
        return $this->response;
    }
}
