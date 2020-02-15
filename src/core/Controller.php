<?php

namespace app\core;

use Psr\Container\ContainerInterface as Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var DB
     */
    protected $db;

    public function __construct(Container $container)
    {
        $this->container = $container;

        $this->db = $this->container->get('db');
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        return $this->action();
    }

    abstract protected function action(): Response;

    protected function view(string $path, array $data = []): Response
    {
        $view = new View($this->container->get('view'));

        return $view->render($this->response, $path, $data);
    }
}
