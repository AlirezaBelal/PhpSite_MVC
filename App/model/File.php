<?php

namespace App\model;

use App\model\Model;
use App\model\traitsModel\TotalTrait;
use App\model\traitsModel\UploadTrait;


class File extends Model 
{
    use TotalTrait;
    use UploadTrait;

    public int $id;
    public string $name;
    public string $path;
    public string $user_upload;
    public date $time_upload;
    public int $count_download;
    public string $type_file;
    public int $size_file;
    public date $time_expire;
    public int $validation;

    protected $table_name = "file";

    public function getUserFiles($username)
    {
        $Query = $this->pdo->prepare("SELECT F.name, path, time_upload, size_file, type_file, count_download , time_expire, F.id
                                    FROM $this->table_name as F JOIN user as U ON F.user_upload = U.name
                                    WHERE U.name = '$username'");
        $Query->execute();

        return $Query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function selectFileById($id)
    {
        return $this->select($this->table_name, ['id' => $id]);
    }

    public function removeFile($id)
    {
        return $this->delete($this->table_name, ['id' => $id]);
    }

    public function makeValid($id)
    {
        return $this->update($this->table_name, ['validation' => 1], ['id' => $id]);
    }

    public function downloadFile($id, $count_download)
    {
        return $this->update($this->table_name, ['count_download' => $count_download], ['id' => $id]);
    }
}