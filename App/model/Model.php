<?php

namespace App\model;

use App\database\Database;


abstract class Model 
{

    protected $pdo;

    public function __construct() 
    {
        $this->pdo = Database::getInstance()->getPDO();
    }

    public function select($table_name, array $where = [])
    {
        $Status = [];

        foreach ($where as $key => $val) {
            $Status[] = $key . "=" . "'" . $val . "'";
        }

        $Status = implode(" AND ", $Status);

        $Query = $this->pdo->prepare("SELECT * FROM $table_name WHERE $Status");
        $Query->execute();

        $test = $Query->fetchObject(get_called_class());

        return $test;
//        var_dump($test);
//        exit();
    }

    public function selectAll($table_name)
    {
        $Query = $this->pdo->prepare("SELECT * FROM $table_name");
        $Query->execute();

        return $Query->fetchAll(\PDO::FETCH_OBJ);
    }


    public function insert($table_name, array $data = [])
    {
        $keys = "(" . implode(",", array_keys($data)) . ")";

        $format_data = [];

        foreach($data as $single) {
            $format_data[] = "'" . $single . "'";
        }

        $format_data = "(" . implode(",", $format_data) . ")";

        $Query = $this->pdo->prepare("INSERT INTO $table_name $keys VALUES $format_data");
        
        try {
            $Query->execute();
            return $this->pdo->lastInsertId();
        } catch (\PDOExecption $e) {
            echo $e->getMessage();
            return -1;
        }
    }


    public function update($table_name, array $data = [], array $where = [])
    {
        $Status = [];

        foreach ($where as $key => $val) {
            $Status[] = $key . "=" . "'" . $val . "'";
        }

        $Status = implode(" AND ", $Status);

        $format_data = [];

        foreach ($data as $key => $val) {
            $format_data[] = $key . "=" . "'" . $val . "'";
        }

        $format_data = implode(", ", $format_data);

        $Query = $this->pdo->prepare("UPDATE $table_name SET $format_data WHERE $Status");
        try {
            $Query->execute();
            return 1;
        } catch (\PDOExecption $e) {
            echo $e->getMessage();
            return -1;
        }
    }


    public function delete($table_name, array $where = [])
    {
        $Status = [];

        foreach ($where as $key => $val) {
            $Status[] = $key . "=" . "'" . $val . "'";
        }

        $Status = implode(" AND ", $Status);
        $Query = $this->pdo->prepare("DELETE FROM $table_name WHERE $Status");
        try {
            $Query->execute();
            return 1;
        } catch (\PDOExecption $e) {
            echo $e->getMessage();
            return -1;
        }
    }


    public function count_all($table_name) 
    {
        $Query = $this->pdo->prepare("SELECT COUNT(*) FROM $table_name");
        try {
            $Query->execute();
            return $Query->fetch();
        } catch (\PDOExecption $e) {
            return 0;
        }
    }
}
