<?php

namespace App\model\traitsModel;

trait UploadTrait
{
    public function uploadFile($name, $path, $username, $type_file, $size_file, $time_expire)
    {
        return $this->insert($this->table_name, [
            "id" => NULL,
            "name" => $name, 
            "path" => $path,
            "user_upload" => $username,
            "count_download" => 0,
            "type_file" => $type_file,
            "size_file" => $size_file,
            "time_expire" => $time_expire,
            "validation" => 0
        ]);
    }
}