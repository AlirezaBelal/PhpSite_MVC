<?php

namespace App\model\traitsModel;

trait RegisterTrait
{
    public function register($username, $password)
    {

        $password = md5($password);//hash Password
        return $this->insert($this->table_name, [
            "name" => $username, 
            "password" => $password,
            "situation_user" => 1]) ?? false;
    }
}