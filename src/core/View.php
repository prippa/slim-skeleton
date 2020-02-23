<?php

namespace app\core;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class View
{
    /**
     * @var array
     */
    private $success = [];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var Twig
     */
    private $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function setSuccess(string $success_message): void { $this->success[] = $success_message; }
    public function setError(string $error_message): void { $this->errors[] = $error_message; }

    private function setDefaultData(array &$data, string $path): void
    {
        $data['path'] = $path;
        $data['success'] = $this->success;
        $data['errors'] = $this->errors;
    }

    public function render(Response $response, string $path, array $data = []): Response
    {
        $this->setDefaultData($data, $path);
        $path .= '.twig';

        return $this->view->render($response, $path, $data);
    }
}
