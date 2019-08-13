<?php
 
 if(isset($_GET['function'])) {
     if($_GET['function'] == 'getAlltasks') {
          return  getAlltasks();
     }
 }
class task extends database {

 
    public function getAlltasks(){

                $stmt=$this->connect()->query("select * from task");
                
                $json = array();
                while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                    $json [] = array(
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'id' => $row['id'],
                    );
                }
                $jsonstring = Json_encode($json);
                echo $jsonstring;

    }


}



?>