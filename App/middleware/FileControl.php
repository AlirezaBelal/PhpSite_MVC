<?php 

namespace App\middleware;

use App\core\Message;


class FileControl
{
    const DATA_LIMIT = 52428800 ; //52428800bit => 50MB
    const DATA_TYPES = ['MKV', 'MP4', 'MOV', 'GIF' , 'PNG' , 'JPEG' , 'JPG']; //Manage authorized extensions

    public static function sizeCheck($data)
    {
        return $data > self::DATA_LIMIT;
    }


    public static function typeCheck($data)
    {
        return in_array(strtoupper($data), self::DATA_TYPES);
    }


    public static function validate($size, $type)
    {
        if (self::sizeCheck($size)) {
            Message::addMessage("File is larger than allowed. Please select another file", Message::Error);
            return false;
        }
        if (!self::typeCheck($type)) {
            Message::addMessage("File should be " . implode(", ", self::DATA_TYPES) . " . $type", Message::Error);
            return false;
        }
        return true;
    }
}