<?php 

use app\libraris\Database;

class User{
    private $con;

    public function __construct()
    {
        $instance  = Database::getInstance();
        $this->con = $instance->getConnection();
    }

    public function register($data) {

        $columns = "";
        $values  = "";
        foreach($data as $key => $value) 
        { 
            $columns .= ($columns == "") ? "" : ", "; 
            $columns .= $key; 

            $values .= ($values == "") ? "" : ", "; 
            $values .= "'".$value ."'";    
        }

        $sql = "INSERT INTO users ($columns) VALUES ($values)";
        if($this->con->query($sql)) {
            return true;
        }else{
            return false;
        }
    }

    // Login User
    public function login($email, $password){

        $result = $this->con-> query("SELECT * FROM users WHERE email = '$email' limit 1");

        if (mysqli_num_rows($result) > 0) {
            $result = $result->fetch_object();
            if($password == $result->password) {
                //echo "Password match";
                return $result;
            }
    
        }

        
        //echo "Password not match";
        return false;
        
    }




}


?>