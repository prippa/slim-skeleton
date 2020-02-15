<?php

namespace app\controllers\user;

use Psr\Http\Message\ResponseInterface as Response;

class Add extends UserController
{
    protected function action(): Response
    {
        $this->db->insert('test', ['name', $this->args['name']]);
        return $this->response;
    }
}
