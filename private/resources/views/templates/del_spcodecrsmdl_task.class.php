<?php

class Mdl_tasks
{  // ***DELETE afte SpeedCoding course
    private $pdo;

    public function __construct()
    {
        // connect to the database
        $host = 'localhost';
        $user = 'michael';
        $password = 'Job4Fau';// for MAMP others empty '' by default
        $dbname = 'mbblog';

        // set DSN (data source name)
        $dsn = 'mysql:host='.$host.';dbname='.$dbname;
        // mysql:host=localhost;dbname=test

        //create a PDO instance
        $this->pdo = new PDO($dsn, $user, $password);
    }

    public function query($mysql_query)
    {
        $stmt = $this->pdo->query($mysql_query); // statement/result or false

        return $stmt;
    }
}
