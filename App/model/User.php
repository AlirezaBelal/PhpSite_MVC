<?php

namespace App\model;

use App\model\Model;
use App\model\traitsModel\LoginTrait;
use App\model\traitsModel\RegisterTrait;
use App\model\traitsModel\TotalTrait;


class User extends Model 
{
    use LoginTrait;
    use RegisterTrait;
    use TotalTrait;

    public string $name;
    public string $password;
    public int $situation_user;
    public int $isadmin;
    public int $isconfirm;

    protected $table_name = "user";

    public function lockByName($name, $situation_user = 0)
    {
        return $this->update($this->table_name, ['situation_user' => $situation_user], ['name' => $name]);
    }

    public function changeConfirm($name, $situation_user = 0)
    {
        return $this->update($this->table_name, ['isconfirm' => $situation_user], ['name' => $name]);
    }
}