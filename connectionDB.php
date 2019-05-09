<?php 
class connectionDB {
    
    private $user;
    private $pass;
    private $servername;
    private $dbname;

    public function connect(){
        //$conn=mysqli_connect("localhost", $user, $pass, "tasksapp");
        $this->user="root";
        $this->pass="";
        $this->dbname="tasksapp";
        $this->servername="localhost";
        try {
            $dsn="mysql:host=".$this->servername.";dbname=".$this->dbname;
            $conn = new PDO($dsn,$this->user,$this->pass);
            return $conn;
        } catch (PDOexception $e) {
            echo "Connection failed.".$e->getMessage();
        }
    }
    
    
}

?>