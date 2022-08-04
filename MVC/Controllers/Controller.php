<?php

namespace MVC\Controllers;

class Controller
{
    public $path, $router, $model, $redis;

    public function __construct($path, $redis)
    {
        $this->path = $path;
        $this->redis = $redis;
    }

    private function getClass()
    {
        if (empty($this->class)) {
            $class = get_class($this->getModel());
            $buf = explode('\\', $class);
            $this->class = end($buf);
        }
        return $this->class;
    }

    private function getRouter()
    {
        if (empty($this->router)) {
            $this->router = Router::parse($this->path);
        }
        return $this->router;
    }

    private function getModel()
    {
        if (empty($this->model)) {
            $class = 'MVC\\Models\\' . ucfirst($this->router->model);
            $this->model = new $class();

            if ($this->getRouter()->id) {
                $this->model = $this->model->collection[$this->getRouter()->id];
            }
        }
        return $this->model;
    }

    public function render()
    {
        $cache = $this->redis->get($this->path);
        if (!$cache) {
            $decorator = \MVC\Decorators\DecoratorFactory::create(
                $this->getRouter()->ext,
                $this->getClass(),
                $this->getModel()
            );

            $view = \MVC\Views\ViewFactory::create(
                $this->getRouter()->ext,
                $this->getClass(),
                $decorator
            );
            $cache = $view->render();
            $this->redis->set($this->path, $cache);
        }

        return $cache;
    }
}
