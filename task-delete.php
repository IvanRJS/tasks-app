<?php
include('conexion.php');

$con=new conexion();
$objCon=$con->conectar();


if(isset($_POST['id'])){

    $id=$_POST['id'];
    $query="delete from task where id= :id";
    
    $result=$objCon->prepare($query);
    $result->bindParam('id',$id,PDO::PARAM_INT);
    $result->execute();
    if(!$result){
        die('Query failed.');
    }
    echo "Task deleted successfully";
}

?>