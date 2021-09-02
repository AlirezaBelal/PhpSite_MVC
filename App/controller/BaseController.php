<?php

namespace App\controller;

use App\core\view\RenderManagemen;
use App\core\Application;


class BaseController
{

    public function render($view, $params = []) 
    {
        return RenderManagemen::renderView($view, $params);
    }

    public function redirect(string $path, int $code = 301)
    {
        return Application::$app->response->redirect($path, $code);
    }
}
