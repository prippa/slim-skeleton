<?php

namespace app\core;

use Psr\Container\ContainerInterface;

abstract class Controller
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var DB
     */
    private $db;

    /**
     * @var View
     */
    private $view;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = null;
        $this->view = null;
    }

    protected function db(): DB
    {
        if (!$this->db) {
            $this->db = $this->container->get('database_connection');
        }

        return $this->db;
    }

    protected function view(): View
    {
        if (!$this->view) {
            $this->view = new View($this->container->get('view'));
        }

        return $this->view;
    }
}
