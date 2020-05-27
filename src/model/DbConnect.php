<?php

namespace App\Model;

class DBConnect
{
    public function getConnect()
    {
        $dataBase = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT.';charset=utf8', DB_USER, DB_PASSWORD, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        return $dataBase;
    }
}

?>