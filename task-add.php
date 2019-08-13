<?php
include('conexion.php');

$objCon=new conexion();
$con=$objCon->conectar();

echo $_POST['name'];
    if(isset($_POST['name'])){
    $name = $_POST['name'];
    $description= $_POST['description'];


    $result = $con->prepare('INSERT INTO task (name,description)
    values (:name,:description)');
$result->bindParam(':name', $name, PDO::PARAM_STR);
$result->bindParam(':description', $description, PDO::PARAM_STR);
$result->execute();


    if(!$result){
        die('Query failed');
    }else{
        echo 'Task added successfully';
    }

}



?>