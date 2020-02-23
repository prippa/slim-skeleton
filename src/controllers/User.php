<?php

namespace app\controllers;

use app\core\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use Slim\App;

class User extends Controller
{
    public function showGet(Request $request, Response $response, array $args = [])
    {
        $users = $this->db()->execute('SELECT * from user');

        return $this->view()->render($response, 'users', compact('users'));
    }

    public function addGet(Request $request, Response $response, array $args = [])
    {
        return $this->view()->render($response, 'users_add');
    }

    public function addPost(Request $request, Response $response, array $args = [])
    {
        global $app;

        $data = $request->getParsedBody();

        $this->db()->execute(
            'INSERT INTO user (name) VALUES (?)',
            [$data['name']]
        );

        $routeParser = $app->getRouteCollector()->getRouteParser();
        return $response->withStatus(302)->withHeader('Location', $routeParser->urlFor('showUsers'));
    }
}
