<?php 

namespace app\libraris;

use mysqli;

class Database {

    private static $dbInstance = null;

    private $conn;
    private $host =  DB_HOST;
    private $user =  DB_USER;
    private $pass =  DB_PASS;
    private $name =  DB_NAME;

    private function __construct()
    {
        $this->conn = new mysqli("$this->host","$this->user","$this->pass","$this->name");
    }

    public static function getInstance()
    {
        if(!self::$dbInstance)
        {
            self::$dbInstance = new Database();
        }
        return self::$dbInstance;
    }
    
    public function getConnection()
    {
        return $this->conn;
    }

}

?>