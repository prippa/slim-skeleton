<?php

namespace app\controllers\site;

use Psr\Http\Message\ResponseInterface as Response;

class Index extends SiteController
{
    protected function action(): Response
    {
        return $this->view('index', ['name' => 'Pavel']);
    }
}
