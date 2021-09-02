<?php

namespace App\model\traitsModel;

trait LoginTrait
{
    public function login($username, $password)
    {
        return $this->select($this->table_name, ["name" => $username, "password" => $password]) ?? false;
    }
}
