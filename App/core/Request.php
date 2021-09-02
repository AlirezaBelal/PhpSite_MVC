<?php

namespace App\core;


class Request
{

    public function setPath($path)
    {
        $_SERVER['REQUEST_URI'] = $path;
    }


    public function setMethod($method)
    {
        $_SERVER['REQUEST_METHOD'] = $method;
    }


    public function getPath()
    {
        $URI = $_SERVER['REQUEST_URI'];
        $pos = strpos("?", $URI);
        $URI = $pos === FALSE ? $URI : substr($URI, 0, $pos);
        $URI = rtrim($URI, "/");
        return $URI == "" ? "/" : $URI;
    }


    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


    public function getBody()
    {
        $list = $this->getMethod() == 'post' ? $_POST : $_GET;
        $data = [];
        foreach($list as $key => $value) 
        {
            $data[$key] = $value;
        }
        return $data;
    }
}