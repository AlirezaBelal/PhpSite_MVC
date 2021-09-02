<?php 

namespace App\php;

use App\core\Application;

class URL 
{
    public static function getURL($name = "home") 
    {
        return Application::get_instance()->router->getURL($name);
    }
}

