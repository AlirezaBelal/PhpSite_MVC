<?php

namespace App\core\view;

use App\core\Application;
use App\core\Message;


class RenderManagemen
{
    private static string $BASE_PATH = "layouts/main";


    public static function renderView($view, $params = [])
    {
        return str_replace("{{content}}", self::loadView($view, $params), self::loadView(self::$BASE_PATH));
    }


    private static function loadView($view, $params = []) 
    {
        foreach ($params as $key => $value) 
        {
            $$key = $value;
        }

        if (Message::check())
        {
            $message = Message::getMessage();
            $type = Message::getType();
            Message::clearMessage();
        }

        ob_start();
        include_once Application::$ROOT . "/App/view/" . $view . ".php";
        return ob_get_clean();
    }
}