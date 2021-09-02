<?php

namespace App\core;

use App\core\Cookie;

class Message
{

    //color in front
    const Error = "danger";
    const Successful = "success";
    const Wrong = "warning";

    public static function check()
    {
        return (bool)Cookie::get("message");
    }


    public static function addMessage($content = "", $type = "warning")
    {
        Cookie::set("message", $content, 3600);
        Cookie::set("type", $type, 3600);
    }


    public static function clear()
    {
        Cookie::set("message", "", -3601);
        Cookie::set("type", "", -3601);
    }


    public static function getMessage()
    {
        return Cookie::get("message");
    }


    public static function getType()
    {
        return Cookie::get("type");
    }
}

