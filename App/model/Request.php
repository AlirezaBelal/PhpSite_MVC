<?php

namespace App\model;

use App\model\Model;
use App\model\traitsModel\TotalTrait;


class Request extends Model 
{
    use TotalTrait;

    public int $id;

    protected $table_name = "request";

    public function getRequestData()
    {
        $sth = $this->pdo->prepare("SELECT F.name, F.user_upload, F.size_file, F.type_file, F.time_upload, R.id
                                    FROM $this->table_name as R JOIN file as F ON F.id = R.id");
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_OBJ);
    }

    public function insertRequest($id) 
    {
        return $this->insert($this->table_name, ['id' => $id]);
    }

    public function removeRequest($id)
    {
        return $this->delete($this->table_name, ['id' => $id]);
    }
}
