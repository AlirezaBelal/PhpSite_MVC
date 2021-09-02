<?php

namespace App\core;

use App\core\Cookie;


class Auth
{
    const TERMINATOR = -3601;
    private static string $COOKIE_NAME = "username";
    private static string $ADMIN_COOKIE = "isadmin";
    private static string $CONFIRM_COOKIE = "isconfirm";


    public static function checkIn($username, $isAdmin = 0, $canConfirm = 0)
    {
        Cookie::set(self::$COOKIE_NAME, $username);
        Cookie::set(self::$ADMIN_COOKIE, $isAdmin);
        Cookie::set(self::$CONFIRM_COOKIE, $canConfirm);
    }


    public static function checkUser()
    {
        return (bool)Cookie::get(self::$COOKIE_NAME);
    }


    public static function checkOut()
    {
        Cookie::set(self::$COOKIE_NAME, "", self::TERMINATOR);
        Cookie::set(self::$ADMIN_COOKIE, "", self::TERMINATOR);
        Cookie::set(self::$CONFIRM_COOKIE, "", self::TERMINATOR);
    }


    public static function getUserName()
    {
        return self::checkUser() ? Cookie::get(self::$COOKIE_NAME) : "Guest";
    }


    public static function isUserAdmin()
    {
        $res = Cookie::get(self::$ADMIN_COOKIE);
        if ($res === false) {
            return false;
        }
        return $res == 1;
    }


    public static function isUserConfirm()
    {
        $res = Cookie::get(self::$CONFIRM_COOKIE);
        if ($res === false) {
            return false;
        }
        return $res == 1;
    }
}
