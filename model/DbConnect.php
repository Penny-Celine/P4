<?php

namespace Cmpx\P4;

class DBConnect
{
    protected function getConnect()
    {
        $dataBase = new \PDO('mysql:host=localhost;dbname=p4_maupoux_celine_bdd;port=3308;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $dataBase;
    }
}

?>