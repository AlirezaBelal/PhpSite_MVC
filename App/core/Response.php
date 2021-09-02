<?php

namespace App\core;

use App\php\URL;


class Response 
{

    public function setStatusCode($code)
    {
        http_response_code($code);
    }

    public function setContentType($type = "text/html")
    {
        header("Content-Type: $type; charset=UTF-8");
    }

    public function redirect(string $name = "home", int $code = 301) 
    {
        $path = URL::getURL($name);
        header("Location: $path", TRUE, $code);
    }
}