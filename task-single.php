<?php
include("conexion.php");

$con= new conexion();
$objCon= $con->conectar();

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $query = "select * from task where id = :id";
    //SELECT * FROM `task` where name like 'write%'
    $result = $objCon->prepare($query);
    $result->bindParam('id',$id,PDO::PARAM_INT);
    $result->execute();
    //if there is some error ends the proccess
    if(!$result){
        die('Query error'.mysqli_error($conn));
    }
    //fetching the result as an array
    $json = array();
    while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
        $json [] = array(
        //converting array into a Json type variable 
            'name'=> $row['name'],
            'description'=> $row['description'],
            'id'=> $row['id'],
        );
    }
    //encoding the variable into JSON and returning its value
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;

}


?>