<?php

namespace App\middleware;

use App\core\Message;

class Validation
{
    const DATA_LIMIT = 64; //Charter inpout

    public static function dataValidation($data)
    {
        return strlen($data) > self::DATA_LIMIT;
    }

    public static function isCleanData($data)
    {
        $temp = $data;
        return preg_replace("/[^a-zA-Z0-9]+/", " ", $data) != $temp;
    }


    public static function toBeRight($data)
    {
        foreach($data as $key => $value) {
            if (self::dataValidation($value)) {
                Message::addMessage("The number of characters is more than allowed.", Message::Error);
                return false;
            }
            if (self::isCleanData($value)) {
                Message::addMessage("Only letters are allowed", Message::Error);
                return false;
            }
        }
        return true;
    }
}