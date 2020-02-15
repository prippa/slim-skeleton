<?php

namespace app\controllers\site;

use Psr\Http\Message\ResponseInterface as Response;

class Index extends SiteController
{
    protected function action(): Response
    {
        $users = $this->db->selectRows('test');
        return $this->view('index', ['title' => 'Home Page', 'users' => $users]);
    }
}
