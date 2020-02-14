<?php

namespace app\core;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class View
{
    /**
     * @var string
     */
    private $filePostfix;

    /**
     * @var string
     */
    private $lang;

    /**
     * @var Twig
     */
    private $view;

    public function __construct(Twig $view)
    {
        $this->filePostfix = '.twig';
        $this->lang = 'en';

        $this->view = $view;
    }

    public function setLang(string $lang): void { $this->lang = $lang; }
    public function setFilePostfix(string $filePostfix): void { $this->filePostfix = $filePostfix; }

    private function getTitleByFilename($path): string
    {
        $title = strrchr($path, "/");
        if (!$title) {
            $title = $path;
        } else {
            $title = substr($title, 1);
        }
        $title = ucfirst(str_replace('_', ' ', $title));

        return $title;
    }

    private function setDefaultData(array &$data, string $path): void
    {
        if (!isset($data['title'])) {
            $data['title'] = $this->getTitleByFilename($path);
        }
        $data['lang'] = $this->lang;
    }

    public function render(Response $response, string $path, array $data = []): Response
    {
        $this->setDefaultData($data, $path);
        $path .= $this->filePostfix;

        return $this->view->render($response, $path, $data);
    }
}
