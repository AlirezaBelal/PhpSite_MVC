<?php

namespace App\model;

use App\model\Model;

class Guest extends Model 
{
    public int $id;
    public string $time_join_user;
    public int $Onlin_user;

    protected $table_name = "guest";
}