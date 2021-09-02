<?php

namespace App\model;

use App\model\Model;

class Guest extends Model 
{
    public int $id;
    public date $time_join_user;
    public int $onlin_user;

    protected $table_name = "guest";
}