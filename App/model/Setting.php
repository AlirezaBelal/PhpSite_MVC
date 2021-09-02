<?php

namespace App\model;

use App\model\Model;


class Setting extends Model 
{
    public int $max_size;

    protected $table_name = "setting";
}