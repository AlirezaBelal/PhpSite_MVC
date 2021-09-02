<?php

namespace App\core\router;


class Route
{
    // Private fields
    private string $name;
    private string $path;
    private $callback;

    public function __construct(string $path, $callback)
    {
        $this->path = $path;
        $this->callback = $callback;
    }


    public function namePath($name)
    {
        $this->name = $name;
        return $this;
    }

    public function check($path)
    {
        $pattern = preg_replace('/{\w+}/', '(\\w+)', $this->getPath());
        $pattern = '/^' . preg_replace("/\//", '\\/', $pattern) . '$/';
        return preg_match($pattern, $path);
    }


    public function getName()
    {
        return $this->name;
    }


    public function getPath()
    {
        return $this->path;
    }


    public function getCallback()
    {
        return $this->callback ?? false;
    }
}